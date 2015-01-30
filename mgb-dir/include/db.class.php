<?PHP
/**
 * @package Megablogging 5
 * @copyright 2012-2014 Megasoft Informer (http://megasoft-id.com) | License: http://megasoft-id.com/license
 * @since version 5
 */
class Database{
	private $mysqli;
	public function __construct($host, $user, $pass, $db){
		$this->mysqli =  new mysqli($host, $user, $pass, $db);
		if(mysqli_connect_errno()) {
			echo "Error: Could not connect to database. ";
			exit;
		}
	}
	
	/**
	 * Dapatkan Kategori untuk artikel ini
	 * @since v5
	 */
	public function _get_category($cat){
		$jumlah_category = substr_count($cat,",");
		$cat_a = explode(',',$cat);
		$j_cat = 0;
		$cat_result = "";
		while ($j_cat <= $jumlah_category){
		$cat_me = $cat_a["$j_cat"];
		$cat_link2 = strtolower($cat_me);
		$cat_link2 = str_replace(" ", "-", $cat_link2);
		$cat_result .= "<a href='".APP_URL."/".uri_category."/$cat_link2'> $cat_me</a> , ";
		$j_cat++;
		}
		return $cat_result;
	}
	
	
	/**
	 * Dapatkan author postingan ini
	 * @since v5
	 */
	public function _author_this_post($article_id){
		$sql = "select user from article where id='$article_id'";
		$data = $this->fetch($sql);
		$user_id = $data['user'];
		$sql2 = "select name, link from admin where id='$user_id'";
		$data2 = $this->fetch($sql2);
		return "<a target='_blank' href='$data2[link]'>$data2[name]</a>";
	}
	
	/**
	 * mendapatkan data article berdasarkan link article
	 * @since v5
	 */
	public function get_article_by_link($link_article=''){
		$link_article = mysqli_real_escape_string($this->mysqli,$link_article);
		$query = "SELECT * FROM article where link='$link_article'";
        $row = $this->fetch($query);
		if (empty($row)){header("location:".APP_URL."/error.php?error=404");exit();}
        return $row;
	}
	//alias version for => get_article_by_link to -> detail_artikel ====> untuk indonesia tercinta :D
	public function detail_artikel($link_article){
		return $this->get_article_by_link($link_article);
	}
	
	/**
	 * mendapatkan data pages (laman) berdasarkan link pages (lamannya)
	 * @since v5
	 */
	public function get_pages_by_link($link_pages=''){
		$link_pages = mysqli_real_escape_string($this->mysqli,$link_pages);
		$query = "SELECT * FROM pages where link='$link_pages'";
        $row = $this->fetch($query);
		if (empty($row)){header("location:".APP_URL."/error.php?error=404");exit();}
        return $row;
	}
	//alias version for => get_pages_by_link to -> detail_pages ====> untuk indonesia tercinta :D
	public function detail_pages($link_pages){
		return $this->get_pages_by_link($link_pages);
	}
	
	/**
	 * mendapatkan data user berdasarkan id dan data apa yang ingin di tampilkan
	 * @since v5
	 */
	public function get_detail_user($id, $what='*'){
		$row = $this->fetch("select $what from admin where id='$id'");
		if (empty($row)){header("location:".APP_URL."/error.php?error=404");exit();}
        return $row;
	}
	//alias version for => get_detail_user to -> user_detail ====> untuk indonesia tercinta :D
	public function user_detail($id, $what='*'){
		return $this->get_detail_user($id, $what);
	}
	
	/**
	 * mendapatkan semua data article terbaru berdasarkan page dan limit yang di minta
	 * @since v5
	 */
	public function get_newtest_article($page=1, $limit=10){
		$calc = $limit * $page;
		$start = $calc - $limit;
		$query = "select * from article order by article.date DESC, article.time DESC Limit $start, $limit";
		$rows = $this->fetch_multiple($query);
		foreach ($rows as $row){$data[]=$row;}
		if (empty($data)){header("location:".APP_URL."/error.php?error=404");exit();}
		return $data;
	}
	//alias version for => get_newtest_article to -> artikel_terbaru ====> untuk indonesia tercinta :D
	public function artikel_terbaru($page=1, $limit=10){
		return $this->get_newtest_article($page, $limit);
	}
	
