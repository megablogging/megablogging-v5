<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
require_once("_session_lv.php");
if (isset($_REQUEST['act'])){
	require_once("anti_xss.php");
	$act = $_REQUEST['act'];
	if ($act == 'save'){
		//do save
		$code = $_POST['code'];
		$filepath = ROOT."/mgb-dir/assets/komentar.php";
		if ($app->save_file($filepath, utf8_encode($code))){
			header("location:comments.mgb?msg=1");
			exit();
		}else{
			header("location:comments.mgb?msg=2");
			exit();
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Plarform/Code Comments - Admin Megablogging</title>
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
                    <li class="active">Comments</li>	 
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
								$messages = "<strong>Success!</strong> saving code of comments!";
							}else if($msg==2){
								$m_tipe = 'danger';
								$messages = "<strong>Failed!</strong>... error while saving file!";
							}else if($msg==3){
								$m_tipe = 'success';
								$messages = "<strong>Success!</strong>... other!";
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
						<!-- content -->
						<div class='panel panel-primary'>
							<div class='panel-heading'>Code Of Comments</div>
							<div class='panel-body'>
								<div class='alert alert-success'>Silahkan paste kode plugin komentar anda di sini, anda bisa menggunakan plugin komentar <a href='http://blog.megablogging.org/detail/cara-pasang-komentar-disqus-di-megablogging.html'>disqus</a>, <a href='http://blog.megablogging.org/detail/cara-pasang-komentar-facebook-di-megablogging.html'>facebook</a>, atau plugin-plugin komentar lainya</div>
								<form action='' method='post'>
								<div class='form-group'>
									<label>Code (HTML/Javascript/CSS/PHP)</label>
									<textarea id='code' name='code'><?PHP echo $app->open_file(ROOT."/mgb-dir/assets/komentar.php"); ?></textarea>
								</div>
								<button class='btn btn-success btn-sm'><i class='fa fa-save'></i> Save</button>
								<input type='hidden' name='act' value='save'/>
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
