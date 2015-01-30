<?PHP
				function convertBytes( $value ) {
					if ( is_numeric( $value ) ) {
						return $value;
					} else {
						$value_length = strlen($value);
						$qty = substr( $value, 0, $value_length - 1 );
						$unit = strtolower( substr( $value, $value_length - 1 ) );
						switch ( $unit ) {
							case 'k':
								$qty *= 1024;
								break;
							case 'm':
								$qty *= 1048576;
								break;
							case 'g':
								$qty *= 1073741824;
								break;
						}
						return $qty;
					}
				}
				$maxFileSize = convertBytes(ini_get('upload_max_filesize'));
				require_once(ROOT."/mgb-dir/lib/size.lib.php");
				$a_size_max = ukuran_file($maxFileSize, true);
				?>