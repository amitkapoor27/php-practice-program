<?php
class countClassObjects{
    public static $count = 0;
    public function __construct(){
        self::$count++;
    }
    
}
$obj1 = new countClassObjects();
$obj2 = new countClassObjects();
$obj3 = new countClassObjects();
$obj4 = new countClassObjects();
$obj5 = new countClassObjects();

echo "The number of objects in the countClassObjects class is " . countClassObjects::$count;
?>