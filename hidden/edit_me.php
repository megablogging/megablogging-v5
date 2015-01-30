<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("act/edit_me.mgb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit My Profile - Admin Megablogging</title>
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
                    <li class="active">Edit My Profile</li>	 
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
								$messages = "<strong>Success!</strong> Update Your Profile!";
							}else if($msg==2){
								$m_tipe = 'danger';
								$messages = "<strong>Error!</strong>... error while saving data to database!";
							}else if($msg==3){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... Update Your Password!";
							}else if($msg==4){
								$m_tipe = 'danger';
								$messages = "<strong>Error!</strong>... error while update password to database!";
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
                                <h3 class="panel-title"><i class="fa fa-user"></i> Profile</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
							<div class='panel-body'>
								<form action='' method='post'>
								<div class='form-group'>
									<label>Name</label>
									<input required type='text' name='name' class='form-control' value='<?PHP echo $a_name; ?>'/>
								</div>
								<div class='form-group'>
									<label>Username</label>
									<input required type='text' name='username' class='form-control' value='<?PHP echo $a_username; ?>'/>
								</div>
								<div class='form-group'>
									<label>Email</label>
									<input required type='text' name='email' class='form-control' value='<?PHP echo $a_email; ?>'/>
								</div>
								<div class='form-group'>
									<label>Image/Photo Profile</label>
									<input required type='text' name='image' class='form-control' value='<?PHP echo $a_image; ?>'/>
								</div>
								<div class='form-group'>
									<label>Website/Social Media Link</label>
									<input type='text' name='link' class='form-control' value='<?PHP echo $a_link; ?>'/>
								</div>
								<div class='form-group'>
									<label>Bio/About Me</label>
									<textarea name='bio' class='form-control'><?PHP echo $a_bio; ?></textarea>
								</div>
								<button class='btn btn-success btn-sm'><i class='fa fa-save'></i> Save</button>
								<input type='hidden' name='act' value='e_profile'/>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-danger'>
							<div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-lock"></i> Change Password</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
							<div class='panel-body'>
								<form action='' method='post'>
								<div class='form-group'>
									<label>Current Password</label>
									<input required type='password' name='old_pass' class='form-control'/>
								</div>
								<div class='form-group'>
									<label>New Password</label>
									<input required type='password' name='new_pass' class='form-control'/>
								</div>
								<div class='form-group'>
									<label>Retype Password</label>
									<input required type='password' name='r_pass' class='form-control'/>
								</div>
								<button class='btn btn-success btn-sm'><i class='fa fa-save'></i> Save</button>
								<input type='hidden' name='act' value='e_pass'/>
								</form>
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
