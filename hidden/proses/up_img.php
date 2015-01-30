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
$uri = "$c_url/mgb-dir/uploads/$tahun/$bulan";
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") 
{
	
    foreach ($_FILES['photos']['name'] as $name => $value)
    {
	
        $filename = stripslashes($_FILES['photos']['name'][$name]);
        $size=filesize($_FILES['photos']['tmp_name'][$name]);
        //get the extension of the file in a lower case format
          $ext = getExtension($filename);
          $ext = strtolower($ext);
     	
         if(in_array($ext,$valid_formats))
         {
	       if ($size < (MAX_SIZE*1024))
	       {
		   $image_name=$filename;
		   $image_name=strtolower($image_name);
		   $a_rand = rand(0, 1000);
		   require_once(ROOT."/mgb-dir/lib/replace_character.lib.php");
		   $image_name="$a_rand-".replace_character($image_name, false);
		   $image_name=str_replace(' ', '-', $image_name);
		   echo "<a href='$uri/$image_name' target='_blank'><img src='$uri/$image_name' class='imgList'></a>";
		   $newname="$path/$image_name";
           
           if (move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname)) 
           {
	       $time=time();
	       }
	       else
	       {
	        echo '<span class="imgList">You have exceeded the size limit! so moving unsuccessful! </span>';
            }

	       }
		   else
		   {
			echo '<span class="imgList">You have exceeded the size limit!</span>';
          
	       }
       
          }
          else
         { 
	     	echo '<span class="imgList">Unknown extension!</span>';
           
	     }
           
     }
}
?>