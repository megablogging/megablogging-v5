<?PHP
include(dirname(dirname(__FILE__))."/config.php");
if (isset($_GET['act']) and isset($_GET['id'])){
	$act = $_GET['act'];
	$idnya = abs((int)$_GET['id']);
	if ($act == "post"){
		$data=$db->fetch("select link from article where id='$idnya'");
		if (array($data)){
			$my_destination = $app->get_link($data['link']);
			header("location:$my_destination");
			exit();
		}else{
			echo "Invalid Go URL!";
		}
	}else if($act == "pages"){
		$data=$db->fetch("select link from pages where id='$idnya'");
		if (array($data)){
			$my_destination = $app->get_link_pages($data['link']);
			header("location:$my_destination");
			exit();
		}else{
			echo "Invalid Go URL!";
		}
	}else if($act == "files"){
		$data = $db->fetch("select * from files where id='$idnya'");
		if (is_array($data)){
			$filename = $data['filename'];
			$folder = $data['folder'];
			$go="$c_url/mgb-dir/uploads/$folder/$filename";
			$db->query("update files set hits=hits+1 where id='$idnya'");//update
			header("location:$go");
		}else{
			echo "FILE NOT FOUND!";
		}
	}else if($act == "category"){
		$data = $db->fetch("select link from category where id='$idnya'");
		if (is_array($data)){
			$go = "$c_url/$uri_category/$data[link]";
			header("location:$go");
		}else{
			echo "Category Not Found!";
		}
	}else if($act == "feed"){
		$go = "$c_url/$uri_feed/";
		header("location:$go");
	}else{
		echo "METHOD IS ERROR!";
	}
}else{
	echo "INVALID GO URL!";
}
?>
