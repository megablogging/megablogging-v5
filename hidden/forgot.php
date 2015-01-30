<?PHP
include(dirname(dirname(__FILE__))."/config.php");
if (!isset($_SESSION['hidden_folder'])){
	echo "<h1>ACCESS DENIED</h1>";
	exit();
}
if (isset($_SESSION['admin_id'])){
header("location:home.mgb");
exit();
}
if (isset($_REQUEST['act']) and isset($_SERVER['HTTP_REFERER'])){
	//for action
	$act = $_REQUEST['act'];
	if ($act == 'send'){
		include_once("anti_xss.php");
		$email_or_username = $_POST['username'];
		$email_ku=$db->send_activation($email_or_username);
		require_once("in_recover.php");
		exit();
	}
	if ($act == 'recover'){
		if (isset($_POST['email']) and isset($_POST['activation'])){
			$email = $_POST['email'];
			$real = $db->get_activation_key($_POST['email']);
			$activation = $_POST['activation'];
			if ($real == $activation){
				$new = rand(0, 1000000);
				$pswd = md5($new);
				$sql_ubah_password = $db->query("update admin set pswd='$pswd' where email='$email' or name='$email'");
				echo "Password anda telah di rubah menjadi <b>$new</b><br>
				detail login anda :<br>
				email atau username : $_POST[email]<br>
				password : $new<br>
				<a href='index.php'>Login here!</a>
				";
			}else{
				echo "Activation Key is wrong!";
				exit();
			}
			exit();
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forget Your Password?</title> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Forget Your Password?">
	<meta name='og:image' content='<?PHP echo "$c_url/logo.png" ?>'/>
    <link rel="shortcut icon" href="<?PHP echo $c_url; ?>/favicon.ico">
	<meta name="robots" content="noindex">
	 <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<!-- bootstrap theme styles for this template -->
	<style>
	.form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}

.account-wall
{
    margin-top: 20px;
    padding: 40px 0px 20px 0px;
    background-color: #f7f7f7;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.login-title
{
    color: #555;
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
	</style>
	
</head>
<body style='background:url(<?PHP echo $c_background; ?>) fixed center'>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Lost You Password? reset your password here!</h1>
            <div class="account-wall">
                <img class="profile-img" src="<?PHP echo "$c_url/logo.png" ?>" alt="photo" width='120'>
                <form class="form-signin" action='' method='post'>
                <input type="text" class="form-control" placeholder="Email Or Username" required name='username' autofocus>
                <button style='margin-top:10px' class="btn btn-lg btn-primary btn-block" type="submit">
                    Send</button>
                <input type='hidden' name='act' value='send'/>
				</form>
            </div>
			<div id='forgot'>
				<center><a href='index.mgb' title='Login Here' class=''>Login Here</a></center>
			</div>
        </div>
    </div>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
	<script>
	
	</script>
</body>
</html>