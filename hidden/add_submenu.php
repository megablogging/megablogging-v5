<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add New SubMenu - Admin Megablogging</title>
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
                    <li class="active">Add New SubMenu</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
                <div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-success'>
							<div class='panel-heading'>Add New SubMenu</div>
								<div class='panel-body'>
									<form method='post' action='menu.mgb'>
										<div class='form-group'>
											<label>SubMenu Name :</label>
											<input required type='text' name='submenu_name' class='form-control'/>
										</div>
										<div class='form-group'>
											<label>In Menu :</label>
											<select name='submenu_menu' class='form-control'>
												<?PHP
												$all_menu_q = $db->fetch_multiple("select id, name from menu where type='2'");
												foreach($all_menu_q as $all_menu){
												?>
												<option value='<?PHP echo $all_menu['id']; ?>'><?PHP echo $all_menu['name']; ?></option>
												<?PHP } ?>
											</select>
										</div>
										<div class='form-group' style='padding:10px;background:#dcdcdc'>
											<label>Link :</label>
											<input placeholder='http://megablogging.org' type='text' name='submenu_link' class='form-control'/>
											<label>Type Link Target :</label>
											<select name='submenu_target' class='form-control'>
											<option value='_self'>Same Windows (_self)</option>
											<option value='_blank'>New Windows (_blank)</option>
											<option value='_top'>Topmost Windows (_top)</option>
											<option value='_parent'>Parent Windows (_parent)</option>
											</select>
										</div>
										
										<input type='hidden' name='act' value='add_sm'/>
										<button class='btn btn-success btn-sm'><i class='fa fa-save'></i> Save</button>
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
