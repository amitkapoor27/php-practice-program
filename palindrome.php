<?php
function palindrome($num){
    $temp=$num;
    $new=0;
    while(floor($temp)){
        $rem = $temp%10;
        $new = $new*10+$rem;
        $temp=$temp/10;
    }
    return $new;
}
$input = "eye";  
$num = palindrome($input);  
if($input==$num){  
echo "$input is a Palindrome number";  
} else {  
echo "$input is not a Palindrome";  
}  
?>