<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("act/page.mgb");
if (isset($_GET['id'])){
	require_once("anti_xss.php");
	$art_id = abs((int)$_GET['id']);
	$check_it = $db->num_rows("select id from pages where id='$art_id' and user='$admin_id'");
	if ($check_it > 0){
		//good and get all
		$data_art = $db->fetch("select * from pages where id='$art_id' and user='$admin_id'");
	}else{
		$m_tipe = "danger";
		$messages = "The id of pages isn't valid or this pages is not yours!<br><a href='page.mgb'>Back</a>";
		require_once("messages.php");
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Page <?PHP echo $data_art['id'] ?> - Admin Megablogging</title>
    <?PHP require_once(dirname(__FILE__)."/inc/css.php"); ?>
	<link href="assets/plugins/select2/select2.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper" <?PHP echo $c_sidebar_set; ?>>
		<?PHP require_once(dirname(__FILE__)."/inc/navbar.php"); ?>
        <?PHP require_once(dirname(__FILE__)."/inc/sidebar.php"); ?>
        <div id="main-container">
            <div id="breadcrumb">
                <ul class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="//www.megablogging.org"> Admin</a></li>
                    <li class="active">Edit Page</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
				<div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-primary'>
							<div class='panel-heading'>
								<h3 class="panel-title"><i class="fa fa-picture-o"></i> Upload Images</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
							</div>
							<div class='panel-body'>
								<a target='_blank' href='up_img.mgb' class='btn btn-success'><i class='fa fa-upload'></i> Upload Image, Click here</a>
							</div>
						</div>
					</div>
				</div>
                <div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-default'>
							<div class='panel-heading'>
								<h3 class="panel-title"><i class="fa fa-file-text"></i> Edit Page</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
							</div>
							<div class='panel-body'>
								<form action='' method='post'>
									<div class='form-group'>
										<label>Title *</label>
										<input type='text' name='title' class='form-control' required value='<?PHP echo $data_art['title'] ?>'/>
									</div>
									<div class='form-group'>
										<label>Content</label>
										<textarea class="<?PHP if($c_editor=='ckeditor'){echo "ckeditor";}else{echo "summernote bg-white";} ?>" cols="100" id="isi" name="isi" rows="30"><?PHP echo $data_art['content']; ?></textarea>
									</div>
									<div class='form-group'>
										<label>Date *</label>
										<input type='text' name='date' class='form-control' value='<?PHP echo $data_art['date'] ?>'/>
									</div>
									<div class='form-group'>
										<label>Time *</label> 
										<input type='text' name='time' class='form-control' value='<?PHP echo $data_art['time'] ?>'/>
									</div>
									<button class='btn btn-success'><i class='fa fa-save'></i> Save</button>
									<input type='hidden' name='act' value='edit'/>
									<input type='hidden' name='art_id' value='<?PHP echo $art_id; ?>'/>
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
	<script src='assets/plugins/select2/select2.min.js'></script>
	<?PHP
		if($c_editor=='ckeditor'){
			echo "<script type='text/javascript' src='assets/plugins/ckeditor/ckeditor.js'></script>";
		}else{
			echo "<link href='assets/plugins/summernote/summernote.css' rel='stylesheet'>
			<link href='assets/plugins/summernote/summernote-bs3.css' rel='stylesheet'>
			<script type='text/javascript' src='assets/plugins/summernote/summernote.min.js'></script>";
		}
	?>
</body>
</html>