<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="/css/normalize.css">
        <?php if ($content == 'main' or $content === 'maintenance'): ?>
            
                <title>ООО "Уфаэнерготренд" - комплексные решения проблем энергосбережения</title>
                <link rel="stylesheet" href="css/reveal.min.css">
            
            <?php else: ?>
                <title><?php echo $pagenames[$content]; ?> - ООО "Уфаэнерготренд"</title>
            
        <?php endif; ?>
        <?php if (($content == 'blog' or $content == 'post') and $USER and $USER->login): ?>
            
                <link rel="stylesheet" type="text/css" href="/css/bootstrap-wysihtml5.css"></link>
                <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css"></link>
            
        <?php endif; ?>
        <link rel="stylesheet" href="/css/jquery.fancybox.css">
        <link rel="stylesheet" href="/css/screen.css">
        <!-- <script src="js/vendor/modernizr-2.6.2.min.js"></script> -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>
    </head>
    <body class="screen">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

        <?php echo $this->render('page.'.$content.'.html',$this->mime,get_defined_vars()); ?>

        <!-- Admin panel -->
        <?php if ($USER && $USER->login): ?>
            
                <?php echo $this->render('panel.html',$this->mime,get_defined_vars()); ?>
            
        <?php endif; ?>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
