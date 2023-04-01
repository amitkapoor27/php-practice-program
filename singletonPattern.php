<?php
class myClass{
    private static $instance;
    private function __construct(){

    }
    public static function get_instance(){
        if(!self::$instance)
        self::$instance=new myClass();
        return self::$instance; 
    }
}
?>