<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("act/stat.mgb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Statistik - Admin Megablogging</title>
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
                    <li class="active">Statistik</li>	 
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
								$messages = "<strong>Success!</strong> adding new category!";
							}else if($msg==2){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... deleting category!";
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
				<!-- BEGIN add -->
				<div class='row'>
					<div class='col-md-12'>
						<div class="panel panel-success" id='add'>
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fs fs-stats"></i> Detail Stats</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
                            <div class="panel-body">
								<table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
								<tr><td style="border: none;padding: 4px;">TOTAL PAGE HITS</td><td align="right" style="border: none;padding: 4px;"><b>
								<?PHP
								$min_digits = 0;
								$count = $all_hits;	  
								$count = sprintf('%0'.$min_digits.'s',$count);
								$len = strlen($count);
								for ($i=0;$i<$len;$i++)
								echo '<img src="'.$c_url."/mgb-dir/file-manager/images/number/default/". substr($count,$i,1) . '.' . 'gif' .'" border="0">';    
								?>
								</b></td></tr>
								<tr><td style="border: none;padding: 4px;">PAGE HITS TODAY</td><td align="right" style="border: none;padding: 4px;"><b>
								<?PHP
								$count = $hits_today;	  
								$count = sprintf('%0'.$min_digits.'s',$count);
								$len = strlen($count);
								for ($i=0;$i<$len;$i++)
								echo '<img src="'.$c_url."/mgb-dir/file-manager/images/number/default/". substr($count,$i,1) . '.' . 'gif' .'" border="0">';    
								?>
								</b></td></tr>
								<tr><td style="border: none;padding: 4px;">PAGE HITS YESTERDAY</td><td align="right" style="border: none;padding: 4px;"><b>
								<?PHP
								$count = $hits_yesterday;	  
								$count = sprintf('%0'.$min_digits.'s',$count);
								$len = strlen($count);
								for ($i=0;$i<$len;$i++)
								echo '<img src="'.$c_url."/mgb-dir/file-manager/images/number/default/". substr($count,$i,1) . '.' . 'gif' .'" border="0">';    
								?>
								</b></td></tr>
								
								<tr><td style="border: none;padding: 4px;">HITS LAST MONTH</td><td align="right" style="border: none;padding: 4px;"><b>
								<?PHP
								$count = $hits_last_month;	  
								$count = sprintf('%0'.$min_digits.'s',$count);
								$len = strlen($count);
								for ($i=0;$i<$len;$i++)
								echo '<img src="'.$c_url."/mgb-dir/file-manager/images/number/default/". substr($count,$i,1) . '.' . 'gif' .'" border="0">';    
								?>
								</b></td></tr>
								
								<tr><td style="border: none;padding: 4px;">HITS THIS MONTH</td><td align="right" style="border: none;padding: 4px;"><b>
								<?PHP
								$count = $hits_this_month;	  
								$count = sprintf('%0'.$min_digits.'s',$count);
								$len = strlen($count);
								for ($i=0;$i<$len;$i++)
								echo '<img src="'.$c_url."/mgb-dir/file-manager/images/number/default/". substr($count,$i,1) . '.' . 'gif' .'" border="0">';    
								?>
								</b></td></tr>
								</table>
                            </div>
                        </div>
					</div>
				</div>
				<!-- END add -->
				
                <div class="row">
					<div class="col-md-12">
                        <div class="panel panel-default" id='all'>
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fs fs-stats"></i> All Statistik</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
                            <div class="panel-body">
								<div id='top-action' style='margin-bottom:30px'>
									...
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
		changePagination('1', 'all_categories', '');    
		});
		function changePagination(page, action, q){
			$(".flash").show();
			$(".flash").fadeIn(400).html
			('<img src="assets/images/loader.gif" />');
			var dataString = 'page='+ page;
			dataString = dataString + '&action='+action+'&q='+q;
			$.ajax({
				type: "POST",
				url: "proses/ajax_load_stat.php",
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
