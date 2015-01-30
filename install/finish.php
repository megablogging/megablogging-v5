<?PHP
SESSION_START();
if (file_exists(dirname(dirname(__FILE__)).'/config.php')){header("location:../");exit();}
if (!isset($_SERVER['HTTP_REFERER'])){echo "No Data Found!";exit();}
$title = $_SESSION['ins_title'];
$url = $_POST['url'];
$company = $_SESSION['ins_title'];
$domain = $_POST['url'];
$host = $_SESSION['ins_db_host'];
$name = $_SESSION['ins_db_username'];
$pswd = $_SESSION['ins_db_password'];
$db = $_SESSION['ins_db_name'];
$max = $_SESSION['ins_max'];
$show = $_SESSION['ins_show'];
$install_sample_wg = 'yes';
$install_sample_art = 'yes';
$install_sample_mn = 'yes';
$background = $_SESSION['ins_background'];
$type_site = $_SESSION['ins_type_site'];
$path = $_POST['path'];
$admin_name = $_POST['admin_name'];
$admin_email = $_POST['admin_email'];
$password_email = md5($_POST['admin_password']);
$admin_username = $_POST['admin_username'];
$folder_admin = $_POST['folder_admin'];
$_SESSION['uri_hidden'] = $folder_admin;
define('ROOT', dirname(dirname(__FILE__)));
//echo "$title<br>$url<br>$company<br>$domain<br>$host<br>$name<br>$pswd<br>$db<br>$admin_name<br>$admin_email<br>$password_email";exit();
if (empty($host)){
header("location:index.php");
exit();
}
//koneksi
$mysqli_do = new mysqli($_SESSION['ins_db_host'], $_SESSION['ins_db_username'], $_SESSION['ins_db_password'], $_SESSION['ins_db_name']);
if (!empty($title)){
include("database.php");
}
$koneksi = "db/koneksi.txt";
$config = "<?PHP
/**
 * @paket Megablogging
 * Copyright Megasoft Informer 2015
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 * Di Buat Oleh @Dewa_1995 | wwww.mas-dewa.com
 */
//file konfigurasi di sini
SESSION_START();
error_reporting(E_ERROR & ~E_NOTICE & ~E_WARNING);
define('_DB_HOST', '$host');
define('_DB_USER', '$name');
define('_DB_PASS', '$pswd');
define('_DB_NAME', '$db');
";
$filehandle=fopen($koneksi, 'r');
$data_koneksi=fread($filehandle,filesize($koneksi));
$handle=fopen("$path/config.php",'w');
fwrite($handle,$config);
fwrite($handle,$data_koneksi);
include("inc/finish.php");
?>