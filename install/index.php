<?PHP
SESSION_START();
$root = dirname(dirname(__FILE__));
require_once("inc/save_form.php");
if (file_exists(dirname(dirname(__FILE__)).'/config.php')){header("location:../");exit();}
//step
if (isset($_GET['step'])){
	if (!isset($_SERVER['HTTP_REFERER'])){header("location:../");exit();}
	$step = abs((int)$_GET['step']);
	$step_name = "ke $step";
}else{
	$step = 1;
	$step_name = "Pertama";
	//chmod
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Install Megablogging Langkah <?PHP echo $step_name; ?></title> 
	<link href="css/style.css" rel="stylesheet"/>
	<link rel='shortcut icon' href='../favicon.ico'/>
</head>
<body style='margin-top:10px;'>
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
<?PHP
if ($step==1){
	require_once("inc/step1.php");
}else if ($step==2){
	require_once("inc/step2.php");
}else if ($step==3){
	require_once("inc/step3.php");
}else if ($step==4){
	require_once("inc/step4.php");
}else{echo "Step not found!";exit();}
?>	
</div>
<div id="bottom-footer" style='background:#000'>
	<div class='container'>
		<span id="copy-text" class="pull-left no-float-xs block-xs align-center-xs">&copy; <a href='http://www.megablogging.org'>Megablogging</a> 2013 - <?PHP echo date("Y"); ?>  All Rights Reserved &bull; Powered by <a href='http://megasoft-id.com'>Megasoft Informer</span>
			<ul id="footer-links" class="pull-right no-float-xs block-xs align-center-xs hidden-xs">
				<li><a href="<?PHP echo "http://www.megablogging.org" ?>">Home</a></li>
				<li><a href="<?PHP echo "http://products.megasoft-id.com" ?>">Our Products</a></li>
				<li><a href="<?PHP echo "http://template.megablogging.org" ?>">Template Megablogging</a></li>
				<li><a href="<?PHP echo "http://blog.megasoft-id.com" ?>">Demo</a></li>
				<li><a href="<?PHP echo "//www.megablogging.org/about.html" ?>">About</a></li>
			</ul>
	</div>
</div>
<?PHP require_once("inc/js.php"); ?>
<script type="text/javascript" src="js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    
    $('#step1').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
			
			title: {
                validators: {
                    notEmpty: {
                        message: 'Judul website Must Be Insert'
                    }
                }
            },
			
			type_site: {
                validators: {
                    notEmpty: {
                        message: 'pilih salah satu option!'
                    }
                }
            },
			
			show: {
                validators: {
					notEmpty: {
                        message: 'Show Data of Post in Blog Perpage Must Be Insert'
                    },
                    lessThan: {
                        value: 31,
                        inclusive: true,
                        message: 'max data yang bisa di tampilkan hanya 30'
                    },
                    greaterThan: {
                        value: 1,
                        inclusive: false,
                        message: 'min value is 2'
                    }
                }
            },
			
			max: {
                validators: {
					notEmpty: {
                        message: 'Show Data of Post in Blog Perpage Must Be Insert'
                    },
                    lessThan: {
                        value: 71,
                        inclusive: true,
                        message: 'max data yang bisa di tampilkan hanya 70'
                    },
                    greaterThan: {
                        value: 4,
                        inclusive: false,
                        message: 'min value is 5'
                    }
                }
            },
			
			background: {
                validators: {
                    notEmpty: {
                        message: 'background website Must Be Insert'
                    }
                }
            }
			
        }
    });
	
	$('#step2').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
			
			db_host: {
                validators: {
                    notEmpty: {
                        message: 'Host Name of database cannot be empty'
                    }
                }
            },
			
			db_username: {
                validators: {
                    notEmpty: {
                        message: 'Username of database cannot be empty'
                    }
                }
            },
			
			db_name: {
                validators: {
                    notEmpty: {
                        message: 'Database Name cannot be empty'
                    }
                }
            }
			
        }
    });
	
	$('#step3').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
			
			uri_artikel_depan: {
                validators: {
                    notEmpty: {
                        message: 'url cannot be empty'
                    },
					stringLength: {
                        min: 4,
                        max: 10,
                        message: 'uri article url : min 4 character dan maksimal 10 character'
                    },
					regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'url hanya boleh mengandung karakter alpabet, nomor, and garis bawah'
                    }
                }
            },
			
			uri_category: {
                validators: {
                    notEmpty: {
                        message: 'url cannot be empty'
                    },
					stringLength: {
                        min: 4,
                        max: 10,
                        message: 'feed url : min 4 character dan max 10 character'
                    },
					regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'url hanya boleh mengandung karakter alpabet, nomor, and garis bawah'
                    }
                }
            },
			
			uri_search: {
                validators: {
                    notEmpty: {
                        message: 'url cannot be empty'
                    },
					stringLength: {
                        min: 3,
                        max: 10,
                        message: 'search url : min 3 character dan max 10 character'
                    },
					regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'url hanya boleh mengandung karakter alpabet, nomor,and garis bawah'
                    }
                }
            },
			
			uri_pages: {
                validators: {
                    notEmpty: {
                        message: 'url cannot be empty'
                    },
					stringLength: {
                        min: 3,
                        max: 10,
                        message: 'url pages : min 3 character dan max 10 character'
                    },
					regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'url hanya boleh mengandung karakter alpabet, nomor,and garis bawah'
                    }
                }
            },
			
			uri_feed: {
                validators: {
                    notEmpty: {
                        message: 'url cannot be empty'
                    },
					stringLength: {
                        min: 3,
                        max: 10,
                        message: 'feed url : min 3 character dan max 10 character'
                    },
					regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'url hanya boleh mengandung karakter alpabet, nomor,and garis bawah'
                    }
                }
            },
			
			uri_paging_index: {
                validators: {
                    notEmpty: {
                        message: 'url cannot be empty'
                    },
					stringLength: {
                        min: 3,
                        max: 10,
                        message: 'uri paging index : min 3 character dan max 10 character'
                    },
					regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'url hanya boleh mengandung karakter alpabet, nomor,and garis bawah'
                    }
                }
            }
        }
    });
	
	$('#step4').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
			
			acceptTerms: {
                validators: {
                    notEmpty: {
                        message: 'You have to accept the terms and policies'
                    }
                }
            },
			admin_password: {
                validators: {
                    notEmpty: {
                        message: 'password Must Be Insert'
                    },
                    identical: {
                        field: 'admin_password2',
                        message: 'please insert retype password bellow'
                    }
                }
            },
            admin_password2: {
                validators: {
                    notEmpty: {
                        message: 'Konfirmasi password Must Be Insert'
                    },
                    identical: {
                        field: 'admin_password',
                        message: 'Retype password must be same with password'
                    },
                    
                }
            },
			
            admin_email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
			admin_username: {
                validators: {
                    notEmpty: {
                        message: 'Username Admin Must Be Insert'
                    }
                }
            },
			folder_admin: {
                validators: {
                    notEmpty: {
                        message: 'Admin Folder Must Be Insert'
                    },
					remote: {
                        url: 'proses/cek_admin_folder.php',
                        message: 'Select another name, this name has been use by another file/folder'
					},
					stringLength: {
                        min: 4,
                        max: 10,
                        message: 'folder name : min 4 character dan max 10 character'
                    }
                }
            },
			admin_name: {
                validators: {
                    notEmpty: {
                        message: 'Full Name Must Be Insert'
                    }
                }
            }
			
        }
    });
	
	// Validate the form manually
    $('#step1btn').click(function() {
        $('#step1').bootstrapValidator('validate');
    });
	$('#step2btn').click(function() {
        $('#step2').bootstrapValidator('validate');
    });
	$('#step3btn').click(function() {
        $('#step3').bootstrapValidator('validate');
    });
	$('#step4btn').click(function() {
        $('#step4').bootstrapValidator('validate');
    });
});

</script>
</body>
</html>