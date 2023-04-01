<?php
$num=2;

$counter=0;

while($counter<=15){
    $numcount=0;
    for($i=1;$i<=$num;$i++){
        if($num%$i==0){
            $numcount++;
        }
    }
    if($numcount<3){
        echo "$num ,";
        $counter++;
    }
    $num++;
}
?>
