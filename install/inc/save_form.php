<?PHP
/**
 * @package Megablogging
 * @copyright 2012-2015 Megasoft Informer (http://megasoft-id.com) | License: http://megasoft-id.com/license | http://megablogging.org
 * @since version 5
 */
error_reporting(E_ERROR & ~E_WARNING);
function selfURL() {
$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}
function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2));
}
$site_url = selfURL();
$site_url = str_replace('/install/index.php', '', $site_url);
$site_url = str_replace('?step=1', '', $site_url);
$site_url = str_replace('?step=2', '', $site_url);
$site_url = str_replace('?step=3', '', $site_url);
$site_url = str_replace('?step=4', '', $site_url);
$site_url = str_replace('/install/', '', $site_url);
#
if (isset($_POST['stepform'])){
	$stepform = $_POST['stepform'];
	if ($stepform==1){
		//setp 1 saving
		$_SESSION['ins_type_site']=$_POST['type_site'];
		$_SESSION['ins_title']=$_POST['title'];
		$_SESSION['ins_show']=$_POST['show'];
		$_SESSION['ins_max']=$_POST['max'];
		$_SESSION['ins_background']=$_POST['background'];
	}
	if ($stepform==2){
		//lakukan pengujian koneksi
		$mysqli = new mysqli($_POST['db_host'], $_POST['db_username'], $_POST['db_password']);
		if ($mysqli->connect_errno) {
			printf("Maaf, Megablogging Tidak bisa melakukan koneksi ke host : <b>$_POST[db_host]</b> karena : %s\n", $mysqli->connect_error);
			echo "<br><a href='?step=2'>Back</a>";
			exit();
		}else{
			//berhasil konek
			//cek database name
			$db = new mysqli($_POST['db_host'], $_POST['db_username'], $_POST['db_password'], $_POST['db_name']);
			if ($db->connect_errno) {
				//kalau konek ke db gagal coba buat dulu database barunya
				$sql = "CREATE DATABASE IF NOT EXISTS `$_POST[db_name]` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci";
				if(!$result = $mysqli->query($sql)){
					echo "Maaf, Megablogging Tidak bisa membuat database baru (<b>$_POST[db_name]</b>) karena : ".$db->connect_errno."<br><a href='?step=2'>Back</a>";
					exit();
				}
			}
		}
		
		//step 2 saving
		$_SESSION['ins_db_host']=$_POST['db_host'];
		$_SESSION['ins_db_username']=$_POST['db_username'];
		$_SESSION['ins_db_password']=$_POST['db_password'];
		$_SESSION['ins_db_name']=$_POST['db_name'];
	}
	if ($stepform==3){
		//setp 1 saving
		$_SESSION['uri_paging_index']=$_POST['uri_paging_index'];
		$_SESSION['uri_artikel_depan']=$_POST['uri_artikel_depan'];
		$_SESSION['uri_artikel_belakang']=$_POST['uri_artikel_belakang'];
		$_SESSION['uri_category']=$_POST['uri_category'];
		$_SESSION['uri_search']=$_POST['uri_search'];
		$_SESSION['uri_pages']=$_POST['uri_pages'];
		$_SESSION['uri_feed']=$_POST['uri_feed'];
	}
}
if (isset($_SESSION['ins_type_site'])){
	$ins_type_site = $_SESSION['ins_type_site'];
	$ins_title = $_SESSION['ins_title'];
	$ins_show = $_SESSION['ins_show'];
	$ins_max = $_SESSION['ins_max'];
	$ins_background = $_SESSION['ins_background'];
}else{
	$ins_type_site = "";
	$ins_title = "";
	$ins_show = 10;
	$ins_max = 30;
	$ins_background = "http://statis.megablogging.org/backgrounds/1.jpg";
}

if (isset($_SESSION['ins_db_host'])){
	$ins_db_host = $_SESSION['ins_db_host'];
	$ins_db_username = $_SESSION['ins_db_username'];
	$ins_db_password = $_SESSION['ins_db_password'];
	$ins_db_name = $_SESSION['ins_db_name'];
}else{
	$ins_db_host = "";
	$ins_db_username = "";
	$ins_db_password = "";
	$ins_db_name = "";
}

if (isset($_SESSION['uri_paging_index'])){
	$uri_paging_index = $_SESSION['uri_paging_index'];
	$uri_artikel_depan = $_SESSION['uri_artikel_depan'];
	$uri_artikel_belakang = $_SESSION['uri_artikel_belakang'];
	$uri_category = $_SESSION['uri_category'];
	$uri_search = $_SESSION['uri_search'];
	$uri_pages = $_SESSION['uri_pages'];
	$uri_feed = $_SESSION['uri_feed'];
}else{
	$uri_paging_index = "page";
	$uri_artikel_depan = "article";
	$uri_artikel_belakang = "/";
	$uri_category = "category";
	$uri_search = "search";
	$uri_pages = "pages";
	$uri_feed = "feed";
}
?>