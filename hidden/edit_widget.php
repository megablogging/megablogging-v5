<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
require_once("act/widget.mgb");
if (isset($_GET['id'])){
	require_once("anti_xss.php");
	$art_id = abs((int)$_GET['id']);
	$check_it = $db->num_rows("select id from widget where id='$art_id'");
	if ($check_it > 0){
		//good and get all
		$data_art = $db->fetch("select * from widget where id='$art_id'");
		//get code
		$file_path = ROOT."/mgb-dir/widget/$data_art[content]";
		$code = $app->open_file($file_path);
	}else{
		$m_tipe = "danger";
		$messages = "The id of widget isn't valid or this widget is not yours!<br><a href='page.mgb'>Back</a>";
		require_once("messages.php");
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Widget - Admin Megablogging</title>
    <?PHP require_once(dirname(__FILE__)."/inc/css.php"); ?>
	<link rel="stylesheet" href="assets/plugins/codemirror/lib/codemirror.css"/>
</head>
<body>
    <div id="wrapper" <?PHP echo $c_sidebar_set; ?>>
		<?PHP require_once(dirname(__FILE__)."/inc/navbar.php"); ?>
        <?PHP require_once(dirname(__FILE__)."/inc/sidebar.php"); ?>
        <div id="main-container">
            <div id="breadcrumb">
                <ul class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="//www.megablogging.org"> Admin</a></li>
                    <li class="active">Edit Widget</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
                <div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-default'>
							<div class='panel-heading'><i class="fs fs-grid-4 fa-lg"></i> Edit Widgets</div>
							<div class='panel-body'>
								<form action='' method='post'>
									<div class='form-group'>
										<label>Title</label>
										<input type='text' name='title' class='form-control' value='<?PHP echo $data_art['title']; ?>'>
									</div>
									<div class='form-group'>
										<label>Content/Code [support : html, css, javascript, php]</label>
										<textarea name='content' id='code' style='width:99%;min-height:200px;max-height:1000px'><?PHP echo $code; ?></textarea>
									</div>
									<button class='btn btn-success btn-sm'><i class='fa fa-save'></i> Save</button>
									<input type='hidden' name='act' value='edit'/>
									<input type='hidden' name='wg_id' value='<?PHP echo $art_id; ?>'/>
									<input type='hidden' name='target' value='<?PHP echo $data_art['content']; ?>'/>
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
	<script src="assets/plugins/codemirror/lib/codemirror.js"></script>
	<script src="assets/plugins/codemirror/addon/edit/matchbrackets.js"></script>
	<script src="assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
	<script src="assets/plugins/codemirror/mode/xml/xml.js"></script>
	<script src="assets/plugins/codemirror/mode/javascript/javascript.js"></script>
	<script src="assets/plugins/codemirror/mode/css/css.js"></script>
	<script src="assets/plugins/codemirror/mode/clike/clike.js"></script>
	<script src="assets/plugins/codemirror/mode/php/php.js"></script>
	<script>
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        indentWithTabs: true
      });
    </script>
</body>
</html>
