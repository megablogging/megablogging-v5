<?php
  include("config.php");
  Header("Content-Type: text/xml");
  if (isset($_GET['start']) and isset($_GET['max'])){
	$start = abs(intval($_GET['start']));
	$max = abs(intval($_GET['max']));
  }else{
	$start = 0;
	$max = 10;
  }
  echo "<?xml version='1.0' encoding='utf-8'?>
<rss version='2.0' xmlns:content='http://purl.org/rss/1.0/modules/content/'
xmlns:wfw='http://wellformedweb.org/CommentAPI/'
xmlns:dc='http://purl.org/dc/elements/1.1/'
xmlns:sy='http://purl.org/rss/1.0/modules/syndication/'>
<channel>
<title>$c_title</title>
<link>$c_url</link>
<description>RSS of $c_title</description>
<language>en</language>
<image>
<title>$c_title</title>
<link>$c_url</link>
<url>$c_url/mgb-dir/assets/logo.png</url>
</image>
        ";
$rc = $db->fetch_multiple("select title,link,image,content from article order by article.date DESC, article.time DESC Limit $start, $max");
foreach ($rc as $r)
{
  $link = $r['link'];
  $judul = htmlentities(strip_tags($r['title']), ENT_QUOTES);
  $image_a = $r['image'];
  $keterangan = htmlentities(strip_tags($r['content']),
  ENT_QUOTES);
  $date = new DateTime($r['date']." ".$r['time']);
  $tanggalnya = $date->format("D, d M Y H:i:s O");
  $link = $app->get_link($link);
  echo "<item>";
  echo "<title>$judul</title>";
  echo "<link>$link</link>";
  echo "<description>$keterangan</description>";
  echo "<pubDate>$tanggalnya</pubDate>";
  echo "</item>";
}
echo "</channel></rss>";
?>