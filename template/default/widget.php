<?PHP
	//load all widget here
	######################Getting Content Widget (HTML/CSS/Javascrit Code) From Database############################
	$data_wg = $db->select("widget", "title,content,type", null, "widget.number ASC");
	foreach($data_wg as $data_widget){
	$title_widget = $data_widget['title'];
	$content_widget = $data_widget['content'];
	$type_widget = $data_widget['type'];
	if (!empty($title_widget)){ //1 = isinya berupa kode html (di echo)
	?>
	<div class='<?PHP echo "$ribbon_widget_style $ribbon_widget"; ?> ribbon'><?PHP echo $title_widget; ?></div>
	<div class="well">
		<div class="widget-content sidebar-nav">
			<?PHP require_once(ROOT."/mgb-dir/widget/$content_widget"); ?>
		</div>
	</div>
	<?PHP
	}else{ //2 = isinya file php yang berada di root/mgb-dir/widget/ (di include)
	?>
		<div class="widget-content" style='margin-top:10px'>
			<?PHP require_once(ROOT."/mgb-dir/widget/$content_widget"); ?>
		</div>
	<?PHP
	}}
	?>