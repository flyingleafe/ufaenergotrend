<?php
function validatePhone($phone) {
    $re = "/^(\+7[-. ]?|8[ .-]?)?(\()?([0-9]{3})(?(2)\))[-. ]?(([0-9]{2})|([0-9]{3}))[-. ]?([0-9]{2})[-. ]?(?(6)([0-9]{2})|([0-9]{3}))$/";
    return preg_match($re, $phone);
}

function attempt($login, $pw, $hashed = false) {
    if(!$hashed) {
        $pw = hash('gost', $pw);
    }
    $user = new DB\SQL\Mapper(F3::get('DB'), DB_USERS_TABLE);
    $user->load(array('login=?', $login));

    if($user->pw === $pw) {
         F3::set('USER', $user);
         return true;
    }
    return false;
}