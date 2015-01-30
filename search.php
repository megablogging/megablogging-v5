<?PHP
require_once(dirname(__FILE__)."/config.php");
if (isset($_REQUEST['keyword'])){
	$k = $_REQUEST['keyword'];
	$k = $app->replace_char($k, true);
	$redir = $app->get_link_search("$k");
	header("location:$redir");
}
?>