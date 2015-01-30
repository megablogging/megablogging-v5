<?PHP
require_once(ROOT."/mgb-dir/lib/anti_xss.lib.php");
if (anti_xss($url) == false){
echo "Access Forbiden! (ANTI XSS)<br><a href='index.mgb'>Back</a>";
exit();
}
?>