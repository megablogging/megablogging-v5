<?PHP
/**
 * @package Megablogging | www.megablogging.org | https://facebook.com/megablogging | https://twitter.com/megablogging
 * @copyright 2012-2014 Megasoft Informer (http://megasoft-id.com) | License: http://megasoft-id.com/license
 * @since version 5
 */
if (isset($_SESSION['admin_id'])){
	$admin_id = $_SESSION['admin_id'];
	//my profile
	$a_me = $db->fetch("select * from admin where id='$admin_id'");
	$a_name = $a_me['name'];
	$a_username = $a_me['username'];
	$a_email = $a_me['email'];
	$a_image = $a_me['image'];
	$a_level = $a_me['level'];
	$a_link = $a_me['link'];
	$a_pswd = $a_me['pswd'];
	$a_bio = $db->escape_string($a_me['bio']);
	//sidebar for mobile and desktop
	require_once(dirname(__FILE__)."/inc/deteksi-mobile.php");
	$device = new Mobile_Detect();
	if ($device->isMobile() == true){$c_sidebar_set = "";}else{if ($c_sidebar == 'full'){$c_sidebar_set = "";}else{$c_sidebar_set = "class='sidebar-mini'";}}
}else{
	header("location:index.mgb");
	exit();
}
?>