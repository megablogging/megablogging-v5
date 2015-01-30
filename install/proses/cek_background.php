<?PHP
sleep(1);
error_reporting(0);
function get_ext($key) { 
	$key=strtolower(substr(strrchr($key, "."), 1));
	$key=str_replace("jpeg","jpg",$key);
	return $key;
}
$valid = false;
if (isset($_REQUEST['background'])) {
	$url = $_REQUEST['background'];
	$allow_types=array("jpg","jpeg","bmp","gif","png");
	$ext = get_ext($url);
	#cek extension file
		if (!in_array($ext, $allow_types)){
			$valid = false;
		}else{
			$valid=false;
		}
}
echo json_encode(array(
    'valid' => $valid,
));
?>