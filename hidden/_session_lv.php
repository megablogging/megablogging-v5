<?PHP
if ($a_level != 1){
$m_tipe = "danger";
$messages = "Sorry! You Don't Have : <b>Permission</b> to access this page.. only Admin can access this page!<br><a class='btn btn-primary' onclick='window.history.back()'>Back</a>";
require_once("messages.php");
exit();
}
?>