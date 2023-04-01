<?php
class Person{
    public $name;
    public $address;
    public function __construct($name){
        $this->name=$name;
    }
    public function __clone(){

    }
}
$obj1= new Person("I am in");
echo $obj1->name;
$obj2= clone $obj1;
echo $obj2->name;

?>