<?php
include(dirname(dirname(dirname(__FILE__)))."/config.php");
include(dirname(dirname(__FILE__))."/_session.php");
include(dirname(dirname(__FILE__))."/_session_lv.php");
include(dirname(dirname(__FILE__))."/anti_xss.php");
print_r($_POST['item']);
if($_POST['item'])
{
foreach($_POST['item'] as $grid_order=>$grid_id) 
{
$grid_order++;
$db->query("UPDATE menu SET number='$grid_order' WHERE id='$grid_id'");
}
}
//<!--
//Copyright 2012 - 2014 Megasoft Informer
//Create by 					: Dewa -> http://about.megasoft-id.com/Dewa
//Link to  download				: http://mgst.co/mgb
//-->
?>