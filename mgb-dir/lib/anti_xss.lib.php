<?PHP
//this code create by dewa
function anti_xss($my_real_domain){
	//get referer
	if (isset($_SERVER['HTTP_REFERER'])){
	$referal = strtolower($_SERVER['HTTP_REFERER']);
	}else{
	$referal = 'None';
	}
	$hasil_validate=substr_count($referal, strtolower($my_real_domain));
	if ($hasil_validate > 0){
		return true;
	}else{
		return false;
	}
}
?>