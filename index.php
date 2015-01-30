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
//accesss hidden folder alias admin page
if(isset($_REQUEST['act'])){
	$act = $_REQUEST['act'];
	if($act == 'hidden_folder'){
		//cek
		$my_url = $app->CURRENT_URL();
		$validating=substr_count(strtolower($my_url), strtolower("act=hidden_folder"));
		if ($validating == 0){
			//do it
			$_SESSION['hidden_folder'] = 1;
			header("location:$c_url/hidden");
			exit();
		}else{
			echo "<h1>ACCESS DENIED</h3>";
			exit();
		}
	}
}
//load home page
require_once($app->_home());
?>