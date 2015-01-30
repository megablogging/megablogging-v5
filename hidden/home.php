<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("act/stat.mgb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home - Admin Megablogging</title>
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
                    <li class="active">Dashboard</li>	 
                </ul>
            </div><!-- END : breadcrumb -->
			<div class="main-header clearfix">
                <div class="page-title">
                    <h3 class="no-margin">Dashboard</h3>
                    <span>Welcome back <b><?PHP echo $a_name; ?></b></span>
                </div><!-- /page-title -->

                <ul class="page-stats">
                    <li>
                        <div class="value">
                            <span>Page Hits Today</span>
                            <h4 id="currentVisitor"><?PHP echo $hits_today; ?></h4>
                        </div>
                        <span class="sparkline"><img src='assets/images/today.png' height=''></span>
                    </li>
                    <li>
                        <div class="value">
                            <span>This Month</span>
                            <h4><strong id="currentBalance"><?PHP echo $hits_this_month; ?></strong></h4>
                        </div>
                        <span class="sparkline"><img src='assets/images/month.png' height=''></span>
                    </li>
                </ul><!-- /page-stats -->
            </div>
            <div class="inner-continer">
                <div class="row">
                <div class="col-lg-12 hidden-xs">
					<!-- /.shortcut icon -->
					<div class='row-fluid'>
						<center><a class="img-thumbnail col-md-3" href='add_post.mgb' style='padding:15px;'><i class='fa fa-plus fa-5x'></i><br>Add New Post</a></center>
						<center><a class="img-thumbnail col-md-3" href='users.mgb' style='padding:15px;'><i class='fa fa-users fa-5x'></i><br>All Users</a></center>
						<center><a class="img-thumbnail col-md-3" href='statistik.mgb' style='padding:15px;'><i class='fs fs-stats fa-5x'></i><br>Statistik Website</a></center>
						<center><a class="img-thumbnail col-md-3" href='widget.mgb' style='padding:15px;'><i class='fs fs-grid-4 fa-5x'></i><br> Widget Configuration</a></center>
					</div>
					<div class='row-fluid'>
						<center><a class="img-thumbnail col-md-3" href='template.mgb' style='padding:15px;'><i class='fa fa-th-large fa-5x'></i><br>All Templates</a></center>
						<center><a class="img-thumbnail col-md-3" href='files.mgb' style='padding:15px;'><i class='fa fa-file fa-5x'></i><br>File Manager</a></center>
						<center><a class="img-thumbnail col-md-3" href='setting.mgb' style='padding:15px;'><i class='fa fa-cog fa-5x'></i><br>Configuration Website</a></center>
						<center><a class="img-thumbnail col-md-3" href='up_files.mgb' style='padding:15px;'><i class='fa fa-upload fa-5x'></i><br> Upload Files</a></center>
					</div>
				</div>
				</div>
				
				<div class='row' style='margin-top:10px'>
					<div class='col-md-8'>
						<div class='panel panel-default'>
							<div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-info"></i> Information</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
							<div class='panel-body'>
								<div class='row'>
									<div class='col-md-12'>
										<p style='text-decoration:bold;font-size:17px;'><b>New Feature in Version <?PHP echo _V_; ?></b></p>
										<div style='margin-top:-2px;text-decoration:bold'>
										<p style='margin-bottom:-5px;'>&rarr; Now Mengablogging using <a href='template.mgb'>Multiple Template</a> Not Theme Again</p>
										<p style='margin-bottom:-5px;'>&rarr; <a href='edit_template.mgb'>Edit Template</a></p>
										<p style='margin-bottom:-5px;'>&rarr; Code of Comments Can Be Costumize using <a href='comments.mgb'>comments manager</a></p>
										<p style='margin-bottom:0px;'>&rarr; Multiple user for menage admin page</p>
									</div>
									<p style='border:1px #000 dashed'></p>
									<p>
									For Details "<b>How To Use Megablgging</b>" visit here <a href='http://docs.megablogging.org'>http://docs.megablogging.org</a>. and for see another our products you can found it at <a target='_blank' href='http://megasoft-id.com/products.html'>http://megasoft-id.com/products.html</a>
									</p>
									<?PHP
									require_once("act/check_update.mgb");
									if ($updated == false){ //new version is available
										echo "
											<div class='well'>
											<blink><me style='font-size:19px;'>CMS Megablogging Version <b>$lastest_version</b> has been realese</me></blink><br>
											<a href='update.mgb' class='btn btn-success btn-sm'><i class='fa fa-cloud-success'></i> Update Your Engine Now (Version $lastest_version)</a>
											</div>
										";
									}
									?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class='col-md-4 hidden-xs hidden-sm'>
						<div class="list-group">
							<a href="post.mgb" class="list-group-item">
								<i class="fa fa-file-o fa-fw"></i> All Post <span class="pull-right text-muted small"><em><?PHP echo $db->num_rows("select id from article"); ?> posts</em></span>
							</a>
							<a href="cat.mgb" class="list-group-item">
								<i class="fa fa-tags fa-fw"></i> All Category <span class="pull-right text-muted small"><em><?PHP echo $db->num_rows("select id from category");; ?> tags</em></span>
							</a>
							<a href="users.mgb" class="list-group-item">
								<i class="fa fa-users fa-fw"></i> All Users <span class="pull-right text-muted small"><em><?PHP echo $db->num_rows("select id from admin");; ?> users</em></span>
							</a>
							<a href="page.mgb" class="list-group-item">
								<i class="fa fa-file fa-fw"></i> All Pages <span class="pull-right text-muted small"><em><?PHP echo $db->num_rows("select id from pages");; ?> pages</em></span>
							</a>
							<a href="statistik.mgb" class="list-group-item">
								<i class="fs fs-stats fa-fw"></i> Total Page Hits <span class="pull-right text-muted small"><em><?PHP echo $all_hits; ?> times</em></span>
							</a>
						</div>
					</div>
				</div>
				
				<div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-default'>
							<div class="panel-heading">
                                <h3 class="panel-title"><i class="fs fs-stats"></i> Statistik</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
							<div class='panel-body'>
							<?PHP
								$a_tanggal_s = "";
								$a_hits_s = 0;
								$data_hits = $db->fetch_multiple("select * from statistik ORDER by statistik.date DESC limit 0, 10");
								foreach ($data_hits as $data_s){
								$tanggal_s = $data_s['date'];
								$hits_s = $data_s['hits'];
								$a_tanggal_s = "'$tanggal_s',".$a_tanggal_s;
								$a_hits_s = "$hits_s,".$a_hits_s;
								}
							?>
							<div id='statistik'></div>
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-primary'>
							<div class="panel-heading">
                                <h3 class="panel-title"><i class="fs fs-chrome"></i> Statistik Browser</h3>
                                <div class="panel-tools">
                                    <a class="btn btn-xs btn-link panel-collapse collapses" href="javascript:void(0);"></a>
                                    <a class="btn btn-xs btn-link panel-expand" href="javascript:void(0);"><i class="fs-arrow"></i></a>
                                    <a class="btn btn-xs btn-link panel-close" href="javascript:void(0);"><i class="fs-close-2"></i></a>
                                </div>
                            </div>
							<div class='panel-body'>
							<?PHP require_once("act/browser.mgb"); ?>
							<div id='statistik2'></div>
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
	<?PHP require_once(dirname(__FILE__)."/inc/js-stats.php"); ?>
	<script src="assets/plugins/highcharts/highcharts.js"></script>
	<script src="assets/plugins/highcharts/modules/exporting.js"></script>
</body>
</html>
