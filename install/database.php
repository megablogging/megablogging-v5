<?PHP
if (empty($install_sample_art)){
header("location:../");
exit();
}
//before do import, drop all table
$mysqli_do->query("
DROP TABLE `admin`, `article`, `browser`, `category`, `files`, `menu`, `pages`, `statistik`, `submenu`, `widget`;
");
##################Tabel Admin And User Admin###########################################################
$mysqli_do->query("
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pswd` varchar(40) NOT NULL,
  `image` varchar(200) NOT NULL,
  `bio` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
");
$image_admin = "$url/mgb-dir/assets/avatar.png";
$mysqli_do->query("Insert into admin values('', '$admin_name', '$admin_username', '$admin_email', '$password_email', '$image_admin', '', '', '1')");
########################################################################################################
##################Tabel Browser And add Browser#########################################################
$mysqli_do->query("
CREATE TABLE IF NOT EXISTS `browser` (
  `name` varchar(100) NOT NULL,
  `hits` varchar(100) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
");
$mysqli_do->query("
INSERT INTO `browser` (`name`, `hits`) VALUES
('Firefox', 0),
('Chrome', 0),
('Opera', 0),
('IE', 0),
('Safari', 0),
('Others', 0);
");
########################################################################################################
##############################Create Tabel "article"####################################################
$mysqli_do->query("
CREATE TABLE IF NOT EXISTS `article` (
`id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `content` text NOT NULL,
  `hits` int(100) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `link` varchar(1000) NOT NULL,
  `category` varchar(1000) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `shoot` text NOT NULL,
  `user` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");
########################################################################################################
###################################CREATE TABLE "files"#################################################
$mysqli_do->query("
CREATE TABLE IF NOT EXISTS `files` (
`id` int(10) NOT NULL AUTO_INCREMENT,
  `real_filename` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `hits` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `user` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");
########################################################################################################
#################################Create Tabel "category"################################################
$mysqli_do->query("
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `link` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");
$mysqli_do->query("
INSERT INTO `category` (`id`, `name`, `link`) VALUES
(1, 'Uncategories', 'uncategories'),
(2, 'PHP', 'php');
");
########################################################################################################
#################################################Table Pages############################################
$mysqli_do->query("
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `hits` int(10) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `link` varchar(200) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
");
##############################Saving ini Configuration##################################################
require_once("$path/mgb-dir/lib/ini.lib.php");
$ini_file = "$path/config.ini.php";
$ini_value = get_parse_ini($ini_file);
$ini_value['config']['domain'] = str_replace('https://','', str_replace('http://', '', $domain));
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['email'] = $admin_email;
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['company'] = $company;
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['url'] = $url;
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['show'] = $show;
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['title'] = $title;
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['template'] = 'default';
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['max'] = $max;
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['background'] = $background;
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['slider_height'] = 350;
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['max_releated_article'] = 10;
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['type_site'] = "$type_site";
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['sidebar'] = "mini";
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['editor'] = "ckeditor";
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['go_url'] = "$url/go";
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['config']['admin_url'] = "$url/hidden";
put_ini_file("$ini_file", $ini_value, $i = 0);
//url
$ini_value['url']['uri_paging_index'] = $_SESSION['uri_paging_index'];
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['url']['uri_artikel_depan'] = $_SESSION['uri_artikel_depan'];
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['url']['uri_artikel_belakang'] = $_SESSION['uri_artikel_belakang'];
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['url']['uri_category'] = $_SESSION['uri_category'];
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['url']['uri_search'] = $_SESSION['uri_search'];
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['url']['uri_pages'] = $_SESSION['uri_pages'];
put_ini_file("$ini_file", $ini_value, $i = 0);
$ini_value['url']['uri_feed'] = $_SESSION['uri_feed'];
put_ini_file("$ini_file", $ini_value, $i = 0);
########################################################################################################
##############################Create Tabel "statistik"##################################################
$mysqli_do->query("
CREATE TABLE IF NOT EXISTS `statistik` (
  `hits` int(100) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
");
########################################################################################################

##############################Create Tabel "widget"#####################################################
$mysqli_do->query("
CREATE TABLE IF NOT EXISTS `widget` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `content` text NOT NULL,
  `number` int(10) NOT NULL,
  `type` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");
########################################################################################################
##############################Create Tabel "menu"#######################################################
$mysqli_do->query("
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `type` int(1) NOT NULL,
  `target` varchar(100) NOT NULL,
  `number` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");
########################################################################################################
##############################Create Tabel "submenu"####################################################
$mysqli_do->query("
CREATE TABLE IF NOT EXISTS `submenu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `target` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
");
########################################################################################################
#######################################Sample Article###################################################
if ($install_sample_art == 'yes'){
$sql_art = 'db/sample_art.sql';
$filehandle_art=fopen($sql_art, 'r');
$data_art=fread($filehandle_art,filesize($sql_art));
$sample_art = str_replace('$url_gue', "$url", $data_art);
$q_art = $mysqli_do->query($sample_art);
if (!$q_art){
echo "error add article because ".mysql_error();
}
}
########################################################################################################
######################################Sample Menu & Submenu#############################################
if ($install_sample_mn == 'yes'){
//For Menu
$sql_menu = 'db/sample_menu.sql';
$filehandle_menu=fopen($sql_menu, 'r');
$data_menu=fread($filehandle_menu,filesize($sql_menu));
$sample_menu = str_replace('$url_gue', "$url", $data_menu);
$mysqli_do->query($sample_menu);
//For Sub Menu
$sql_submenu = 'db/sample_submenu.sql';
$filehandle_submenu=fopen($sql_submenu, 'r');
$data_submenu=fread($filehandle_submenu,filesize($sql_submenu));
$sample_submenu = str_replace('$url_gue', "$url", $data_submenu);
$mysqli_do->query($sample_submenu);
}
########################################################################################################
#######################################Default Widget###################################################
$sql_widget = 'db/sample_widget.sql';
$filehandle_widget=fopen($sql_widget, 'r');
$data_widget=fread($filehandle_widget,filesize($sql_widget));
$sample_widget = str_replace('$url_gue', "$url", $data_widget);
$mysqli_do->query($sample_widget);
########################################################################################################
#######################################Sample Pages#####################################################
$sql_pages = 'db/sample_page.sql';
$filehandle_pages=fopen($sql_pages, 'r');
$data_pages=fread($filehandle_pages,filesize($sql_pages));
$sample_pages = str_replace('$url_gue', "$url", $data_pages);
$mysqli_do->query($sample_pages);
########################################################################################################
#######################################.htaccess########################################################
if ($install_sample_art == 'yes'){
//copy file engine
$prefix = rand(10000, 100000);
copy("db/mgb-category.php", "$path/$prefix-mgb-category.php");
copy("db/mgb-pages.php", "$path/$prefix-mgb-pages.php");
copy("db/mgb-rss.php", "$path/$prefix-mgb-rss.php");
copy("db/mgb-search.php", "$path/$prefix-mgb-search.php");
copy("db/mgb-view.php", "$path/$prefix-mgb-view.php");
$htaccess = "$path/mgb-dir/assets/hta.txt"; //sample htac
$handle_hta=fopen($htaccess, 'r');
$data_htaccess=fread($handle_hta,filesize($htaccess));
$data_htaccess = str_replace('{uri_paging_index}', $_SESSION['uri_paging_index'], $data_htaccess);
$data_htaccess = str_replace('{uri_artikel_depan}', $_SESSION['uri_artikel_depan'], $data_htaccess);
$data_htaccess = str_replace('{uri_artikel_belakang}', $_SESSION['uri_artikel_belakang'], $data_htaccess);
$data_htaccess = str_replace('{uri_category}', $_SESSION['uri_category'], $data_htaccess);
$data_htaccess = str_replace('{uri_search}', $_SESSION['uri_search'], $data_htaccess);
$data_htaccess = str_replace('{uri_pages}', $_SESSION['uri_pages'], $data_htaccess);
$data_htaccess = str_replace('{uri_feed}', $_SESSION['uri_feed'], $data_htaccess);
$data_htaccess = str_replace('{uri_hidden}', $_SESSION['uri_hidden'], $data_htaccess);
//
$data_htaccess = str_replace('{mgb-category.php}', "$prefix-mgb-category.php", $data_htaccess);
$data_htaccess = str_replace('{mgb-pages.php}', "$prefix-mgb-pages.php", $data_htaccess);
$data_htaccess = str_replace('{mgb-rss.php}', "$prefix-mgb-rss.php", $data_htaccess);
$data_htaccess = str_replace('{mgb-search.php}', "$prefix-mgb-search.php", $data_htaccess);
$data_htaccess = str_replace('{mgb-view.php}', "$prefix-mgb-view.php", $data_htaccess);
//batas read and write
$handle_hta2=fopen("$path/.htaccess",'w');
chmod("$path/.htaccess", 0777);
fwrite($handle_hta2,$data_htaccess);
fclose($handle_hta);
fclose($handle_hta2);
}
########################################################################################################
?>