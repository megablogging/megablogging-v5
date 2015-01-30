<?PHP
/**
 * Default TEMPLATE
 * Copyright Megasoft Informer 2014
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 * Di Buat Oleh @Dewa_1995
 */
//load laman utama di sini
require_once(dirname(__FILE__)."/konfigurasi-template.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<?PHP
	echo "
	<title>404 Page Not Found! - $c_title</title>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='404 Page Not Found!'>
    <meta name='author' content='Dewa'>
	";
?>
<link rel='stylesheet' type='text/css' href='<?PHP echo TEMPLATE_URL; ?>/bootstrap-theme/<?PHP echo $tema; ?>.css'/>
<?PHP echo $app->load_stylesheet();//required ?>
<?PHP echo $app->load_javascript();//required ?>
</head>
<body style='background:url(<?PHP echo $c_background; ?>) fixed center'>
<?PHP require_once(TEMPLATE_DIR . '/header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
				<div class='<?PHP echo "$ribbon_article_style $ribbon_article" ?> ribbon'>404 Page Not Found!</div>
				<div class='well'>
				<center>
				<div class='text_other_page' style='margin-top:-50px'>404</div>
				<div id='text' style='font-family:pirata-one;margin-top:-40px;font-size:20px;'>An error has occured. Page not found!</div>
				<div style='margin-top:40px;margin-bottom:10px;'>
				<a href='<?PHP echo $c_url; ?>' target='_blank' class='btn btn-info' style='margin-top:-40px;font-family:pirata-one;font-size:15px'><dewa class='icon icon-home'> </dewa> Back To Dashboard</a>
				<a href='//www.megablogging.org' target='_blank' class='btn btn-info' style='margin-top:-40px;font-family:pirata-one;font-size:15px'><dewa class='icon icon-download-alt'> </dewa> Download This CMS</a>
				</div>
				</center>
				</div> 
            </div>
        </div>
    </div>
    <!-- /.container -->
	<?PHP require_once(TEMPLATE_DIR."/footer.php"); ?>
</body>
</html>