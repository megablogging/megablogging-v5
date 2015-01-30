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
if($db->num_rows("select id from article where link='$link'") == 0){
	echo "Opps,.. Article Not Found!";
	exit();
}else{
$data_a = $db->detail_artikel($link);
$a_id = $data_a['id'];
$a_title = $data_a['title'];
$a_content= $data_a['content'];
$a_hits = $data_a['hits'];
$a_time = $data_a['time'];
$a_date = $data_a['date'];
$a_link = $data_a['link'];
$a_category = $data_a['category'];
$a_cat = $data_a['category'];
$a_user = $data_a['user'];
$jumlah_category = substr_count($a_category,",");
$a_category = explode(',',$a_category);
$a_image = $data_a['image'];
$sql_update = $db->query("update article set hits=hits+1 where id='$a_id'");
$a_content = str_replace("<img ", "<img style='max-width:100%'", $a_content);
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
    <meta name='description' content='Read Article $a_title'>
	<meta name='keywords' content='Read Article $a_title, $c_title'>
    <meta name='author' content='Dewa'>
	";
?>
<meta property='og:image' content='<?PHP echo "$a_image"; ?>'/>
<link rel='image_src' href='<?PHP echo "$a_image"; ?>'/>
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
				<div itemscope itemtype="http://schema.org/BlogPosting" id='mypost'>
					<div class='<?PHP echo "$ribbon_article_style $ribbon_article" ?> ribbon' itemprop="name"><a href='<?PHP echo $app->get_link($link); ?>' rel="bookmark" itemprop="url" href></a><?PHP echo $a_title; ?></div>
					<div class='well article'>
						<div class="meta" style='border-top:1px solid #eee;border-bottom: 1px solid #eee;margin-top:-15px'>
							<span class="date" itemprop="datePublished" content='<?PHP echo $a_date; ?>'><i class="fa fa-calendar"></i><?PHP echo TanggalIndonesiaString($a_date). " - $a_time"; ?></span>
							<span class="author" rel="author"><i class="fa fa-user"></i>By <?PHP echo $db->_author_this_post($a_id); ?></span>
							<span class="tag" itemprop="keywords"><i class="fa fa-tags"></i><?PHP echo $db->_get_category($a_cat); ?></span>
							<span class="hits"><i class="fa fa-signal"></i><?PHP echo "$a_hits hits"; ?></span>
						</div>
						<div class="" style='margin-top:20px' itemprop="articleBody">
							<p class="description text-justify"><?PHP echo $a_content; ?></p>	
						</div>
					</div> 
				</div>
				<div class='<?PHP echo "$ribbon_article_style $ribbon_article" ?> ribbon'>Related Article</div>
				<div class='well' id='related_article'>
					<?PHP require_once(dirname(__FILE__)."/include/related_article.php"); ?>
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