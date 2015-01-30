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
if (!file_exists(dirname(__FILE__).'/config.php')){header("location:install");exit();}
//load file konfigurasi
require_once("config.php");
//load home page
if (isset($_GET['error'])){
	$error = abs((int)$_GET['error']);
	if ($error == 403){
		require_once($app->_403());
	}else if ($error == 404){
		require_once($app->_404());
	}else if ($error == 405){
		require_once($app->_405());
	}
}else{
	require_once($app->_home());
}
?>