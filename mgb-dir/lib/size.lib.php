<?PHP
function ukuran_file($ukuran, $floor=false){ #in bytes (B)
	if ($ukuran>1024 and $ukuran < 1024000){
		$ukuran=$ukuran/1024;
		$me=substr($ukuran,0,4);
		if($floor==true){$me=floor($me);}
		$hasil_ukuran="$me KB";
	}
	
	if ($ukuran>1024000 and $ukuran < 1024000000){
		$ukuran=$ukuran/1024000;
		$me=substr($ukuran,0,4);
		if($floor==true){$me=floor($me);}
		$hasil_ukuran="$me MB";
	}
	if ($ukuran>1024000000){
		$ukuran=$ukuran/1024000000;
		$me=substr($ukuran,0,4);
		if($floor==true){$me=floor($me);}
		$hasil_ukuran="$me GB";
	}
return $hasil_ukuran;
}
#echo "<br>".ukuran_file("10591232") #in bytes;
?>