<?php

//////////////////
// Core loading //
//////////////////

require('../lib/base.php');

// Utility functions
require_once "../lib/util/def.php";
require_once "../lib/util/func.php";

if ((float)strstr(PCRE_VERSION,' ',TRUE)<7.9)
	trigger_error('Outdated PCRE library version');

if (function_exists('apache_get_modules') &&
	!in_array('mod_rewrite',apache_get_modules()))
	trigger_error('Apache rewrite_module is disabled');

//////////////////////////////////////
// Folders and core params settings //
//////////////////////////////////////

F3::set('DEBUG',3);
F3::set('UI','../ui/');
F3::set('IN_DEV', false); // в разработке или запущен

///////////////////
// Mail settings //
///////////////////

F3::config('../config/mail.cfg');

///////////////////////////////////////////////////////////////
// Retrieving database setting and establishing the connection //
///////////////////////////////////////////////////////////////

require_once "../config/db.php";

F3::set('DB',
	new DB\SQL(
		'mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME,
		DB_USERNAME,
		DB_PASSWORD
	)
);

/////////////////////////////////////////
// Retrieving cookies and setting user //
/////////////////////////////////////////

F3::set('USER', '');

if(F3::get('COOKIE.login')) {
	$name = F3::get('COOKIE.login');
	$pw = F3::get('COOKIE.pw');
	$auth = attempt($name, $pw, true);
	if($auth) {
		F3::set('users', F3::get('DB')->exec("SELECT * FROM ".DB_USERS_TABLE.";"));
	}
}

///////////////////////////
// Additional parameters //
///////////////////////////

F3::set('pagenames', array(
	'blog' 		=> 'Блог',
	'contacts' 	=> 'Контакты',
	'about' 	=> 'О нас',
));

////////////
// Routes //
////////////

F3::route('GET /',
	function() {
		if( !F3::get('IN_DEV') or F3::get('USER') ) {
			F3::set('content', 'main');
		} else {
			F3::set('content', 'maintenance');
		}
		echo Template::instance()->render('index.html');
	}
);

F3::route('GET /blog',
	function() {
		F3::set('content', 'blog');
		F3::set('posts', F3::get('DB')->exec("SELECT * FROM ".DB_POSTS_TABLE." ORDER BY created_at DESC;"));
		echo Template::instance()->render('index.html');
	}
);

F3::route('GET /@page',
	function () {
		$page = F3::get('PARAMS.page');
		if( file_exists("../ui/page.$page.html") and ( !F3::get('IN_DEV') or F3::get('USER') ) ) {
			F3::set('content', "$page");
			echo Template::instance()->render('index.html');
		} else {
			header("HTTP/1.0 404 Not Found");
			echo Template::instance()->render('404.html');
		}
	}
);

F3::route('POST /newapp',
	function() {
		$name 	 = F3::get('POST.name');
		$contact = F3::get('POST.contact');

		if($name === "" || !( filter_var($contact, FILTER_VALIDATE_EMAIL) || validatePhone($contact) ) ) {
			echo "bad";
		} else {
			$app = new DB\SQL\Mapper(F3::get('DB'), DB_APPS_TABLE);
			$app->name = $name;
			$app->contact = $contact;
			$success = $app->save();
			$sent = false;

			if($success) {
				F3::set('name', $name);
				F3::set('contact', $contact);

				$sent = mail(
					F3::get('to_email'),
					F3::get('mail_subject'),
					Template::instance()->render('appmail.html', 'text/html'),
					"Content-type: text/html; charset=UTF-8\nTo: ".F3::get('to_email')."\nReply-To: ".F3::get('from_email')."\nFrom: ".F3::get('from_email')
				);
			}

			echo json_encode(
				array(
					'db_saved' => !!$success,
					'email_sent' => $sent,
					'to' => F3::get('to_email'),
					'from' => F3::get('from_email')	
				)
			);
		}
	}
);

F3::route('POST /passchange/@user',
	function() {
		$user 		= F3::get('PARAMS.user');
		$oldpass	= F3::get('POST.oldpass');
		$newpass	= F3::get('POST.newpass');

		$auth = attempt($user, $oldpass);
		if($auth) {
			$user = F3::get('USER');
    		$user->pw = hash('gost', $newpass);
    		$user->save();

    		echo json_encode(
    			array(
    				'success' => true,
    				'newpass' => $user->pw
    			)
    		);
		} else {
			echo json_encode(
    			array(
    				'success' => false,
    			)
    		);
		}
	}
);

F3::route('POST /adduser',
	function() {
		$login 	= F3::get('POST.login');
		$pw 	= F3::get('POST.pw');
		if(!$login || !$pw) {
			echo json_encode(
				array(
					'success' => false
				)
			);
			return false;
		}
		$user = new DB\SQL\Mapper(F3::get('DB'), DB_USERS_TABLE);
		$user->login = $login;
		$user->pw = hash('gost', $pw);
		$success = $user->save();
		echo json_encode(
			array(
				'success' => !!$success
			)
		);
	}
);

F3::route('POST /login',
	function() {
		$login 	= F3::get('POST.login');
		$pw 	= F3::get('POST.pw');

		$auth = attempt($login, $pw);
		if($auth) {
			$login  = F3::get('USER')->login;
			$pw 	= F3::get('USER')->pw;
		} else {
			$login = '';
			$pw = '';
		}
		echo json_encode(
			array(
				'success' 	=> $auth,
				'login' 	=> $login,
				'pw'		=> $pw
			)
		);
	}
);

F3::route('POST /newpost',
	function() {
		$post = new DB\SQL\Mapper(F3::get('DB'), DB_POSTS_TABLE);
		$post->title 	= htmlspecialchars(F3::get('POST.title'));
		$post->subtitle	= htmlspecialchars(F3::get('POST.subtitle'));
		$post->content	= htmlspecialchars(F3::get('POST.content'));
		$success = $post->save();
		echo json_encode(
			array(
				'success' => !!$success,
				'params' => F3::get('POST')
			)
		);
	}
);

F3::route('POST /delpost/@id',
	function() {
		$post = new DB\SQL\Mapper(F3::get('DB'), DB_POSTS_TABLE);
		$post->load(array('id=?', F3::get('PARAMS.id')));
		$success = $post->erase();
		echo json_encode(
			array(
				'success' => !!$success
			)
		);
	}
);

F3::run();
