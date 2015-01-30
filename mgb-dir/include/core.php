<?PHP
/**
 * @package Megablogging 5
 * @copyright 2012-2014 Megasoft Informer (http://megasoft-id.com) | License: http://megasoft-id.com/license
 * @since version 5
 */
//DEFINE EVRYTHING HERE
 define('_VERSION', "5");
 define('_EXECUTION',microtime(TRUE));
 define('TEMPLATE_DIR', ROOT."/template/$c_template");
 define('TEMPLATE_URL', "$c_url/template/$c_template");
 define('APP_URL', $c_url);
 define('ADMIN_URL', $c_admin_url);
 define("FILE_PUT_CONTENTS_ATOMIC_TEMP", dirname(__FILE__)."/cache");
 define("FILE_PUT_CONTENTS_ATOMIC_MODE", 0777);
 //define url rewrite base for .htaccess
 define("uri_paging_index", $config['url']['uri_paging_index']);
 define("uri_artikel_depan", $config['url']['uri_artikel_depan']);
 define("uri_artikel_belakang", $config['url']['uri_artikel_belakang']);
 define("uri_category", $config['url']['uri_category']);
 define("uri_search", $config['url']['uri_search']);
 define("uri_pages", $config['url']['uri_pages']);
 define("uri_feed", $config['url']['uri_feed']);
 $uri_paging_index = uri_paging_index;
 $uri_artikel_depan = uri_artikel_depan;
 $uri_artikel_belakang = uri_artikel_belakang;
 $uri_category = uri_category;
 $uri_search = uri_search;
 $uri_pages = uri_pages;
 $uri_feed = uri_feed;
//define old variable
 $url = $c_url;
 $title = $c_title;
 $perpage = $c_perpage;
 $type_site = $c_type_site;
 $max_per_table = $c_max_per_table;
 define('_V_', _VERSION);
//is logged
if (isset($_SESSION['admin_id'])){
	define('logged', $_SESSION['admin_id']);
}else{
	define('logged', '0');
}
//APP CLASSES
require_once(ROOT."/mgb-dir/include/app.class.php");
$app=new App(); //semua function-function penting dari megablogging di sini
require_once(ROOT."/mgb-dir/include/db.class.php");
$db=new Database(_DB_HOST, _DB_USER, _DB_PASS, _DB_NAME); //untuk melakukan query sql sekarang di sini
//include library needed here
require_once(ROOT . '/mgb-dir/lib/statistik.lib.php');
require_once(ROOT . '/mgb-dir/lib/anti_sql_injection.lib.php');
require_once(ROOT . '/mgb-dir/lib/anti_xss.lib.php');
require_once(ROOT . '/mgb-dir/lib/indonesia.lib.php');
?>