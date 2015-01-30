<?PHP
$slash = addslashes("'");
$slash = str_replace("'", "", $slash);
function replace_character($string, $dot=true){
	$string = str_replace('(', '', $string);
	$string = str_replace(')', '', $string);
	$string = str_replace('[', '', $string);
	$string = str_replace(']', '', $string);
	$string = str_replace('{', '', $string);
	$string = str_replace('}', '', $string);
	$string = str_replace('/', '', $string);
	$string = str_replace('*', '', $string);
	$string = str_replace('&', '', $string);
	$string = str_replace('^', '', $string);
	$string = str_replace('@', '', $string);
	$string = str_replace('#', '', $string);
	$string = str_replace('$', '', $string);
	$string = str_replace('!', '', $string);
	$string = str_replace(':', '', $string);
	$string = str_replace(';', '', $string);
	$string = str_replace('?', '', $string);
	$string = str_replace('+', '', $string);
	$string = str_replace('=', '', $string);
	$string = str_replace('|', '', $string);
	$string = str_replace('`', '', $string);
	$string = str_replace('~', '', $string);
	$string = str_replace('"', '', $string);
	$string = str_replace("'", '', $string);
	$string = str_replace("%", '', $string);
	$string = str_replace("_", '', $string);
	$string = str_replace(",", '', $string);
	$string = str_replace("“", '', $string);
	$string = str_replace("″", '', $string);
	$string = str_replace("---", '-', $string);
	$string = str_replace("--", '-', $string);
	if ($dot == true){
	$string = str_replace(".", '', $string);
	}
	return $string;
}
#echo replace_character("%$&*!$@##()(&@dewa;:'"); #output only dewa
?>