	/**
	 * mendapatkan semua article berdasarkan category nya -> di butuhkan submit data page dan limit
	 * @since v5
	 */
	public function get_article_by_category($category='', $page=1, $limit=10){
		$category=mysqli_real_escape_string($this->mysqli,$category);
		$calc = $limit * $page;
		$start = $calc - $limit;
		$query = "select * from article where category like '%$category%' order by article.date DESC, article.time DESC limit $start, $limit";
		$rows = $this->fetch_multiple($query);
		foreach ($rows as $row){$data[]=$row;}
		if (empty($data)){header("location:".APP_URL."/error.php?error=404");exit();}
		return $data;
	}
	//alias version for => get_article_by_category to -> artikel_per_category ====> untuk indonesia tercinta :D
	public function artikel_per_kategori($category='', $page=1, $limit=10){
		return $this->get_article_by_category($category, $page, $limit);
	}
	
	/**
	 * engine search article : mendapatkan semua article berdasarkan keyword nya -> di butuhkan submit data page dan limit
	 * @since v5
	 */
	public function get_article_by_keyword($keyword='', $page=1, $limit=10){
		$keyword=mysqli_real_escape_string($this->mysqli,$keyword);
		$calc = $limit * $page;
		$start = $calc - $limit;
		$q = $keyword;
		$query = "select * from article where title like '%$q%' or content like '%$q%' or category like '%$q%' order by article.date DESC, article.time DESC Limit $start, $limit";
		$rows = $this->fetch_multiple($query);
		foreach ($rows as $row){$data[]=$row;}
		if (empty($data)){header("location:".APP_URL."/error.php?error=404");exit();}
		return $data;
	}
	//alias version for => get_article_by_keyword to -> cari_artikel ====> untuk indonesia tercinta :D
	public function cari_artikel($keyword='', $page=1, $limit=10){
		return $this->get_article_by_keyword($keyword, $page, $limit);
	}
	
	
	/**
	 * untuk menghitung hasil jumlah article berdasarkan query where yang di jalankan
	 * @since v5
	 */
	public function count_article($where=''){
		$where=str_replace('where','',$where);
		if (empty($where)){
			$query="select id from article";
		}else{
			$query="select id from article where $where";
		}
		$total = $this->num_rows($query);
		return $total;
	}
	//alias version for => count_article to -> hitung_artikel ====> untuk indonesia tercinta :D
	public function hitung_artikel($where=''){
		return $this->count_article($where);
	}
	
	/**
	 * random article : mendapatkan semua article secara random -> di butuhkan submit data start dan limit
	 * @since v5
	 */
	public function random_article($start=1, $limit=10){
		$query = "select * from article order by rand() limit $start, $limit";
		$rows = $this->fetch_multiple($query);
		foreach ($rows as $row){$data[]=$row;}
		if (empty($data)){header("location:".APP_URL."/error.php?error=404");exit();}
		return $data;
	}
	//alias version for => random_article to -> artikel_acak ====> untuk indonesia tercinta :D
	public function artikel_acak($start=1, $limit=10){
		return $this->random_article($start, $limit);
	}
	
	/**
	 * popular article : mendapatkan semua article secara berdasarkan yang terpopuler -> di butuhkan submit data start dan limit
	 * @since v5
	 */
	public function popular_article($start=1, $limit=10){
		$query = "select * from article order by article.hits DESC limit $start, $limit";
		$rows = $this->fetch_multiple($query);
		foreach ($rows as $row){$data[]=$row;}
		if (empty($data)){header("location:".APP_URL."/error.php?error=404");exit();}
		return $data;
	}
	//alias version for => popular_article to -> artikel_terpopuler ====> untuk indonesia tercinta :D
	public function artikel_terpopuler($start=1, $limit=10){
		return $this->popular_article($start, $limit);
	}
	
	/**
	 * run select : run query select
	 * @since v5
	 */
	public function select($table, $rows = "*", $where = null, $order = null, $limit = null){
		$q = 'SELECT '.$rows.' FROM '.$table;
		if($where != null){
			$q .= ' WHERE '.$where;
		}
		if($order != null){
			$q .= ' ORDER BY '.$order;
		}
		if ($limit != null){
			$q .= ' LIMIT '.$limit;
		}
		$result = mysqli_query($this->mysqli,$q);
		while ($row = mysqli_fetch_assoc($result)){
			$data[] = $row;
		}
		return $data;
	}
	
