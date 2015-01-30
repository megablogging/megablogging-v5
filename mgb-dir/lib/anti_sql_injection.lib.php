<?PHP
#Copyright © 2013 Megasoft Informer, Dewa , Megablogging Version 6
#Create By 			: Dewa
#Date Create		: 21 Juni 2013
#fuction			: For Anti Sql Injection String Type
#school				: SMKN 1 BANGKINANG
#
function anti_sql_injection($string) {
$string = str_replace("'", " ", $string);
$string = str_replace('"', ' ', $string);
$string = str_replace('=', ' ', $string);
$string = str_replace('}', ' ', $string);
$string = str_replace('{', ' ', $string);
$string = str_replace('[', ' ', $string);
$string = str_replace(']', ' ', $string);
$string = str_replace('?', ' ', $string);
$string = str_replace('!', ' ', $string);
$string = str_replace('$', ' ', $string);
$string = str_replace('#', ' ', $string);
$string = str_replace('%', ' ', $string);
$string = str_replace('*', ' ', $string);
$string = str_replace(')', ' ', $string);
$string = str_replace('(', ' ', $string);
$string = str_replace('~', ' ', $string);
$string = str_replace('-', ' ', $string);
$string = str_replace('+', ' ', $string);
$string = str_replace('|', ' ', $string);
$string = str_replace('>', ' ', $string);
$string = str_replace('<', ' ', $string);
$string = str_replace('^', ' ', $string);
$string = stripslashes($string);
$string = strip_tags($string);
$string = mysql_real_escape_string($string);
return $string;
}
?>