<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
require_once("act/setting.mgb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Website Configuration - Admin Megablogging</title>
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
                    <li class="active">Web Config</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
				<!-- messages -->
				<div id='messages' style='margin-bottom:10px'>
					<?PHP
						if (isset($_GET['msg'])){
							require_once("anti_xss.php");
							$msg = $_GET['msg'];
							if ($msg==1){ //success add new category
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong> Saving Basic Configuration Website!";
							}else if($msg==2){
								$m_tipe = 'danger';
								$messages = "<strong>Error!</strong>... error while saving data to config.ini.php!";
							}else if($msg==3){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... Change Main Favicon Website!";
							}else if($msg==4){
								$m_tipe = 'danger';
								$messages = "<strong>Error!</strong>... Change Main Logo Website!";
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
                                <h3 class="panel-title"><i class="fa fa-cog"></i> Basic Configuration</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
							<div class='panel-body'>
								<form action='' method='post'>
								<div class='form-group'>
									<label>Site Title *</label>
									<input required type='text' name='title' class='form-control' value='<?PHP echo $c_title; ?>'/>
								</div>
								<div class='form-group'>
									<label>Webmaster Email *</label>
									<input required type='text' name='email' class='form-control' value='<?PHP echo $c_email_admin; ?>'/>
								</div>
								<div class='form-group'>
									<label>Site URL *</label>
									<input required type='text' name='site_url' class='form-control' value='<?PHP echo $c_url; ?>'/>
								</div>
								<div class='form-group'>
									<label>Shorthen URL/Go URL * </label> <i>[you can change it to be subdomain for example http://go.domain.com]</i>
									<input required type='text' name='go_url' class='form-control' value='<?PHP echo $c_go_url; ?>'/>
								</div>
								<div class='form-group'>
									<label>Total Show Post Perpage *</label>
									<input required type='text' name='perpage' class='form-control' value='<?PHP echo $c_perpage; ?>'/>
								</div>
								<div class='form-group'>
									<label>Total Show Data in Table per page *</label>
									<input type='text' name='max' class='form-control' value='<?PHP echo $c_max_per_table; ?>'/>
								</div>
								<div class='form-group'>
									<label>Background Site *</label>
									<input type='text' name='background' class='form-control' value='<?PHP echo $c_background; ?>'/>
								</div>
								<div class='form-group'>
									<label>Type Site *</label>
									<select name='type_site' class='form-control'>
										<option value='<?PHP echo $c_type_site; ?>'><?PHP echo $c_type_site; ?></option>
										<option value='Offline'>Offline</option>
										<option value='Online'>Online</option>			
									</select>
								</div>
								<div class='form-group'>
									<label>Type Text Editor *</label>
									<select name='type_editor' class='form-control'>
										<option value='<?PHP echo $c_editor; ?>'><?PHP echo "$c_editor -> in use now"; ?></option>
										<option value='simple'>Simple Editor</option>
										<option value='ckeditor'>CKEditor [Full]</option>			
									</select>
								</div>
								<div class='form-group'>
									<label>Type Sidebar Admin Page *</label>
									<select name='type_sidebar' class='form-control'>
										<option value='<?PHP echo $c_sidebar; ?>'><?PHP echo "$c_sidebar -> in use now"; ?></option>
										<option value='mini'>Mini Sidebar</option>
										<option value='full'>Standar/Full Sidebar</option>			
									</select>
								</div>
								<button class='btn btn-success btn-sm'><i class='fa fa-save'></i> Save</button>
								<input type='hidden' name='act' value='e_basic'/>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-default'>
							<div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-picture-o"></i> Logo And Favicon Your Site</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
							<div class='panel-body'>
									<div class='alert alert-warning'>
										If Your Favicon or your logo isn't change after you canged it, do this for fix it.
										<br>
										- Reload the page &rarr; <b>CTRL + R</b>
										<br>
										- If the favicon still isn't change, <b>restart</b> your computer
									</div>
									<div class='row'>
										<div class='col-md-4'>
											<div class='well'>
												<label class='text-primary'>Favicon Your Site</label>
												<hr>
												<img src='<?PHP echo "$c_url/favicon.ico"; ?>' style='max-width:100%'/>
												<hr>
												<label class='text-primary'>Change Favicon Your Site</label><br>
												<form method="post" enctype="multipart/form-data" action='proses/change_favicon.php'>
													<div class='form-group'>
														<input type='file' id='faviconimg' name='favicon'/>
													</div>
													<button class='btn btn-xs btn-success'>Change Now</button>
												</form>
												<br>
												<b>Note</b> : file allowed : <span class='text-danger'>|ico|jpg|png|jpeg|bmp|gif|</span>
											</div>
										</div>
										<div class='col-md-8'>
											<div class='well'>
												<label class='text-primary'>Logo Your Site</label>
												<hr>
												<img src='<?PHP echo "$c_url/logo.png"; ?>' style='max-width:100%'/>
												<hr>
												<label class='text-primary'>Change Logo Your Site</label><br>
												<form method="post" enctype="multipart/form-data" action='proses/change_logo.php'>
													<div class='form-group'>
														<input type='file' id='faviconimg' name='logo'/>
													</div>
													<button class='btn btn-xs btn-success'>Change Now</button>
												</form>
												<br>
												<b>Note</b> : file allowed : <span class='text-danger'>|jpg|png|jpeg|bmp|gif|</span>
											</div>
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
</body>
</html>
