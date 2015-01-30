<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Template - Admin Megablogging</title>
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
                    <li class="active">Edit Template</li>	 
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
								$messages = "<strong>Success!</strong>... !";
							}else if($msg==4){
								$m_tipe = 'danger';
								$messages = "<strong>Error!</strong>... !";
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
                                <h3 class="panel-title"><i class="fa fa-cog"></i> Edit Template</h3>
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
									  <th>Filename</th>
									  <th>Type</th>
									  <th>Description</th>
									  <th>Action</th>
									</tr>
								  </thead>
								  <tbody>
								  <?PHP
									$xml_template = simplexml_load_file(TEMPLATE_DIR."/list.xml");
									$i = 0;
									while ($xml_template and $i < count($xml_template)){
									$e_filename = $xml_template->file[$i]->filename;
									$e_description = $xml_template->file[$i]->description;
									$e_type = $xml_template->file[$i]->type;
									$e_path = $xml_template->file[$i]->path;
								  ?>
									<tr>
									  <td><?PHP echo $i + 1; ?></td>
									  <td><?PHP echo $e_filename; ?></td>
									  <td><?PHP echo $e_type; ?></td>
									  <td><?PHP echo $e_description; ?></td>
									  <td>
										  <div class="btn-group">
											<a href="editor_template.php?file=<?PHP echo $e_path; ?>" class="btn btn-xs btn-info" rel="tooltip" data-toggle="tooltip" data-placement="top" data-original-title="Edit This Files"> <i class="fa fa-edit"></i> </a> 
										  </div>
									  </td>
									</tr>
								   <?PHP
									$i++;
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
</body>
</html>
