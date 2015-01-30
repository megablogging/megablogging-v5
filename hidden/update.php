<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
require_once("act/template.mgb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Update Engine Megablogging - Admin Megablogging</title>
    <?PHP require_once(dirname(__FILE__)."/inc/css.php"); ?>
	<link rel='stylesheet' type='text/css' href='assets/css/fileinput.css'/>
</head>
<body>
    <div id="wrapper" <?PHP echo $c_sidebar_set; ?>>
		<?PHP require_once(dirname(__FILE__)."/inc/navbar.php"); ?>
        <?PHP require_once(dirname(__FILE__)."/inc/sidebar.php"); ?>
        <div id="main-container">
            <div id="breadcrumb">
                <ul class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="//www.megablogging.org"> Admin</a></li>
                    <li class="active">Updater</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
				<?PHP require_once("act/check_update.mgb"); ?>
				<?PHP if($type_site == 'Offline'){ ?>
				<div class='alert alert-danger'>
				Type Of Your Site Is "Offline", So No feature updater
				</div>
				<?PHP }else{ 
				if($updated == false){
				?>
				<div class='row'>
					<div class='col-md-12 col-sm-12'>
						<div class='panel panel-success' id='install'>
							<div class="panel-heading">
                                <h3 class="panel-title">Update Dirrectly From Server Megablogging</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
							<div class='panel-body'>
								<div class='alert alert-info'>
								If You Use This Type, you just click update button, and wait until progress updating finish
								</div>
								<form action="proses/update_mgb.php" method="post" enctype="multipart/form-data" id="UploadForm">
									<div class="form-group">
										<button style='margin-top:10px' id="SubmitButton" class='btn btn-primary'/>Update Your Megablogging Now</button>
										<div id='action' style='margin-top:10px'>
										<a id='cancel' href='template.mgb' class='btn btn-danger' style='display:none'><i class='fa fa-power-off'></i> Abort Update</a>
										</div>
									</div>
								</form>
								<div id='hasilnya'>
									<div id='loader' style='display:none'>
										<img src='assets/images/loader.gif'/>
									</div>
									<div id="output" style='margin-bottom:10px;border:solid 1px #f5f5f5;padding:10px;display:none'></div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				
				<div class='row'>
					<div class='col-md-12 col-sm-12'>
						<div class='panel panel-danger' id='install'>
							<div class="panel-heading">
                                <h3 class="panel-title">Manual Update</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
							<div class='panel-body'>
								1. Download Lastest Updater Megablogging : <a href='http://get.megablogging.org/lastest-update.zip'>http://get.megablogging.org/lastest-update.zip</a><br>
								2. Upload <span class='text-success'>lastest-update.zip</span> into your directory megablogging on your server</br>
								3. extract it.<br>
								4. and then download <a class='text-danger' href='http://get.megablogging.org/lastest-update.sql'>lastest-update.sql</a><br>
								5. import <span class='text-success'>lastest-update.sql</span> into your database.
							</div>
						</div>
					</div>
				</div>
				<?PHP }else{ ?>
				<div class='alert alert-warning'>
				Your Megablogging Has Been Updated, The Lastest Version Megablogging Is "Version <?PHP echo _V_ ?>"
				</div>
				<?PHP }} ?>
			</div>
    </div><!-- /main-container -->
	<?PHP require_once(dirname(__FILE__)."/inc/footer.php"); ?>
    </div><!-- /wrapper -->
    <a href="#" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
    <?PHP require_once(dirname(__FILE__)."/inc/js.php"); ?>
	<script type='text/javascript' src='assets/js/fileinput.min.js'></script>
	<script type='text/javascript' src='assets/js/jquery.form.js'></script>
	<script>
	$(document).ready(function() {
				//elements
				var progressbox     = $('#progressbox');
				var progressbar     = $('#progressbar');
				var statustxt       = $('#statustxt');
				var submitbutton    = $("#SubmitButton");
				var cancelbtn 		= $("#cancel");
				var anotherbtn		= $("#new");
				var myform          = $("#UploadForm");
				var output          = $("#output");
				var file1			= $("#file");
				var loader			= $("#loader");
				var completed       = '0%';
						$(myform).ajaxForm({
								beforeSend: function() { //brfore sending form
								//submitbutton.attr('disabled', ''); // disable upload button
								submitbutton.hide();
								cancelbtn.show();
								statustxt.empty();
								output.slideUp();
								loader.slideDown(); //show progressbar
								progressbar.width(completed); //initial value 0% of progressbar
								statustxt.html(completed); //set status text
								statustxt.css('color','#000'); //initial color of status text
							},
							uploadProgress: function(event, position, total, percentComplete) { //on progress
								progressbar.width(percentComplete + '%') //update progressbar percent complete
								statustxt.html(percentComplete + '%'); //update status text
								if(percentComplete>50)
									{
										statustxt.css('color','#fff'); //change status text to white after 50%
									}
								},
							complete: function(response) { // on complete
								output.html(response.responseText); //update element with received data
								submitbutton.removeAttr('disabled'); //enable submit button
								file1.fadeOut();
								loader.slideUp(); // hide progressbar
								output.fadeIn();
								cancelbtn.fadeOut();
								anotherbtn.fadeIn();
								$("#form-up").fadeOut();
							}
					});
				});
	</script>
</body>
</html>
