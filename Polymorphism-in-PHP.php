<?php
/*
    One of the most significant features of OOPs is polymorphism. In general terms, polymorphism is derived from Greek words poly meaning many and morphism meaning forms. Polymorphism in OOPs is a concept that allows you to create classes with different functionalities in a single interface.

    Generally, it is of two types: compile-time (overloading) and run time (overriding)
    But polymorphism in PHP does not support overloading, or in other words, compile-time polymorphism.

    
    Lets understand the polymorphism in php with the example.
    There are many shapes with different lengths, widths, radius, and other parameters, but all the figures will have an area. 
*/
interface ShapeExmp{
    public function calcArea();
}

class SquareExmp implements ShapeExmp
{
    private $side;
    public function __construct($side){
        $this->side=$side;
    }
    public function calcArea(){
        $area=($this->side * $this->side);
        echo "Area of square = ".$area;
    }
}

class RectangleExmp implements ShapeExmp
{
    private $width1;
    private $height1;
    public function __construct($width1,$height1){
        $this->width1 = $width1;
        $this->height1 = $height1;
    }
    public function calcArea(){
        $area=($this->width1 * $this->height1);
        echo "\nArea of rectangle = ".$area;
    }
}

class TriangleExmp implements ShapeExmp
{
    private $const1;
    private $width1;
    private $height1;
    public function __construct($const1,$width1,$height1){
        $this->const1 = $const1;
        $this->width1 = $width1;
        $this->height1 = $height1;
    }
    public function calcArea(){
        $area=($this->const1* $this->width1 * $this->height1);
        echo "\nArea of Triangle = ".$area;
    }  
}
$squ = new SquareExmp(8);

$squ->calcArea();

$rect = new RectangleExmp(10,15);

$rect->calcArea();

$tri = new TriangleExmp(0.5,10,12);

$tri->calcArea();
?>