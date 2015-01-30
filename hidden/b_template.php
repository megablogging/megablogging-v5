<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Browse Template - Admin Megablogging</title>
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
                    <li class="active">Browse Template</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
                <div class='row'>
					<div class='col-md-12'>
						<!-- content -->
						<div class='panel panel-default'>
							<div class='panel-heading'><i class='fa fa-th-large'></i> New Template From megablogging.org</div>
							<div class='panel-body'>
								This Feature Still Under Construction! .. for get more template you can check it at <a href='http://template.megablogging.org' class='text-danger'>http://template.megablogging.org</a> or <a href='http://blog.mas-dewa.com/category/template-megablogging' class='text-danger'>http://blog.mas-dewa.com/category/template-megablogging</a>
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
