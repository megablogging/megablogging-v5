<?php
/*
Untuk masa depan pengembangan PHP, mulai hari ini gunakan open dan close tag: <?php ?>
For future if PHP Development, use <?php ?> as open and close tag

@author: hairul azami a.k.a dr.emi
@contact: webmaster@dremi.info
@website: www.dremi.info
*/

class mydb
{
	//connect to database
	function connect($host, $user, $pass, $db)
	{
		$con = mysql_connect($host, $user, $pass);
		if($con)
		{
			mysql_select_db($db) or die("could'nt select database");
		}
		else
		{
			die("couldn't connect to host. ".mysql_error()."");
		}
	}
	
	//query
	function query($sql)
	{
		$qry = mysql_query($sql);
		return $qry;
	}
	
	//counter rows
	function numrows($qry)
	{
		$num = mysql_num_rows($qry);
		return $num;
	}
	
	//counter fields
	function numfield($qry)
	{
		$field = mysql_num_fields($qry);
		return $field;
	}
	
	//fetch rows data
	function fetchrow($qry)
	{
		if($row = mysql_fetch_row($qry))
		{
			return $row;
		}
		else 
		{
			echo mysql_error();
		}
	}
	
	//fetch array data
	function fetcharray($qry)
	{
		if($row = mysql_fetch_array($qry))
		{
			return $row;
		}
		else 
		{
			echo mysql_error();
		}
	}
	
	//valid path handler
	function validPath($string) //don't use for URL type
	{
		$strToFilter = strip_tags(trim($string));
		$strToFilter = str_replace("//", "/", $strToFilter);
		$strToFilter = str_replace("\\", "/", $strToFilter);
	
		return $strToFilter;
	}
	
	//get ekstensi file
	function getlast($toget)
    {
	    $pos	 = strrpos($toget,".");
	    $lastext = strtolower(substr($toget,$pos+1));
		return $lastext;
    }
    
	//path file name handler
	function getRealFileName($strFile) //full file path
	{
		$validStrPath   =  $this->validPath($strFile);
		$validStrPath  	=  str_replace(dirname($validStrPath).'/', '', $validStrPath);
		$validStrPath	=  str_replace('.'.$this->getlast($validStrPath), '', $validStrPath);

		return $validStrPath;
	}
	
	//clear string
	function clearString($value)
	{
		if(get_magic_quotes_gpc())
		{
        	$value = stripslashes($value);
    	}
    	if(!is_numeric($value))
    	{
        	$value = mysql_real_escape_string($value);
    	}
    	return $value;
	}

	//remove direktori / file
	function remove($item) 
	{
		$item = realpath($item);
		$ok = true;
		if( is_link($item) ||  is_file($item))
	  		$ok =  @unlink($item);
				elseif( is_dir($item)) {
					if(($handle= opendir($item))===false)
		  				show_error(basename($item).": ".$GLOBALS["error_msg"]["opendir"]);

			while(($file=readdir($handle))!==false) {
				if(($file==".." || $file==".")) continue;

				$new_item = $item."/".$file;
				if(!file_exists($new_item))
			  	show_error(basename($item).": ".$GLOBALS["error_msg"]["readdir"]);
			
				if( is_dir($new_item)) {
					$ok=$this->remove($new_item);
				} else {
				$ok= @unlink($new_item);
				}
			}

			closedir($handle);
			$ok=@rmdir($item);
		}
		return $ok;
	}
	
