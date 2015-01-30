<?PHP
if(!isset($email_ku)){
exit();
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
	<div class='alert alert-success' style='margin-top:10px'>
		Activation Code has been send to your email : <b><?PHP echo $email_ku ?></b><br>If you not found message from team megablogging, check in your spam folder
	</div> 
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Insert Activation Code In Your Email to reset your password here!</h1>
            <div class="account-wall">
                <img class="profile-img" src="<?PHP echo "$c_url/logo.png" ?>" alt="photo" width='120'>
                <form class="form-signin" action='forgot.php' method='post'>
                <input type="text" class="form-control" placeholder="Code Activation" required name='activation' autofocus>
                <button style='margin-top:10px' class="btn btn-lg btn-primary btn-block" type="submit">
                    Reset Password Now</button>
                <input type='hidden' name='act' value='recover'/>
				<input type='hidden' name='email' value='<?PHP echo $email_ku; ?>'/>
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