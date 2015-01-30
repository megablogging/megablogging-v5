<?PHP
include(dirname(dirname(dirname(__FILE__)))."/config.php");
include(dirname(dirname(__FILE__))."/_session.php");
include(dirname(dirname(__FILE__))."/_session_lv.php");
include(dirname(dirname(__FILE__))."/anti_xss.php");
$upload_dir = ROOT."/mgb-dir/temp";
$target = "$upload_dir/updater.zip";
$target_sql = "$upload_dir/updater.sql";
include(dirname(dirname(__FILE__))."/act/check_update.mgb");
$link_download = "$site_megablogging/get/lastest-update.zip";
$link_download_sql = "$site_megablogging/get/lastest-update.sql";
$app->remote_upload($link_download, $target);
$app->remote_upload($link_download_sql, $target_sql);
@set_time_limit(0);
include(ROOT."/mgb-dir/lib/pclzip.lib.php");
$archive = new PclZip($target);
if ($archive->extract(PCLZIP_OPT_PATH, ROOT, PCLZIP_OPT_REPLACE_NEWER) == 0){
	echo "Error : ".$archive->errorInfo(true);
	unlink($target);
}else{
	//run sql query
	$mysqli_do = new mysqli(_DB_HOST, _DB_USER, _DB_PASS, _DB_NAME);
	$filehandle_sql=fopen($target_sql, 'r');
	$data_sql=fread($filehandle_sql,filesize($target_sql));
	$sample_sql = str_replace('$url_gue', "$c_url", $data_sql);
	$mysqli_do->query($sample_sql);
	unlink($target);
	unlink($target_sql);
	echo "Success Update Your Megablogging!";
}
?>