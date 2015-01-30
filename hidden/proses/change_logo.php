<?PHP
include(dirname(dirname(dirname(__FILE__)))."/config.php");
include(dirname(dirname(__FILE__))."/_session.php");
include(dirname(dirname(__FILE__))."/anti_xss.php");
define ("MAX_SIZE","9000"); 
function getExtension($str)
{
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
}
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
$my_destiny = ROOT."/logo.png";
if (isset($_FILES['logo'])){
	//do it 
	$filename=stripslashes($_FILES['logo']['name']);
    $size=filesize($_FILES['logo']['tmp_name']);
    //get the extension of the file in a lower case format
    $ext = getExtension($filename);
    $ext = strtolower($ext);
	if(in_array($ext,$valid_formats)){
		if ($size < (MAX_SIZE*1024)){
			//upload it
			if (move_uploaded_file($_FILES['logo']['tmp_name'], $my_destiny)) {
				header("location:../setting.mgb?msg=4");
			}else{
				echo "Error While Uploading Image!";
			}
		}else{
			echo 'You have exceeded the size limit!';
			exit();
		}
	}else{
		echo "<b>File Type Not Have Permission!</b> : Type file allowed : <span class='text-danger'>|jpg|png|jpeg|bmp|gif|</span>";
	}
}
?>