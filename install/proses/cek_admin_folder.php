<?PHP
sleep(1);
error_reporting(0);
function get_ext($key) { 
	$key=strtolower(substr(strrchr($key, "."), 1));
	$key=str_replace("jpeg","jpg",$key);
	return $key;
}
$valid = false;
if (isset($_REQUEST['folder_admin'])) {
	$folder_admin = $_REQUEST['folder_admin'];
	$main_dir = dirname(dirname(dirname(__FILE__)));
	if(!file_exists("$main_dir/$folder_admin") or $folder_admin=='admin'){
		$valid=true;
	}else{
		$valid=false;
	}
}
echo json_encode(array(
    'valid' => $valid,
));
?>