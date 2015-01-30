<?PHP
/**
 * @paket Megablogging
 * Copyright Megasoft Informer 2014
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 * Di Buat Oleh @Dewa_1995
 */
#MULAI 
//cek installasi (berdasarkan file install.txt yang ada di directory admin)
if (file_exists(dirname(__FILE__) . '/admin/install.txt')){header("location:install");exit();}
//load file konfigurasi
require_once("config.php");
//load category
require_once($app->_category());
?>