<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
require_once("act/menu.mgb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Menu & Submenu - Admin Megablogging</title>
    <?PHP require_once(dirname(__FILE__)."/inc/css.php"); ?>
	<link href="assets/plugins/jquery-nestable/jquery.nestable.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper" <?PHP echo $c_sidebar_set; ?>>
		<?PHP require_once(dirname(__FILE__)."/inc/navbar.php"); ?>
        <?PHP require_once(dirname(__FILE__)."/inc/sidebar.php"); ?>
        <div id="main-container">
            <div id="breadcrumb">
                <ul class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="//www.megablogging.org"> Admin</a></li>
                    <li class="active">Menu & Submenu</li>	 
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
								$isi=$_GET['isi'];
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong> add new menu with name : <b>$isi</b>!";
							}else if($msg==2){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... delete menu!";
							}else if($msg==3){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... add new submenu!";
							}else if($msg==4){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... deleting submenu!";
							}else if($msg==5){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... edit menu!";
							}else if($msg==6){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... edit submenu!";
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
							<div class='panel-heading'><i class="fs fs-th-list fa-lg"></i> Menus</div>
							<div class='panel-body'>
								<div id='act-other' style='margin-bottom:10px'>
									<a href='add_menu.mgb' class='btn btn-success btn-sm'><i class='fa fa-plus'></i> Add New Menu</a>
								</div>
								<div class='alert alert-info'>
									Drag and drop menus To Order Position of menus.
								</div>
								<div class="dd grid" id="sortable" style='margin-top:10px'>
									<?PHP 
										$data_mn = $db->fetch_multiple("select id, name, number from menu ORDER by number ASC");
										foreach($data_mn as $data){
									?>
                                      <div onmouseup='auto_save()' class='tile dd-item dd3-item dd-handle' id="item-<?php echo $data['id'];?>">
										<?PHP echo $data['name']; ?>
										<span class='pull-right'>
											<span class='btn-group'>
												<a href='<?PHP echo "edit_menu.mgb?id=$data[id]"; ?>' class='btn btn-success btn-xs' title='Edit This Menu'><i class='fa fa-edit'></i></a>
												<a href='<?PHP echo "menu.mgb?act=delete_mn&id=$data[id]"; ?>' class='btn btn-danger btn-xs' title='Delete This Menu'><i class='fs fs-remove'></i></a>
											</span>
										</span>
									  </div>  
									<?PHP } ?>	
                                </div>
								<button class='btn btn-success btn-sm save'><i class='fa fa-save'></i> Save Position</button>
							</div>
						</div>
					</div>
				</div>
				
				<div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-default'>
							<div class='panel-heading'><i class="fs fs-list fa-lg"></i> Submenu</div>
							<div class='panel-body'>
								<div id='act-other' style='margin-bottom:10px'>
									<a href='add_submenu.mgb' class='btn btn-success btn-sm'><i class='fa fa-plus'></i> Add New Submenu</a>
								</div>
								<table class="table table-bordered table-striped table-hover">
								  <thead>
									<tr>
									  <th>#</th>
									  <th>Name</th>
									  <th>In Menu</th>
									  <th>Target</th>
									  <th>Action</th>
									</tr>
								  </thead>
								  <tbody>
								  <?PHP
									$no = 1;
									$data_submenu_q = $db->fetch_multiple("select * from submenu ORDER by submenu.menu ASC, submenu.id ASC");
									foreach ($data_submenu_q as $data_submenu){
									$submenu_id = $data_submenu['id'];
									$submenu_name = $data_submenu['name'];
									$submenu_link = $data_submenu['link'];
									$submenu_menu = $data_submenu['menu'];
									//sql for get menu name
									$data_for_name = $db->fetch("select * from menu where id='$submenu_menu'");
									$letak_submenunya = $data_for_name['name'];
									//
									$submenu_target = $data_submenu['target'];
								  ?>
									<tr>
									  <td><?PHP echo $no; ?></td>
									  <td><?PHP echo "$submenu_name"; ?></td>
									  <td><?PHP echo "$letak_submenunya"; ?></td>
									  <td><?PHP echo "$submenu_target"; ?></td>
									  <td>
									  <div class="btn-group">
									  <a href="edit_submenu.php?id=<?PHP echo $submenu_id; ?>" class="btn btn-xs btn-info" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Edit Submenu"> <i class="fa fa-edit"></i> </a> 
									  <a href="menu.php?act=delete_sm&id=<?PHP echo $submenu_id; ?>" class="btn btn-xs btn-danger" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Delete Submenu"> <i class="fs fs-remove"></i> </a> 
									  </div>
									  </td>
									</tr>
								   <?PHP
									$no++;
									}
								   ?>
								  </tbody>
								</table>
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
	<script src="assets/plugins/jquery-nestable/jquery.nestable.js"></script>
	<script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script> 
	<style>
.placeholder {
	background:transparent;
	border:1px dashed;
	height:30px;
	margin-bottom:5px;
	margin-top:5px;
}
</style>
<script type='text/javascript'>
$(function () {
    $(".grid").sortable({
        tolerance: 'pointer',
        revert: 'invalid',
        placeholder: 'placeholder tile',
        forceHelperSize: true
    });
});
</script>
<script>
$(function()
	{
	  $('.save').click(function()
	  {
	  $.ajax({
	type: "POST",
	url: "proses/save_menu.php",
	data: $("#sortable").sortable("serialize"),
	success: function(data)
	{
	alert("Success Saving Menu");
	}

	});
	setTimeout(function(){
	  $(".flash").slideUp("slow", function () {
	  $(".flash").hide();
		  }); }, 3000);
		  });
			$( "#sortable" ).sortable({
			revert: true
			});
			$( "ul, li" ).disableSelection();
		});
</script>
<script>
function auto_save(){
	$.ajax({
	type: "POST",
	url: "proses/save_menu.php",
	data: $("#sortable").sortable("serialize"),
	success: function(data)
	{
	
	}
	});
}
</script>
</body>
</html>
