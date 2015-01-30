<?PHP
/**
 * @package Megablogging 5
 * @copyright 2012-2014 Megasoft Informer (http://megasoft-id.com) | License: http://megasoft-id.com/license
 * @since version 5
 */
class App{
	/**
	 * Load All Stylesheet
	 * @since v5
	 */
	private $email='', $name='';
	public function load_stylesheet(){
		$f_stylesheet = TEMPLATE_DIR.'/stylesheet.php';
		$file_template=fopen($f_stylesheet, 'r');
		$data_template=fread($file_template,filesize($f_stylesheet));
		$data_template_new=str_replace('{template_url}', TEMPLATE_URL, $data_template);
		$data_template_new=str_replace('{url}', APP_URL, $data_template_new);
		return "$data_template_new";
	}
	
	/**
	 * Load All Javascript
	 * @since v5
	 */
	public function load_javascript(){
		$f_stylesheet = TEMPLATE_DIR.'/javascript.php';
		$file_template=fopen($f_stylesheet, 'r');
		$data_template=fread($file_template,filesize($f_stylesheet));
		$data_template_new=str_replace('{template_url}', TEMPLATE_URL, $data_template);
		$data_template_new=str_replace('{url}', APP_URL, $data_template_new);
		return "$data_template_new";
	}
	
	/**
	 * Show HOME PAGE
	 * @since v5
	 */
	public function _home(){
		return(TEMPLATE_DIR."/index.php");		
	}
	
	/**
	 * Show Detail Article
	 * @since v5
	 */
	public function _view_article(){
		return(TEMPLATE_DIR."/view.php");		
	}
	
	/**
	 * Show Detail Page
	 * @since v5
	 */
	public function _view_page(){
		return(TEMPLATE_DIR."/pages.php");
	}
	
	/**
	 * Show Article Per Category
	 * @since v5
	 */
	public function _category(){
		return(TEMPLATE_DIR."/category.php");		
	}
	
	/**
	 * Searh Article
	 * @since v5
	 */
	public function _search(){
		return(TEMPLATE_DIR."/search.php");	
	}
	
	/**
	 * 403
	 * @since v5
	 */
	public function _403(){
		return(TEMPLATE_DIR."/403.php");	
	}
	
	/**
	 * 404
	 * @since v5
	 */
	public function _404(){
		return(TEMPLATE_DIR."/404.php");	
	}
	
	/**
	 * 405
	 * @since v5
	 */
	public function _405(){
		return(TEMPLATE_DIR."/405.php");	
	}
	
	/**
	 * 500
	 * @since v5
	 */
	public function _500(){
		return(TEMPLATE_DIR."/500.php");	
	}
	
	/**
	 * 503
	 * @since v5
	 */
	public function _503(){
		return(TEMPLATE_DIR."/503.php");	
	}
	
	
	public function replace_char($string){
		require_once(ROOT."/mgb-dir/lib/replace_character.lib.php");
		$string = replace_character($string);
		$string = str_replace(' ', '-', $string);
		$string = str_replace('  ', '-', $string);
		$string = str_replace('    ', '-', $string);
		$string = strtolower($string);
		//one more
		$string = replace_character($string);
		return $string;
	}
	
	/**
	* Dapatkan CURRENT URL
	*/
	public function strleft($s1, $s2) {
		return substr($s1, 0, strpos($s1, $s2));
	}
	public function CURRENT_URL() {
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$protocol = $this->strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
		return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 
	}
	
	/**
	* GET CONTENT OF File utf8
	* since v5
	*/
	function open_file($fn) {
		$content = file_get_contents($fn);
		return mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
	}
	
	/**
	* SAVE COTENT OF FILE utf8
	* since v5
	*/
	function save_file($filename, $content) {
		$temp = tempnam(FILE_PUT_CONTENTS_ATOMIC_TEMP, 'temp');
		if (!($f = @fopen($temp, 'wb'))) {
			$temp = FILE_PUT_CONTENTS_ATOMIC_TEMP . DIRECTORY_SEPARATOR . uniqid('temp');
			if (!($f = @fopen($temp, 'wb'))) {
				trigger_error("file_put_contents_atomic() : error writing temporary file '$temp'", E_USER_WARNING);
				return false;
			}
		}
		$content = mb_convert_encoding($content, 'UTF-8', mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
		fwrite($f, $content);
		fclose($f);
	  
		if (!@rename($temp, $filename)) {
			@unlink($filename);
			@rename($temp, $filename);
		}
	  
		@chmod($filename, FILE_PUT_CONTENTS_ATOMIC_MODE);
	  
		return true;
	  
	}
	
	//remove directory
	//since version 5
	function rrmdir($dir) {
	if (is_dir($dir)) {
		 $objects = scandir($dir);
		 foreach ($objects as $object) {
		   if ($object != "." && $object != "..") {
			 if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
		   }
		 }
		 reset($objects);
		 rmdir($dir);
		 return 1;
		}
		return 0;
	}
	
	//check template [ASLI APA KAGAK]
	//since version 5
	function check_template($folder_name){
		$template_dir = ROOT."/template";
		//cek file xmlnya
		if (file_exists($template_dir."/$folder_name.xml")){
			return true;
		}else{
			return false;
		}
	}
	
	//jumlah komen facebook (tidak support untuk localhost)
	//since version 5
	public function facebook_comments($link){
		if (substr_count($link, "localhost") != 0){
			return 0;
		}else{
			$jsonfile="https://graph.facebook.com/?id=$link";
			if (!empty($jsonfile)){
				$data = json_decode(file_get_contents($jsonfile));
				$hasil = $data->comments;
				if (empty($hasil)){
					$hasil = 0;
				}
				return $hasil;
			}else{
				return 0;
			}
		}	
	}
	
	//jumlah like facebook (tidak support untuk localhost)
	//since version 5
	public function facebook_likes($link){
		if (substr_count($link, "localhost") != 0){
			return 0;
		}else{
			$jsonfile="https://graph.facebook.com/?id=$link";
			if (!empty($jsonfile)){
				$data = json_decode(file_get_contents($jsonfile));
				$hasil = $data->shares;
				if (empty($hasil)){
					$hasil = 0;
				}
				return $hasil;
			}else{
				return 0;
			}
		}	
	}
	
	//dapatkan link full berdasarkan link id nya
	//since version 5
	public function get_link($link){
		return APP_URL."/".uri_artikel_depan."/".$link.uri_artikel_belakang;
	}
	public function get_link_cat($link){
		return APP_URL."/".uri_category."/".$link;
	}
	public function get_link_search($link){
		return APP_URL."/".uri_search."/".$link;
	}
	public function get_link_page($page){
		return APP_URL."/".uri_paging_index."/".$page;
	}
	public function get_link_pages($link){
		return APP_URL."/".uri_pages."/".$link;
	}
	
	//remote uploads
	//since version 5
	public function remote_upload($link, $destination){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec ($ch);
		curl_close ($ch);
		$file = fopen($destination, "w+");
		fputs($file, $data);
		fclose($file);
	}
}
?>