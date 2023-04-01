<?php
$num=145978;
$sum=0;
$rem=0;
for($i=0;$i<=strlen($num);$i++){
    $rem =$num%10;
    $sum=$sum+$rem;
    $num=$num/10;
}
echo $sum;
?>