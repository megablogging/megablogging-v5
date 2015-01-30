<!DOCTYPE html>
<html>
<head>
	<title>Success! - Install Megablogging</title> 
	<link href="css/style.css" rel="stylesheet"/>
	<link rel='shortcut icon' href='../favicon.ico'/>
	<style>
		#fb-root {display: none;} 
		.fb_iframe_widget,
		.fb_iframe_widget span,
		.fb_iframe_widget span iframe[style] {
		  min-width: 100% !important;
		  width: 100% !important;
		}
	</style>
</head>
<body style='margin-top:10px;'>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&appId=255142777974306&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class='container'>
<div class='row'>
<div class='col-md-5'><a target='_blank' href='//www.megablogging.org'><img src='../mgb-dir/assets/logo.png' width='100%'/></a></div>
<div class='col-md-7'>
	<div class='pull-right' style='margin-top:6%'>
		<a target='_blank' class='btn btn-default btn-large tipsy-kiri-atas' href='http://www.megablogging.org' title='Official Site Megablogging'><i class='fa fa-globe'></i></a>
		<a target='_blank' class='btn btn-primary btn-large tipsy-kiri-atas' href='https://facebook.com/megablogging' title='Facebook Megablogging'><i class='fa fa-facebook'></i></a>
		<a target='_blank' class='btn btn-info btn-large tipsy-kiri-atas' href='https://twitter.com/megablogging' title='Twitter Megablogging'><i class='fa fa-twitter'></i></a>
		<a target='_blank' class='btn btn-danger btn-large tipsy-kiri-atas' href='https://google.com/+DewaBagasKara1995' title='Google+ Author'><i class='fa fa-google-plus'></i></a>
		<a target='_blank' class='btn btn-default btn-large tipsy-kiri-atas' href='https://go.megasoft-id.com/github' title='Github Of Megasoft Infromer'><i class='fa fa-github'></i></a>
		<a target='_blank' class='btn btn-danger btn-large tipsy-kiri-atas' href='https://go.megasoft-id.com/youtube' title='Youtube Channel Megasoft'><i class='fa fa-youtube-play'></i></a>
	</div>
</div>
</div>
<div class='row' style='margin-top:10px'>
		<div class='col-md-12'>
			<div class='box1'>
				<div class='pull-right'><img height='50px' src='<?PHP echo "../mgb-dir/assets/favicon-b.png"; ?>'/></div>
				<h3>Installation Finish</h3> 
				<hr class='colorgraph'/>
				<div class='alert alert-success'>
				Installation process has been completed. CMS <a href='//www.megablogging.org'>Megablogging</a> Successfully Installed on your server. For download template megablogging, you can downoad it at <a target='_blank' href='//template.megablogging.org'>here</a> or <a target='_blank' href='http://blog.mas-dewa.com/category/template-megablogging'>here</a>
				</div>
				<a target='_blank' href='//www.megablogging.org' class='btn btn-default'><i class='fa fa-globe'></i> Official Site Of Megablogging</a>
				<a target='_blank' href='<?PHP echo $url; ?>' class='btn btn-success'><i class='fa fa-search'></i> View Your Site</a>
				<a target='_blank' href='<?PHP echo "$url/$folder_admin"; ?>' class='btn btn-primary'><i class='fa fa-user'></i> Admin Page Of Your Site</a>
				<div class='alert alert-danger' style='margin-top:10px'>
				<b>Note :</b> For Access Your Admin Page use this url : <a href='<?PHP echo "$url/$folder_admin"; ?>'><?PHP echo "$url/$folder_admin"; ?></a>
				</div>
				<?PHP if ($type_site == "Online"){ ?>
				<hr>
				<div class='row'>
					<div class='col-md-7 col-sm-7'>
						<h3>Comments</h3>
						<hr class='colorgraph' style='height:3px'>
						<div class="fb-comments" data-href="http://www.megablogging.org" data-numposts="10" data-colorscheme="light" data-width="100%"></div>
					</div>
					<div class='col-md-5 col-sm-5'>
						<h3>Like This</h3>
						<hr class='colorgraph' style='height:3px'>
						<div class="fb-like-box" data-href="https://www.facebook.com/megablogging" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
					</div>
				</div>
				<?PHP } ?>
			</div>
		</div>
	</div>

</div>
<div id="bottom-footer" style='background:#000'>
	<div class='container'>
		<span id="copy-text" class="pull-left no-float-xs block-xs align-center-xs">&copy; <a href='http://www.megablogging.org'>Megablogging</a> 2013 - <?PHP echo date("Y"); ?>  All Rights Reserved &bull; Powered by <a href='http://megasoft-id.com'>Megasoft Informer</span>
			<ul id="footer-links" class="pull-right no-float-xs block-xs align-center-xs hidden-xs">
				<li><a href="<?PHP echo "http://www.megablogging.org" ?>">Home</a></li>
				<li><a href="<?PHP echo "http://products.megasoft-id.com" ?>">Our Products</a></li>
				<li><a href="<?PHP echo "http://template.megablogging.org" ?>">Template Megablogging</a></li>
				<li><a href="<?PHP echo "http://blog.mas-dewa.com" ?>">Demo</a></li>
				<li><a href="<?PHP echo "//www.megablogging.org/about.html" ?>">About</a></li>
			</ul>
	</div>
</div>
<?PHP require_once("inc/js.php"); ?>