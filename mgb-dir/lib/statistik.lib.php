<?PHP
$all_hits = 0;
$today = date('Y')."-".date('m')."-".date('d');
#checking date----------------------------------------------------
$sql = "select * from statistik where date='$today'";
$result = $db->num_rows($sql);
#pemasukan data baru jika tanggal sekarang tidak ada di database--
if ($result==0){
$q = "insert into statistik values('1', '$today')";
$db->query($q);
}
else{
$data = $db->fetch($sql);
$hits_today = $data['hits'];
$hits_today++;
$db->query("update statistik set hits='$hits_today' where date='$today'");
}
#all history page--------------------------------------------------
$all_hits = $db->fetch("SELECT sum(hits) from statistik");$all_hits=$all_hits[0];
#------------------------------------------------------------------
#today-------------------------------------------------------------
$data = $db->fetch("select hits from statistik where date='$today'");;
$hits_today = $data['hits'];
#-------------------------------------------------------------------
#yesterday----------------------------------------------------------
$yesterday = date("Y-m-d", strtotime("-1 day"));
$data=$db->fetch("select * from statistik where date='$yesterday'");;
$hits_yesterday = $data['hits'];
if (empty($hits_yesterday)){
$hits_yesterday = 0;
}
#--------------------------------------------------------------------
function selfURL() {
$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}
function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2));
}
$my_url = selfURL();
//untuk pemasukan statistik Browser
require_once("browser.lib.php");
$db->query("UPDATE `browser` SET `hits`=hits+1 where name='$input_ke_browser'");
?>