<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
if (isset($_GET['name'])){
	require_once("anti_xss.php");
	$template_file = $_GET['name'];
	$file = ROOT."/template/$template_file";
	if (file_exists($file)){
		$xml = simplexml_load_file($file);
		$template_author = $xml->author;
		$template_name = $xml->template_name;
		$template_folder = $xml->template_folder;
		$author_email = $xml->author_email;
		$author_link = $xml->author_link;
		$template_version = $xml->template_version;
		$template_link = $xml->template_link;
		$template_image = $xml->template_image;
		$date_create = $xml->date_create;
		$template_description = $xml->description;
		if ($template_image == "screenshoot.jpg"){
			$template_image = "$c_url/template/$template_folder/screenshoot.jpg";
		}
	}else{
		echo "Error Code 404. [File Template Not Found]";
		exit();
	}	
}else{
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Detail Template -> <?PHP echo $template_name; ?> - Admin Megablogging</title>
    <?PHP require_once(dirname(__FILE__)."/inc/css.php"); ?>
</head>
<body>
    <div id="wrapper" <?PHP echo $c_sidebar_set; ?>>
		<?PHP require_once(dirname(__FILE__)."/inc/navbar.php"); ?>
        <?PHP require_once(dirname(__FILE__)."/inc/sidebar.php"); ?>
        <div id="main-container">
            <div id="breadcrumb">
                <ul class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="//www.megablogging.org"> Admin</a></li>
                    <li class="active">Detail Template</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
                <div class='row'>
					<div class='col-md-12'>
						<!-- content -->
						<div class='panel panel-default'>
							<div class='panel-heading'><i class='fa fa-th-large'></i> <b><?PHP echo $template_name; ?></b></div>
							<div class='panel-body'>
								<div class='btn-group' style='margin-bottom:10px'>
								<?PHP if(isset($_GET['use'])){?>
								
								<?PHP }else{ ?>
									<a href='template.mgb?act=use&file=<?PHP echo $template_file; ?>' class='btn btn-success'><i class='fa fa-check'></i> Use This Template</a>
									<a href='template.mgb?act=delete&file=<?PHP echo $template_file; ?>' class='btn btn-danger'><i class='fs fs-remove'></i> Unistall This Template</a>
								<?PHP } ?>
								</div>
								<table class="table table-hover table-bordered">
								  <thead>
									<tr>
									  <th>No</th>
									  <th>Tag</th>
									  <th>Content</th>
									</tr>
									<tr class="data">
									<td class="data" width="30px">1</td>
									<td class="data">Template Name</td>
									<td class="data"><b><?PHP echo "<a href='$template_link' target='_blank'>$template_name Version $template_version</a>"; ?></b></td>
										</tr>
										<tr class="data">
											<td class="data" width="30px">2</td>
											<td class="data">Author This Template</td>
											<td class="data"><b><?PHP echo "<a href='$author_link' target='_blank'>$template_author</a>"; ?></b></td>
										</tr>
										<tr class="data">
											<td class="data" width="30px">3</td>
											<td class="data">Email Of Author This Theme</td>
											<td class="data"><b><?PHP echo "<a href='mailto:$author_email' target='_blank'>$author_email</a>"; ?></b></td>
										</tr>
										<tr class="data">
											<td class="data" width="30px">4</td>
											<td class="data">Date Realese</td>
											<td class="data"><b><?PHP echo $date_create; ?></b></td>
										</tr>
										<tr class="data">
											<td class="data" width="30px">5</td>
											<td class="data">Template Sites</td>
											<td class="data"><b><a href="<?PHP echo $template_link; ?>" target="_blank"><?PHP echo $template_link; ?></a></b></td>
										</tr>
										<tr class="data">
											<td class="data" width="30px">6</td>
											<td class="data">Description Of This Template</td>
											<td class="data"><?PHP echo $template_description; ?></td>
										</tr>
								  </thead>
								</table>
								<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
									<div class="carousel-inner">
											<?PHP
											$ngek = ROOT."/template/$template_folder/$template_image";
											$handle = opendir($ngek);  
											$klik = array('jpg', 'png', 'bmp');
											$no_g = 1;
											while(false !== ($file = readdir($handle))){  
											$ftp = explode('.', $file); 
												if(in_array(end($ftp), $klik )){
													$files=$file;
													if ($no_g == 3){
														echo "
														<div class='item active'>
															<img style='width:100%' class='slide-image' src='$c_url/template/$template_folder/$template_image/$files' alt='$file' title='Screenshoot'/>
														</div>
														";
													}else{
														echo "
														<div class='item'>
															<img style='width:100%' class='slide-image' src='$c_url/template/$template_folder/$template_image/$files' alt='$file' title='Screenshoot'/>
														</div>
														";
													}
												}
											$no_g++;
											}
											?>
									</div>
									<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
									</a>
									<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div><!-- /main-container -->
        <?PHP require_once(dirname(__FILE__)."/inc/footer.php"); ?>
    </div><!-- /wrapper -->
    <a href="#" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
    <?PHP require_once(dirname(__FILE__)."/inc/js.php"); ?>
</body>
</html>