	/**
	 * run insert : run query insert
	 * @since v5
	 */
	private function quote($string,$param=''){
		if(empty($param)){
			return "'$string'";
		}
		return $string;
	}
	public function insert($table,$insert,$parameters=array()){
		$param="";
		$val="";
		//Build Query
		$query="INSERT INTO $table";
		if(is_array($insert)){
			$count=count($insert);
			$i=0;			
			foreach ($insert as $key => $value) {
				$param.="`$key`";
				$val.=$this->quote($value,$parameters);
				if(++$i != $count) {
				    $param.=",";
				    $val.=",";
				}				
			}
			$query.=" ($param) VALUES ($val)";
		}
		$sql = $this->query($query);
		if ($sql){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * run select : cek artikel 
	 * @since v5
	 */
	public function check_article($id){
		if (logged != 0){ //jika dia udah login maka lanjutkan aja
			// check siapa user pembuat artikel ini
			$data_cek = $this->fetch("select user from article where id='$id'");
			$uid_this_article = $data_cek['user'];
			//selesai bro cek siapa usernya dengan variable uid_this_article
			#lanjut ke tahap ke dua pengecekan apakah user yang ngerequest itu pas ama hasil uid_this_article nya
			if ($uid_this_article == logged){
				return true;
			}else{
				return false;
			}
		}
	}
	
	/**
	 * mysqli shortcut
	 * @since v5
	 */
	public function query($sql){
		$result = mysqli_query($this->mysqli,$sql);
		return $result;
	}
	public function fetch($sql){
		$result = mysqli_query($this->mysqli,$sql);
		$data = mysqli_fetch_array($result);
		return $data;
	}
	public function fetch_multiple($sql){
		$result = mysqli_query($this->mysqli,$sql);
		while($row = mysqli_fetch_array($result)){
			$data[] = $row;
		}
		return $data;
	}
	public function num_rows($sql){
		$result = mysqli_query($this->mysqli,$sql);
		$data = mysqli_num_rows($result);
		return $data;
	}
	public function escape_string($string){
		return mysqli_real_escape_string($this->mysqli,$string);
	}
	
	/**
	 * activation for reset password admin
	 * @since v5
	 */
	public function get_activation_key($email_or_username){
		$sql = "select * from admin where email='$email_or_username' or username='$email_or_username'";
		if ($this->num_rows($sql) == 0){
			echo "Username atau email yang anda masukan tidak terdaftar sebagai member di situs ini!.";
			exit();
		}
		$data = $this->fetch($sql);
		$id = $data['id'];
		$name = $data['name'];
		$email = $data['email'];
		$pswd = $data['pswd'];
		$image = $data['image'];
		$bio = $data['bio'];
		$link = $data['link'];
		$level = $data['level'];
		$today = date("Y-m-d");
		$time = date("H:i:s");
		$total_art = $this->num_rows("select id from article where user='$id'");
		$total_page = $this->num_rows("select id from pages where user='$id'");
		$total_files = $this->num_rows("select id from files where user='$id'");
		$activation_key = md5($id.$name.$email.$pswd.$email.$image.$bio.$link.$level.$today.$total_art.$total_page.$total_files);
		$this->email=$email;
		$this->name=$name;
		return $activation_key;
	}
	
	//mengirim kode dan link aktivasi , untuk program forget password
	//since version 5
	public function send_activation($email_or_username){
		$activation_key = $this->get_activation_key($email_or_username);
		$sql = "select * from admin where email='$email_or_username' or username='$email_or_username'";
		if ($this->num_rows($sql) == 0){
			echo "Username atau email yang anda masukan tidak terdaftar sebagai member di situs ini!.";
			exit();
		}
		$data = $this->fetch($sql);
		$id = $data['id'];
		$name = $data['name'];
		$email = $data['email'];
		$today = date("Y-m-d");
		$time = date("H:i:s");
		$activation_link = APP_URL."/hidden/forgot.php?act=recover&email=$email&activation=$activation_key";
		$c_url = APP_URL;
		$c_admin_url = "$c_url/hidden";
		$messages = "
		you has send a request for reset your password at <a target='_blank' href='$c_url'>$c_url</a> with detail<br>
		Email : $email<br>
		Username : $name<br>
		Date : $today - $time<br>
		<p>
		and if you really has send a request for reset your password at $c_url, so you can use this activation code for reset your password :
		<br>
		<b>Activation Code</b> : <i>$activation_key</i>
		</p>
		if you didn't request this action, so ignore this message or delete this message.
		";
		$send = $this->send_email($email, "Activation Link For Reset Your Password at $c_url", $messages);
		if ($send == true){
			return "$email";
			exit();
		}else{
			echo "Failed! can't send email to $email";
		}
	}
	
	//send mail
	public function send_email($email, $subject, $messages){
		$email_from = "cs@megablogging.org";
		$headers = "From: Tim Megablogging <$email_from>" . PHP_EOL;
		$headers .= "Reply-To: $email_from" . PHP_EOL;
		$headers .= "MIME-Version: 1.0" . PHP_EOL;
		$headers .= "Content-type: text/html; charset=utf-8" . PHP_EOL;
		$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;
		if (mail($email, $subject, $messages, $headers)){
		return true;
		}else{
			return false;
		}
	}
}