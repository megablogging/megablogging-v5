<?PHP
include(dirname(dirname(dirname(__FILE__)))."/config.php");
include(dirname(dirname(__FILE__))."/_session.php");
include(dirname(dirname(__FILE__))."/anti_xss.php");
function getExtension($str)
{
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
}
$valid_formats = array("zip","rar","docx","doc","exe","pdf","ppt","pptx","mp3","mp4");
#############################################untuk peletakan#################################
$main_dir = ROOT."/mgb-dir/uploads";
$tahun = date('Y');
$bulan = date('m');
$path = "$main_dir/$tahun/$bulan/";
//cek directory $tahun
if (!is_dir("$main_dir/$tahun")){
mkdir("$main_dir/$tahun", 0775); //buat folder baru
}
//cek folder $bulan ada ngak
if (!is_dir("$path")){
mkdir("$path", 0775); //buat folder baru
}
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") 
{
	//files
	$tempFile = $_FILES['file']['tmp_name'];
	$size = $_FILES['file']['size'];
	$filename = $_FILES['file']['name'];
	$ext = getExtension($filename);
	//complete filename
	$realname = $filename;
    if(in_array($ext,$valid_formats)){
		$a_rand = rand(0, 1000);
		require_once(ROOT."/mgb-dir/lib/replace_character.lib.php");
		$complete_name="$a_rand-".replace_character($filename, false);
		$newname="$path/$complete_name";
        if (move_uploaded_file($tempFile,$newname)){
			//save to database
			$data_files = array("real_filename"=>$realname, "filename"=>$complete_name, "folder"=>"$tahun/$bulan", "date"=>date("Y-m-d"), "time"=>date("H:i:s"), "user"=>$admin_id);
			$db->insert('files', $data_files);
			echo "Success!";
		}else{
			echo "<font color='red'>Error</font></br> Cannot To Upload</br>";
			exit();
		}
    }else{ 
		echo "<font color='red'>Error</font></br> Extension File Blocked (not Have Permission)</br>";
		exit();
	}     
}
?>