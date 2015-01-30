<?PHP
include(dirname(dirname(dirname(__FILE__)))."/config.php");
include(dirname(dirname(__FILE__))."/_session.php");
include(dirname(dirname(__FILE__))."/_session_lv.php");
include(dirname(dirname(__FILE__))."/anti_xss.php");
function get_ext($key) { #function get extension file
	$key=strtolower(substr(strrchr($key, "."), 1));
	$key=str_replace("jpeg","jpg",$key);
	return $key;
	}
$dir = ROOT."/template";
$file_zip = basename($_FILES['file_template']['name']);
$file_zip = strtolower($file_zip);
$file_ext= get_ext($file_zip);
$target = "$dir/$file_zip";
$file_xml = str_replace('.zip', '', $file_zip);
if ($file_ext == "zip"){
if(move_uploaded_file($_FILES['file_template']['tmp_name'], $target)){ #proses upload filenya
$zip = "$target";
include(ROOT."/mgb-dir/lib/pclzip.lib.php");
@set_time_limit(0);
$archive = new PclZip($zip);
if ($archive->extract(PCLZIP_OPT_PATH, ROOT.'/template/') == 0)
{
if ($app->check_template($file_xml) == false){
echo "Error!,.. This file is not template of megablogging!.";
unlink($zip);
exit();
}
die("Error : ".$archive->errorInfo(true));
}
else{
	unlink($zip);	
	echo "Success Install New Template! Please Refresh This Page to view your new template!";
	}
}
else{
echo "Can't Upload Template!";
exit();
}
}
else{
echo "File Extension Must be .zip";
exit();
}
?>