<?php
class father{
    public function __construct(){
        echo "I am parent\n";
    }
}
class child extends father{
    public function __construct(){
        parent::__construct();
        echo "I am child";
    }
}
$obj= new child();
?>