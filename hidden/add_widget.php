<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
require_once("act/widget.mgb");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Add New Widget - Admin Megablogging</title>
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
                    <li class="active">Dashboard</li>	 
                </ul>
            </div><!-- END : breadcrumb -->

            <div class="inner-continer">
                <div class='row'>
					<div class='col-md-12'>
						<div class='panel panel-default'>
							<div class='panel-heading'><i class="fs fs-grid-4 fa-lg"></i> All Widgets</div>
							<div class='panel-body'>
								<form action='' method='post'>
									<div class='form-group'>
										<label>Title</label>
										<input type='text' name='title' class='form-control'>
									</div>
									<div class='form-group'>
										<label>Content/Code [support : html, css, javascript, php]</label>
										<textarea name='content' id='code' style='width:99%;min-height:200px;max-height:1000px'></textarea>
									</div>
									<button class='btn btn-success btn-sm'><i class='fa fa-save'></i> Save</button>
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
