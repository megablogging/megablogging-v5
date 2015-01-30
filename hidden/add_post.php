<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("act/post.mgb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add New Post - Admin Megablogging</title>
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
                    <li class="active">Add New Post</li>	 
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
								<h3 class="panel-title"><i class="fa fa-edit"></i> Add New Post</h3>
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
										<input type='text' name='title' class='form-control required
									</div>
									<div class='form-group'>
										<label>Image *</label> 
										<input type='text' name='image' class='form-control' placeholder='ex : http://blog.mas-dewa.com/mgb-dir/uploads/2014/12/sample.jpg' required/>
									</div>
									<div class='form-group'>
										<label>Category</label> 
										<select multiple class="select2Search" style="width: 100%;" name='category[]'>
                                            <?PHP
												$data_cat = $db->fetch_multiple("select name from category ORDER by name ASC");
												foreach($data_cat as $data){
												$cat_name = $data['name'];
												echo "<option value='$cat_name'>$cat_name</option>";
												}
											?>
                                        </select>
									</div>
									<div class='form-group'>
										<label>Content</label>
										<textarea class="<?PHP if($c_editor=='ckeditor'){echo "ckeditor";}else{echo "summernote bg-white";} ?>" cols="100" id="isi" name="isi" rows="30"></textarea>
									</div>
									<button class='btn btn-success'><i class='fa fa-save'></i> Save</button>
									<input type='hidden' name='act' value='add'/>
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