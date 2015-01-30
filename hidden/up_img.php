<?PHP
require_once(dirname(dirname(__FILE__))."/config.php");
require_once("_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Upload Image - Admin Megablogging</title>
<link rel='stylesheet' href='assets/css/bootstrap.css'/>
<link rel='shorcut icon' href='<?PHP echo "$c_url/favicon.ico" ?>'/>
<style>
body{
	margin-top:20px;
	background:#dcdcdc
}
#preview
{
color:#cc0000;
font-size:12px
}
.imgList 
{
width:195px;
border:solid 1px #dedede;
padding:10px;
margin-left:5px;	
}
.box{
  min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
}
.box1{
  min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #fff;
  border: 1px solid #ddd;
}
.box1:hover{
  -webkit-box-shadow: 0 0 10px rgba(0,0,0,0.2);
  -moz-box-shadow: 0 0 10px rgba(0,0,0,0.2);
  -o-box-shadow: 0 0 10px rgba(0,0,0,0.2);
  -ms-box-shadow: 0 0 10px rgba(0,0,0,0.2);
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
}
}
</style>
</head>
<body>
    <div class='container'>
		<div class='row'>
			<div class='col-md-12'>
				<div class='box1'>
					<h4>Upload Image <span class='pull-right'><a href='home.mgb' title='back to home page' class='btn btn-success btn-sm'>Go To Main Page</a></span></h4>
					<hr>
					<div class='alert alert-info'>
						Support For Multiple Uploads, only file : |.jpg|.jpeg|.gif|.bmp|.png| can be upload
						<?PHP require_once("inc/php.ini.php"); ?>
						<br>Your Server Just Allowed, Max File Size For Upload : <span class='text-danger'><?PHP echo $a_size_max; ?></span>
					</div>
					<form id="imageform" method="post" enctype="multipart/form-data" action='proses/up_img.php' style="clear:both">
						<div id='imageloadstatus' style='display:none'><img src="assets/images/loader.gif" alt="Uploading...."/></div>
						<div id='imageloadbutton'>
						<input type="file" name="photos[]" id="photoimg" multiple="true" />
						</div>
					</form>
					<div id='preview' style='margin-top:10px'>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.form.js"></script>
<script>
 $(document).ready(function() { 
		
            $('#photoimg').die('click').live('change', function()			{ 
			    
				$("#imageform").ajaxForm({target: '#preview', 
				     beforeSubmit:function(){ 
					
					console.log('ttest');
					$("#imageloadstatus").show();
					 $("#imageloadbutton").hide();
					 }, 
					success:function(){ 
				    console.log('test');
					 $("#imageloadstatus").hide();
					 $("#imageloadbutton").show();
					}, 
					error:function(){ 
					console.log('xtest');
					 $("#imageloadstatus").hide();
					$("#imageloadbutton").show();
					} }).submit();
					
		
			});
        }); 
</script>
</html>
