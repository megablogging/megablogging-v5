<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Upload Files - Admin Megablogging</title>
    <?PHP require_once(dirname(__FILE__)."/inc/css.php"); ?>
	<link rel='stylesheet' type='text/css' href="assets/plugins/dropzone/css/dropzone.css">
</head>
<body>
        <div id="wrapper" <?PHP echo $c_sidebar_set; ?>>
		<?PHP require_once(dirname(__FILE__)."/inc/navbar.php"); ?>
        <?PHP require_once(dirname(__FILE__)."/inc/sidebar.php"); ?>
        <div id="main-container">
            <div id="breadcrumb">
                <ul class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="//www.megablogging.org"> Admin</a></li>
                    <li class="active">Upload Files</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
				<?PHP require_once("inc/php.ini.php"); ?>
				<div class='alert alert-info'>
				For View All Files which has uploaded. you can check it at "Menu All Files" or you can <a href='files.mgb'>click here</a><br>
				Allowed Extension : <span class='text-danger'>zip|rar|docx|doc|exe|pdf|ppt|pptx|mp3|mp4</span><br>
				Your Server Just Allowed, Max File Size For Upload : <span class='text-danger'><?PHP echo $a_size_max; ?></span>
				</div>
                <div class="row">
					<div class="col-md-12">
						<div id="dropzone">
							<form action="proses/up_files.php" class="dropzone" id="my-awesome-dropzone">
								<div class="fallback">
									<input name="file" type="file" multiple="" />
								</div>
							</form>
						</div>
						<!-- <form action="proses/up_files.php" class="dropzone" id="my-awesome-dropzone"></form> -->
                    </div>
				</div>
            </div>
        </div><!-- /main-container -->
        <?PHP require_once(dirname(__FILE__)."/inc/footer.php"); ?>
    </div><!-- /wrapper -->

    <a href="#" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
    <?PHP require_once(dirname(__FILE__)."/inc/js.php"); ?>
	<script type="text/javascript" src="assets/plugins/dropzone/dropzone.min.js"></script>
</body>
</html>
