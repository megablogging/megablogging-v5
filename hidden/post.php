<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("act/post.mgb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>All Post - Admin Megablogging</title>
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
                    <li class="active">All Post</li>	 
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
								$messages = "<strong>Success!</strong> add new post!";
							}else if($msg==2){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... delete post!";
							}else if($msg==3){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... edit post!";
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
				
                <div class="row">
					<div class="col-md-12">
                        <div class="panel panel-default" id='all'>
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-file-o"></i> All Posts</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
                            <div class="panel-body">
								<div id='top-action' style='margin-bottom:10px'>
									<a href='add_post.mgb' class='btn btn-success'><i class='fa fa-plus'></i> Add New Post</a>
									<span class="input-group pull-right"  style='width:30%'>
										<input class="form-control" required type="text" name="keyword" id="search_cat" placeholder='Enter keyword...' onkeyup='changePagination(1, "search", this.value)'>
										<span class="input-group-btn">
										<button class="btn btn-default"><i class='fa fa-search'></i></button>
										</span>
									</span>
								</div>
								<div id="pageData"></div>
								<span class="flash"></span>
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
	<!-- ajax load category -->
	<script type='text/javascript'>
		$(document).ready(function(){
		changePagination('1', 'all_posts', '');    
		});
		function changePagination(page, action, q){
			$(".flash").show();
			$(".flash").fadeIn(400).html
			('<img src="assets/images/loader.gif" />');
			var dataString = 'page='+ page;
			dataString = dataString + '&action='+action+'&q='+q;
			$.ajax({
				type: "POST",
				url: "proses/ajax_load_post.php",
				data: dataString,
				cache: false,
				success: function(result){
					$(".flash").hide();
					$("#pageData").html(result);
				}
			});
		}
	</script>
</body>
</html>