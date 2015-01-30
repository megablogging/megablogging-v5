<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
if (isset($_GET['id'])){
	$idnya = $_GET['id'];
	$data_mn = $db->fetch("select * from menu where id='$idnya'");
	if ($data_mn['type'] == 1){
		$tipe_ec = "No SubMenu";
	}else{
		$tipe_ec = "Any SubMenu";
	}
}else{
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Menu <?PHP echo $idnya; ?> - Admin Megablogging</title>
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
                    <li class="active">Edit Menu</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
                <div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-success'>
							<div class='panel-heading'>Edit Menu : <?PHP echo $data_mn['name']; ?></div>
								<div class='panel-body'>
									<form method='post' action='menu.mgb'>
										<div class='form-group'>
											<label>Menu Name :</label>
											<input required type='text' name='menu_name' class='form-control' value="<?PHP echo $data_mn['name']; ?>"/>
										</div>
										<div class='form-group'>
											<label>Menu Type :</label>
											<select name='menu_type' class='form-control'>
												<option value='<?PHP echo $data_mn['type']; ?>' onclick='change_to_<?PHP echo $data_mn['type']; ?>()'><?PHP echo $tipe_ec; ?></option>
												<option value='1' onclick='change_to_1()'>No Submenu</option>
												<option value='2' onclick='change_to_2()'>Any Submenu</option>
											</select>
										</div>
										<div style='display:<?PHP if($data_mn['type']==1){echo "block";}else{echo "none";} ?>;padding:10px;background:#dcdcdc' id='advanced_1' class='form-group'>
											<label>Link :</label>
											<input placeholder='http://megablogging.org' type='text' name='menu_link' class='form-control' value="<?PHP echo $data_mn['link']; ?>"/>
											<label>Type Link Target :</label>
											<select name='menu_target' class='form-control'>
												<option><?PHP echo $data_mn['target']; ?></option>
												<option value='_self'>Same Windows (_self)</option>
												<option value='_blank'>New Windows (_blank)</option>
												<option value='_top'>Topmost Windows (_top)</option>
												<option value='_parent'>Parent Windows (_parent)</option>
											</select>
										</div>
										
										<input type='hidden' name='act' value='edit_mn'/>
										<input type='hidden' name='idnya' value='<?PHP echo $idnya; ?>'/>
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
	<script type="text/javascript">
		function change_to_1(){
		$("#advanced_1").fadeIn("slow");
		}
		function change_to_2(){
		$("#advanced_1").fadeOut("slow");
		}
		function change_to_none(){
		$("#advanced_1").fadeOut("slow");
		}
	</script>
</body>
</html>
