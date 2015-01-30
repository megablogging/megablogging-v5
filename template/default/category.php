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
if (isset($_GET['cat'])){
	$cat = $_GET['cat'];
	$cat2 = str_replace('-',' ',$cat);
	if ($db->num_rows("select id from category where link='$cat'") == 0){ //jika kategorinya gak ada di db maka alihkan
		header("location:$c_url");
	}
}
else{
	header("location:$c_url");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<?PHP
	if (isset($_GET['pg'])){
		$page = abs((int)$_GET['pg']);
		echo "
		<title>$c_title - Category $cat2 in page $page</title>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='$c_title - Category $cat2 in page $page'>
		<meta name='keywords' content='$c_title - Category $cat2 in page $page, $c_title - page $page, view article in page $page'>
		<meta name='author' content='Dewa'>
		";
	}
	else{
		echo "
		<title>$c_title - Category $cat2</title>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='$c_title - Category $cat2'>
		<meta name='keywords' content='$c_title - Category $cat2'>
		<meta name='author' content='Dewa'>
		";
		$page = 1;
	}
//untuk pelengkap file load_content.php
$paging = "$c_url/$uri_category/$cat"; //default url untuk pagingnya 
$calc = $c_perpage * $page;
$start = $calc - $c_perpage;
$data_art = $db->select("article", "link, title, image, shoot, date, category, id, time", "category like '%$cat2%'", "article.date DESC, article.time DESC", "$start, $c_perpage");
$total_artikel = $db->num_rows("select id from article where category like '%$cat2%'");
?>
<meta name='og:image' property='og:image' content='<?PHP echo "$c_url/mgb-dir/assets/logo.png"; ?>'/>
<link rel='image_src' href='<?PHP echo "$c_url/mgb-dir/assets/logo.png"; ?>'/>
<link rel='stylesheet' type='text/css' href='<?PHP echo TEMPLATE_URL; ?>/bootstrap-theme/<?PHP echo $tema; ?>.css'/>
<?PHP echo $app->load_stylesheet();//required ?>
<?PHP echo $app->load_javascript();//required ?>
</head>
<body style='background:url(<?PHP echo $c_background; ?>) fixed center'>
<?PHP require_once(TEMPLATE_DIR . '/header.php'); ?>
<?PHP require_once(TEMPLATE_DIR . '/load_content.php'); ?>
<?PHP require_once(TEMPLATE_DIR . "/footer.php"); ?>
</body>
</html>