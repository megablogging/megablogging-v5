<?PHP
function int_in_us($angka){
	$hasil="";
	$rp=strlen($angka);
	while ($rp>3)
	{
		$hasil = ",". substr($angka,-3). $hasil;
		$s=strlen($angka) - 3;
		$angka=substr($angka,0,$s);
		$rp=strlen($angka);
	}
	$hasil = $angka . $hasil;
	return $hasil;
}
?>