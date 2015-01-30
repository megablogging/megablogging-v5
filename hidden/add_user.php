<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
require_once("act/user.mgb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add New User - Admin Megablogging</title>
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
                    <li class="active">Add New User</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
                <div class='row'>
					<div class='col-md-12'>
						<!-- content -->
						<div class='panel panel-success'>
							<div class='panel-heading'>Add New User</div>
							<div class='panel-body'>
								<form action='' method='post'>
									<div class='form-group'>
										<label>Name</label>
										<input type='text' name='name' class='form-control' required>
									</div>
									<div class='form-group'>
										<label>Username</label>
										<input type='text' name='username' class='form-control' required>
									</div>
									<div class='form-group'>
										<label>Email</label>
										<input type='text' name='email' class='form-control' required>
									</div>
									<div class='form-group'>
										<label>Password</label>
										<input type='text' name='password' class='form-control' required>
									</div>
									<div class='form-group'>
										<label>Image/Photo-Profile</label>
										<input type='text' name='image' class='form-control' required>
									</div>
									<div class='form-group'>
										<label>Type</label>
										<select name='level' class='form-control'>
											<option value='1'>Admin</option>
											<option value='2'>Publisher</option>
										</select>
									</div>
									<input type='hidden' name='act' value='add'/>
									<button class='btn btn-success'><i class='fa fa-save'></i> Save</button>
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
