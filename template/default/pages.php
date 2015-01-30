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
if (isset($_GET['link'])){
$link = $_GET['link'];
if($db->num_rows("select * from pages where link='$link'") == 0){
	echo "Opps,.. Article Not Found!";
	exit();
}else{
$data_a = $db->detail_pages($link);
$a_id = $data_a['id'];
$a_title = $data_a['title'];
$a_content= $data_a['content'];
$a_hits = $data_a['hits'];
$a_time = $data_a['time'];
$a_date = $data_a['date'];
$a_link = $data_a['link'];
$sql_update = $db->query("update pages set hits=hits+1 where id='$a_id'");
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<?PHP
	echo "
	<title>$a_title - $c_title</title>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='Read pages $a_title'>
	<meta name='keywords' content='Read pages $a_title, $c_title'>
    <meta name='author' content='Dewa'>
	";
	?>
<meta property='og:image' content='<?PHP echo "$c_url/mgb-dir/assets/logo.png"; ?>'/>
<link rel='image_src' href='<?PHP echo "$c_url/mgb-dir/assets/logo.png"; ?>'/>
<link rel='stylesheet' type='text/css' href='<?PHP echo TEMPLATE_URL; ?>/bootstrap-theme/<?PHP echo $tema; ?>.css'/>
<?PHP echo $app->load_stylesheet();//required ?>
<?PHP echo $app->load_javascript();//required ?>
</head>
<body style='background:url(<?PHP echo $c_background; ?>) fixed center'>
<?PHP require_once(TEMPLATE_DIR . '/header.php'); ?>
    <div class="container">
        <div class="row">
			<?PHP 
			if ($posisi_widget == "left"){
			echo "<div class='col-md-4 col-lg-4'>";
				require_once(TEMPLATE_DIR."/widget.php");
			echo "</div>";
			}
			?>
            <div class="col-md-8 col-lg-8">
				<div class='<?PHP echo "$ribbon_article_style $ribbon_article" ?> ribbon'><?PHP echo $a_title; ?></div>
				<div class='well article'>
					<div class="meta" style='border-top:1px solid #eee;border-bottom: 1px solid #eee;margin-top:-15px'>
						<span class="date"><i class="fa fa-calendar"></i><?PHP echo TanggalIndonesiaString($a_date). " - $a_time"; ?></span>
					</div>
					<div class="" style='margin-top:20px'>
						<p class="description text-justify"><?PHP echo $a_content; ?></p>	
					</div>
				</div> 
				
				<div class='<?PHP echo "$ribbon_article_style $ribbon_article" ?> ribbon'>Comments</div>
				<div class='well' id='comments'>
					<?PHP include(ROOT."/mgb-dir/assets/komentar.php"); ?>
				</div>
            </div>
			<?PHP 
			if ($posisi_widget == "right"){
			echo "<div class='col-md-4 col-lg-4'>";
				require_once(TEMPLATE_DIR."/widget.php");
			echo "</div>";
			}
			?>
        </div>
    </div>
    <!-- /.container -->
	<?PHP require_once(TEMPLATE_DIR."/footer.php"); ?>
</body>
</html>