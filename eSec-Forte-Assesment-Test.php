<?php
/************* Solution 1 ***************** */
  function camelCase($string, $delimiter) {
    $strArr=explode($delimiter,$string);
    $arr=array();
    foreach ($strArr as $k=>  $v) {
      $arr[] =($k==0)?$v:ucwords($v);
    }
    return implode($arr);
  }
  echo "Answer of question-1 : \n";
  echo camelCase("this-is-a-string","-");
  echo "\n";
/************* Solution 2 ***************** */

  function parsethsstmt($string){
    $stLen=strlen($string);
    $arr=array();
    $counter=0;
    for($i=0;$i<$stLen;$i++){
      switch ($string[$i]) {
        case 'p':
          $counter++;
          break;
        case 'm':
          $counter--;
          break;
        case 's':
          $counter*=$counter;
          break;
        case 'o':
          $arr[]=$counter;
          break;
        default:
          # code...
          break;
      }
    }
    return $arr;

  }
  echo "Answer of question- 2 : \n";
  print_r(parsethsstmt("ppppsmoso"));
  echo "\n";
/************* Solution 3 ***************** */
  
  function getExtraCount($string){
    $stl=strlen($string);
    $counter=0;
    for($i=0;$i<$stl;$i++){
      if(ord($string[$i])>ord("n")){
        $counter++;
      }
    }
      return $counter;
  }
  
  echo "Answer of question -3 : \n";
  echo getExtraCount("abaxbdbbyyhwawiwjjjwem ");
?>