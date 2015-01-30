<?PHP
function load_stylesheet($alamat_file_stylesheet, $alamat_template){
	$file_template=fopen($alamat_file_stylesheet, 'r');
	$data_template=fread($file_template,filesize($alamat_file_stylesheet));
	$data_template_new=str_replace('$template_dir', "$alamat_template", $data_template);
	return "$data_template_new";
}
function load_javascript($alamat_file_stylesheet, $alamat_template){
	$file_template=fopen($alamat_file_stylesheet, 'r');
	$data_template=fread($file_template,filesize($alamat_file_stylesheet));
	$data_template_new=str_replace('$template_dir', "$alamat_template", $data_template);
	return "$data_template_new";
}
?>