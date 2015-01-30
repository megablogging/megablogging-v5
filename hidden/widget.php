<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
require_once("act/widget.mgb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Widget - Admin Megablogging</title>
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
                    <li class="active">Widget</li>	 
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
								$messages = "<strong>Success!</strong> add new widget!";
							}else if($msg==2){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... delete widget!";
							}else if($msg==3){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... edit widget!";
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
							<div class='panel-heading'><i class="fs fs-grid-4 fa-lg"></i> All Widgets</div>
							<div class='panel-body'>
								<div id='act-other' style='margin-bottom:10px'>
									<a href='add_widget.mgb' class='btn btn-success btn-sm'><i class='fa fa-plus'></i> Add New Widget</a>
								</div>
								<div class='alert alert-info'>
									Drag and drop Widgets To Order Position of widgets.
								</div>
								<div class="dd grid" id="sortable" style='margin-top:10px'>
									<?PHP 
										$data_wg = $db->fetch_multiple("select id, title, number from widget ORDER by number ASC");
										foreach($data_wg as $data){
									?>
                                      <div onmouseup='auto_save()' class='tile dd-item dd3-item dd-handle' id="item-<?php echo $data['id'];?>">
										<?PHP echo $data['title']; ?>
										<span class='pull-right'>
											<span class='btn-group'>
												<a href='<?PHP echo "edit_widget.mgb?id=$data[id]"; ?>' class='btn btn-success btn-xs' title='Edit This Widget'><i class='fa fa-edit'></i></a>
												<a href='<?PHP echo "widget.mgb?act=delete&id=$data[id]"; ?>' class='btn btn-danger btn-xs' title='Delete This Widget'><i class='fs fs-remove'></i></a>
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
	url: "proses/save_widget.php",
	data: $("#sortable").sortable("serialize"),
	success: function(data)
	{
	alert("Success Saving Widgets");
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
	url: "proses/save_widget.php",
	data: $("#sortable").sortable("serialize"),
	success: function(data)
	{
	
	}
	});
}
</script>
</body>
</html>
