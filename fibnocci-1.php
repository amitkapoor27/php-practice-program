<?php
$n1=0;
$n2=1;
$num=0;
echo $n1.",".$n2.",";
while($num<10){
    $n3=$n1+$n2;
    echo $n3.",";
    $n1=$n2;
    $n2=$n3;
    $num++;
} 
?>