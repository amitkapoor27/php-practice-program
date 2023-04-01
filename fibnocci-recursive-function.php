<?php
function fibnocci($num){
    if($num==0){
        return 0;
    }
    elseif($num==1){
        return 1;
    }
    else{
        return (fibnocci($num-1)+fibnocci($num-2));
    }
}
$num=12;
for($i=0;$i<$num;$i++){
   echo fibnocci($i);
   echo ",";
}
?>