	//backup database
	function backupDatabase($name,$tables = '*')
	{
		$this->connect(_DB_HOST, _DB_USER, _DB_PASS, $name);
		
		if($tables == '*')
		{
			$tables = array();
			$result = $this->query('SHOW TABLES');
			while($row = $this->fetchrow($result))
			{
				$tables[] = $row[0];
			}
		}
		else
		{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
	
		foreach($tables as $table)
		{
			$result = $this->query('SELECT * FROM '.$table);
			$num_fields = $this->numfield($result);
			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			$row2 = $this->fetchrow($this->query('SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			for ($i = 0; $i < $num_fields; $i++) 
			{
				while($row = $this->fetchrow($result))
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = str_replace("'", '', $row[$j]);
						$row[$j] = str_replace("\n", '', $row[$j]);
						$row[$j] = str_replace("\r", '', $row[$j]);
						$row[$j] = str_replace('\"', '"', $row[$j]);
						$row[$j] = str_replace("’", "\'", $row[$j]);
						$row[$j] = str_replace("`", "\'", $row[$j]);
						$row[$j] = str_replace('“', '"', $row[$j]);
						$row[$j] = str_replace('”', '"', $row[$j]);
						if (isset($row[$j])) { $return.= "'".$row[$j]."'"; } else { $return.= "''"; }
						if ($j<($num_fields-1)) { $return.= ', '; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}
	
		$fileName = "[db-backup]-"._DB_NAME.'-'.date("d-M-Y").'.sql'; 
	
		$handle = fopen($fileName,'w+');
		fwrite($handle,$return);
		fclose($handle);
	
		if (file_exists($fileName))
		{
			include "pclzip.lib.php";
			@set_time_limit(0);
			$zipName = $this->getRealFileName(str_replace('.sql', '', $fileName));
		
			$outputArchive = '../component/temp/'.$zipName.'.zip'; 
			$archive       = new PclZip($outputArchive); //nama target zip
		
			if($archive->create($fileName) == 0) //source sql
			{
   				echo ("Error : ".$archive->errorInfo(true));
			}
			$this->remove($fileName);
			$resultLink = "<a href='$outputArchive' target='_blank'></a> or <a href='".$_SERVER['PHP_SELF']."?cTask=backUpDB&cTask2=removeBckDB&file=$outputArchive'>remove backup database</a>.";
    	}
		return $outputArchive;
	}
	
	//cek baris komentar
	function isComment($text)
	{
		if ($text != "")
		{
			$fL = $text[0];
			$sL = $text[1];
			switch($fL)
			{
				case "#":
					$text = "";
					break;
				case "/":
					if ($sL == "*")
						$text = "";
					break;
				case "-":
					if ($sL == "-")
						$text = "";
					break;
			}
		}
		return $text;
	}
	
	//restore db dalam zip
	function restoreDatabaseZip($sourceDB)
	{
		if(file_exists($sourceDB))
		{
			include "pclzip.lib.php";
			@set_time_limit(0);
			$archive = new PclZip($sourceDB);
			if ($archive->extract(PCLZIP_OPT_PATH, '../component/temp/') == 0)
			{
				die("Error : ".$archive->errorInfo(true));
			}
			$f = fopen('../component/temp/'.$this->getRealFileName($sourceDB).'.sql',"r+");
			$sqlFile = fread($f, filesize('../component/temp/'.$this->getRealFileName($sourceDB).'.sql'));
			$sqlFile = str_replace("\r","%BR%",$sqlFile);
			$sqlFile = str_replace("\n","%BR%",$sqlFile);
			$sqlFile = str_replace("%BR%%BR%","%BR%",$sqlFile);
			$sqlArray = explode('%BR%', $sqlFile);
			$sqlArrayToExecute;
			foreach ($sqlArray as $stmt) 
			{
				$stmt = $this->isComment($stmt);
				if ($stmt != '')
					$sqlArrayToExecute[] = $stmt;
			}
			$sqlFile = implode("%BR%",$sqlArrayToExecute);
			unset($sqlArrayToExecute);
			$sqlArray = explode(';%BR%', $sqlFile);
			unset($sqlFile);
			foreach ($sqlArray as $stmt)
			{
				$stmt = str_replace("%BR%"," ",$stmt);
				$stmt = str_replace("&nbsp;&nbsp;", "&nbsp;", $stmt);
				$stmt = str_replace("’", "\'", $stmt);
				$stmt = str_replace("</p><p>", "</p> <p>", $stmt);
				$stmt = str_replace("<p><br />", "<p>", $stmt);
				$stmt = trim($stmt);
				$result = $this->query($stmt);
				$_SESSION['ttlQuery']  = count($sqlArray);
				$_SESSION['timeQuery'] = time();
				if (!$result)
				{
					return false;
				}
			}
			echo 'Import has been successfully finished, '.$_SESSION['ttlQuery'].' queries executed on '.date('Y-m-d H:i:s', $_SESSION['timeQuery']);
			//not work till restore completed
			//$this->remove('temp/'.$this->getRealFileName($sourceDB).'.sql');
			$this->remove($sourceDB);
		}
		else
		{
			echo 'ZIP File not found';
		}
	}

	//restore db dalam sql
	function restoreDatabaseSql($sourceDB)
	{
		if(file_exists($sourceDB))
		{
			@set_time_limit(0);
			$f = fopen($sourceDB,"r+");
			$sqlFile = fread($f, filesize($sourceDB));
			$sqlFile = str_replace("\r","%BR%",$sqlFile);
			$sqlFile = str_replace("\n","%BR%",$sqlFile);
			$sqlFile = str_replace("%BR%%BR%","%BR%",$sqlFile);
			$sqlArray = explode('%BR%', $sqlFile);
			$sqlArrayToExecute;
			foreach ($sqlArray as $stmt) 
			{
				$stmt = $this->isComment($stmt);
				if ($stmt != '')
					$sqlArrayToExecute[] = $stmt;
			}
			$sqlFile = implode("%BR%",$sqlArrayToExecute);
			unset($sqlArrayToExecute);
			$sqlArray = explode(';%BR%', $sqlFile);
			unset($sqlFile);
			foreach ($sqlArray as $stmt)
			{
				$stmt = str_replace("%BR%"," ",$stmt);
				$stmt = str_replace("&nbsp;&nbsp;", "&nbsp;", $stmt);
				$stmt = str_replace("’", "\'", $stmt);
				$stmt = str_replace("</p><p>", "</p> <p>", $stmt);
				$stmt = str_replace("<p><br />", "<p>", $stmt);
				$stmt = trim($stmt);
				$result = $this->query($stmt);
				$_SESSION['ttlQuery'] = count($sqlArray);
				$_SESSION['timeQuery']     = time();
				if (!$result)
				{
					return false;
				}
			}
			echo 'Import has been successfully finished, '.$_SESSION['ttlQuery'].' queries executed on '.date('Y-m-d H:i:s', $_SESSION['timeQuery']);
			$this->remove($sourceDB);
		}
		else
		{
			echo 'SQL File not found';
		}
	}
}
?>