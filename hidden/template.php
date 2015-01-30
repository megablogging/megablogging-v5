<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
require_once("act/template.mgb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Templates - Admin Megablogging</title>
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
                    <li class="active">Templates</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
				<!-- messages -->
				<div id='messages' style='margin-bottom:10px'>
					<?PHP
						if (isset($_GET['msg'])){
							require_once("anti_xss.php");
							$msg = $_GET['msg'];
							if ($msg==1){ //success install new template
								$isi=$_GET['isi'];
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong> To use template : $isi!";
							}else if($msg==2){
								$isi=$_GET['isi'];
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... To Delete Template : $isi!";
							}else{
								$m_tipe = 'danger';
								$messages = "<strong>Error!</strong>... Nothing";
							}
							echo "
							<div class='alert alert-$m_tipe'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								$messages
							</div>
							";
						}
					?>
				</div>
				
                <div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-default'>
							<div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-th-large"></i> All Templates</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
							<div class='panel-body'>
								<table class="table table-hover table-bordered">
								  <thead>
									<tr>
									  <th>No</th>
									  <th>Template</th>
									  <th>Status</th>
									  <th>Action</th>
									</tr>
								  </thead>
								  <tbody>
								  <?PHP
									$no = 1;
									$ngek = ROOT.'/template/';
									$handle = opendir($ngek);  
									$klik = array('xml');  
									while(false !== ($file = readdir($handle))){  
									$ftp = explode('.', $file); 
									$template_name = str_replace('.xml', '', $file);
									if ($template_name == $c_template){
									$status = "<font color='green'>Use</font>";
									}
									else{
									$status = "<font color='red'>Not Use</font>";
									}
									if(in_array(end($ftp), $klik )){
								  ?>
									<tr>
									  <td><?PHP echo $no; ?></td>
									  <td><?PHP echo "$template_name"; ?></td>
									  <th><?PHP echo "$status"; ?></th>
									  <td>
									  <div class="btn-group">
									  <?PHP
									  if ($status == "<font color='red'>Not Use</font>"){
									  echo "<a href='detail_template.mgb?name=$file' class='btn btn-xs btn-primary' rel='tooltip' data-toggle='tooltip' data-placement='top' data-original-title='View Detail Template'> <i class='fa fa-search'></i> </a> ";
									  echo "<a href='template.mgb?act=use&file=$file' class='btn btn-xs btn-success' rel='tooltip' data-toggle='tooltip' data-placement='top' data-original-title='Use This Template'> <i class='fa fa-check'></i> </a> ";
									  echo "<a href='template.mgb?act=delete&file=$file' class='btn btn-xs btn-danger' rel='tooltip' data-toggle='tooltip' data-placement='top' data-original-title='Uninstall This Template'> <i class='fs fs-remove'></i> </a> ";
									  }else{
									  echo "<a href='detail_template.mgb?name=$file&use=1' class='btn btn-xs btn-primary' rel='tooltip' data-toggle='tooltip' data-placement='top' data-original-title='View Detail Template'> <i class='fa fa-search'></i> </a> ";
									  }
									  ?>
									  </div>
									  </td>
									</tr>
								   <?PHP
									$no++;
									}}
								   ?>
								  </tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-success' id='install'>
							<div class="panel-heading">
                                <h3 class="panel-title"><i class="fs fs-upload-3"></i> Install New Template</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
							<div class='panel-body'>
								<form action="proses/install_template.php" method="post" enctype="multipart/form-data" id="UploadForm">
									<div class="form-group">
										<div id='form-up'>
										<input id="file" type="file" class="file" data-preview-file-type="any" name="file_template">
										<button style='margin-top:10px' id="SubmitButton" class='btn btn-primary'/><i class='fa fa-cloud-upload'></i> Upload And Install Now</button>
										</div>
										<div id='action' style='margin-top:10px'>
										<a id='new' href='template.mgb' class='btn btn-success' style='display:none'><i class='fa fa-upload'></i> Install Another Template</a>
										<a id='cancel' href='template.mgb' class='btn btn-danger' style='display:none'><i class='fa fa-power-off'></i> Abort Installation</a>
										</div>
									</div>
								</form>
								<div id='hasilnya'>
									<div id='loader' style='display:none'>
										<img src='assets/images/loader.gif'/>
									</div>
									<div id="output" style='margin-bottom:10px;border:solid 1px #f5f5f5;padding:10px;display:none'></div>
								</div>
								<div class="panel panel-info">
									<div class="panel-heading"><i class='fa fa-list'></i> Information</div>
									<div class='panel-body'>
										<ul class="styled-list">
											<?PHP require_once("inc/php.ini.php"); ?>
											<li>Allowed extension only <span class='text-danger'>zip</span></li>
											<li>For Get More Valid/Origin Template Megablogging, Visit <a class='text-success' href='http://template.megablogging.org'>http://template.megablogging.org</a> or <a href='http://blog.mas-dewa.com/category/template-megablogging' class='text-danger'>http://blog.mas-dewa.com/category/template-megablogging</a></li>
											<li>Your Server Just Allowed, Max File Size For Upload : <span class='text-danger'><?PHP echo $a_size_max; ?></span></li>
										</ul>
									</div>
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
				var loader     		= $('#loader');
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
