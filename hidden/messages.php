<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
if (!isset($messages)){
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Messages - Admin Megablogging</title>
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
                    <li class="active">Messages</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
                <div class='alert alert-<?PHP echo $m_tipe; ?>'>
					<?PHP echo $messages; ?>
				</div>
            </div>
        </div><!-- /main-container -->
        <?PHP require_once(dirname(__FILE__)."/inc/footer.php"); ?>
    </div><!-- /wrapper -->
    <a href="#" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
    <?PHP require_once(dirname(__FILE__)."/inc/js.php"); ?>
</body>
</html>
