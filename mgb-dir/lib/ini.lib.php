<?PHP
function get_parse_ini($file)
{

    // if cannot open file, return false
    if (!is_file($file))
        return false;

    $ini = file($file);

    // to hold the categories, and within them the entries
    $cats = array();

    foreach ($ini as $i) {
        if (@preg_match('/\[(.+)\]/', $i, $matches)) {
            $last = $matches[1];
        } elseif (@preg_match('/(.+)=(.+)/', $i, $matches)) {
            $cats[$last][trim($matches[1])] = trim($matches[2]);
        }
    }

    return $cats;

}

function put_ini_file($file, $array, $i = 0){
  $str="";
  foreach ($array as $k => $v){
    if (is_array($v)){
      $str.=str_repeat(" ",$i*2)."[$k]\r\n";
      $str.=put_ini_file("",$v, $i+1);
    }else
      $str.=str_repeat(" ",$i*2)."$k = $v\r\n";
  }
 
  $phpstr = "<?PHP\r\n/*\r\n".$str."*/\r\n?>";
 
 if($file)
    return file_put_contents($file,$phpstr);
  else
    return $str;
}
?>