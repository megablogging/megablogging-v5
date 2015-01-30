<?PHP
function remove($item) 
	{
		$item = realpath($item);
		$ok = true;
		if(is_link($item) ||  is_file($item))
	  		$ok =  @unlink($item);
				elseif( is_dir($item)) {
					if(($handle= opendir($item))===false)
		  				show_error(basename($item).": ".$GLOBALS["error_msg"]["opendir"]);

			while(($file=readdir($handle))!==false) {
				if(($file==".." || $file==".")) continue;

				$new_item = $item."/".$file;
				if(!file_exists($new_item))
			  	show_error(basename($item).": ".$GLOBALS["error_msg"]["readdir"]);
			
				if(is_dir($new_item)) {
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
	?>