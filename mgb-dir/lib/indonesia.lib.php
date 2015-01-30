<?php
function rupiah($angka){
	$rupiah="";
	$rp=strlen($angka);
	while ($rp>3)
	{
		$rupiah = ".". substr($angka,-3). $rupiah;
		$s=strlen($angka) - 3;
		$angka=substr($angka,0,$s);
		$rp=strlen($angka);
	}
	$rupiah = $angka . $rupiah . ",-";
	return $rupiah;
}

function tanggalIndonesia($data){
	$tahunSelesai = substr($data,0,4);
	$bulanSelesai = substr($data,5,2);
	$tanggalSelesai = substr($data,8,2);
	$dataIndonesia = $tanggalSelesai . "/" . $bulanSelesai . "/" . $tahunSelesai;
	return $dataIndonesia;
}


function tanggalIndonesiaString($data){
	$tahunSelesai = substr($data,0,4);
	$bulanSelesai = substr($data,5,2);
	$tanggalSelesai = substr($data,8,2);
	if($bulanSelesai==1){
		$nama_bulan = "Januari";
	}elseif($bulanSelesai==2){
		$nama_bulan = "Februari";
	}elseif($bulanSelesai==3){
		$nama_bulan = "Maret";
	}elseif($bulanSelesai==4){
		$nama_bulan = "April";
	}elseif($bulanSelesai==5){
		$nama_bulan = "Mei";
	}elseif($bulanSelesai==6){
		$nama_bulan = "Juni";
	}elseif($bulanSelesai==7){
		$nama_bulan = "Juli";
	}elseif($bulanSelesai==8){
		$nama_bulan = "Agustus";
	}elseif($bulanSelesai==9){
		$nama_bulan = "September";
	}elseif($bulanSelesai==10){
		$nama_bulan = "Oktober";
	}elseif($bulanSelesai==11){
		$nama_bulan = "November";
	}elseif($bulanSelesai==12){
		$nama_bulan = "Desember";
	}
	
	
	
	$dataIndonesia = $tanggalSelesai . " " . $nama_bulan . " " . $tahunSelesai;
	return $dataIndonesia;
}



function autoInc($field, $tabel){

$query = "select max($field) from $tabel";
$execQuery = mysql_query($query);
$hasil = mysql_fetch_row($execQuery);
$nomor = $hasil[0];
return $nomor;
}

function cekAda($field, $tabel){

$query = "select max($field) from $tabel";
$execQuery = mysql_query($query);
$hasil = mysql_fetch_row($execQuery);
$nomor = $hasil[0];
return $nomor;
}


function bulanIndonesia($bulan){

	if($bulan==1) $bulanId = 'Januari';
	elseif ($bulan==2)  $bulanId = 'Februari';
	elseif ($bulan==3)  $bulanId = 'Maret';
	elseif ($bulan==4)  $bulanId = 'April';
	elseif($bulan==5)  $bulanId = 'Mei';
	elseif ($bulan==6)  $bulanId = 'Juni';
	elseif ($bulan==7)  $bulanId = 'Juli';
	elseif ($bulan==8)  $bulanId = 'Agustus';
	elseif ($bulan==9)  $bulanId = 'September';
	elseif ($bulan==10)  $bulanId = 'Oktober';
	elseif ($bulan==11)  $bulanId = 'November';
	elseif ($bulan==12)  $bulanId = 'Desember';

	return $bulanId;

}
?>