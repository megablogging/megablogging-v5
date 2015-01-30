<?PHP
include(dirname(dirname(__FILE__))."/config.php");
//cek session access
if (!isset($_SESSION['hidden_folder'])){
	echo "<h1>ACCESS DENIED</h1>";
	exit();
}
if (isset($_POST['act'])){
	//do login here
	include_once("anti_xss.php");
	$email = $_POST['email'];
	$pass = md5($_POST['password']);
	$sql = "select * from admin where username='$email' or email='$email'";
	$hasil = $db->num_rows($sql);
	if ($hasil==0){
		header("location:index.mgb?error=2");
		exit();
	}else{
		$data = $db->fetch($sql); 
		$pswd = $data['pswd'];
		$id = $data['id'];
		if ($pass == $pswd){
			$_SESSION['admin_id']=$id;
			header("location:home.mgb");
			exit();
		}
		else {
			header("location:index.mgb?error=1");
			exit();
		}
	}
}
if (isset($_SESSION['admin_id'])){
header("location:home.mgb");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Admin page</title> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Login To Admin Page">
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
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
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
            <h1 class="text-center login-title">Sign in for continue to admin page of <?PHP echo $c_domain; ?></h1>
            <div id='messages'>
				<?PHP
					if (isset($_GET['error'])){
						require_once("anti_xss.php");
						$error = $_GET['error'];
						if ($error==1){ //password is wrong
							$messages = "Oppps... Password Is Wrong! Try Again";
						}else{
							$messages = "Oppps... Username or email incorrect! Try Again";
						}
						echo "
						<div class='alert alert-danger'>
							$messages
						</div>
						";
					}
				?>
			</div>
			<div class="account-wall">
                <img class="profile-img" src="<?PHP echo "$c_url/logo.png"; ?>" alt="photo" width='120'>
                <form class="form-signin" action='' method='post'>
                <input type="text" class="form-control" placeholder="Email Or Username" required name='email' autofocus>
                <input type="password" class="form-control" placeholder="Password" name='password' required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
				<input type='hidden' name='act' value='login'/>
                </form>
            </div>
			<div id='forgot'>
				<center><a href='forgot.mgb' title='forget your password?? reset here' class=''>Forget Your Password?</a></center>
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