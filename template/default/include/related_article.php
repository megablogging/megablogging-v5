<div style='margin:0; padding:10px;height:200px;overflow:auto;border:1px solid #ccc;'>
	<?PHP
	$max_releated_article = 20; //setting for max related article here
	$j_cat = 0;
	while ($j_cat <= $jumlah_category){
	$cat_me = $a_category["$j_cat"];
	?>
	<ul><b><i><me style='font-size:17px;margin-left:-30px;'><?PHP echo $cat_me; ?></me></i></b>
	<?PHP
		$data_related_art = $db->select("article", "title, link, image", "category like '%$cat_me%' and title!='$a_title'", "rand()", "0, $max_releated_article");
		foreach($data_related_art as $data_related){
		$a_judul = $data_related['title'];
		$a_link = $data_related['link'];
		$a_image = $data_related['image'];
		if (empty($a_image)){
		$a_image = "$url/mgb-dir/assets/favicon.png";
		}
		?>
		<li style="margin-left:-5px;margin-bottom:0px;"><a class='tipimage' rel='<?PHP echo $a_image ?>' title='<?PHP echo $a_judul ?>' href="<?PHP echo $app->get_link($a_link); ?>"><?PHP echo $a_judul; ?></a></li>
		<?PHP
		}
		?>
	</ul>
	<?PHP
	$j_cat++;
	}
	?>
</div>