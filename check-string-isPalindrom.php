<?php
  
  function checkPalindrom($string)
  {
    $isPalindrom=true;
    $st=strlen($string);
    for($i=0;$i<$st/2;$i++){
      if($string[$i]!==$string[$st-$i-1]){
        $isPalindrom=false;
        break;
      }
    }
    return ($isPalindrom)?"$string is palindrom":"$string is not palindrom";
  }
  $str="event";
  echo checkPalindrom($str);
?>