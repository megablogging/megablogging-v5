<?PHP
/**
 * @paket Megablogging
 * Copyright Megasoft Informer 2014
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 * Di Buat Oleh @Dewa_1995
 */
//file konfigurasi di sini
SESSION_START();
error_reporting(E_ERROR & ~E_NOTICE & ~E_WARNING);
define('_DB_HOST', 'localhost');
define('_DB_USER', 'root');
define('_DB_PASS', '');
define('_DB_NAME', 'megablogging5');
define('ROOT', dirname(__FILE__));
date_default_timezone_set("Asia/Jakarta");
include(ROOT.'/mgb-dir/lib/ini.lib.php');
$config = get_parse_ini(ROOT.'/config.ini.php');
//load config.ini.php
$c_domain = $config['config']['domain'];
$c_email_admin = $config['config']['email'];
$c_title = $config['config']['title'];
$c_url = $config['config']['url'];
$c_template = $config['config']['template'];
$c_perpage = $config['config']['show'];
$c_max_per_table = $config['config']['max'];
$c_background = $config['config']['background'];
$c_type_site = $config['config']['type_site'];
$c_sidebar = $config['config']['sidebar'];
$c_editor = $config['config']['editor'];
$c_go_url = $config['config']['go_url'];
//load engine penting di sini
$ds=DIRECTORY_SEPARATOR;
require_once(ROOT . '/mgb-dir/include/core.php');
?>