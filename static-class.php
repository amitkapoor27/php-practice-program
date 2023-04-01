<?php
class BaseClass
{
    function getReturnType()
    {
        return 'Base Class';
    }
}
/**
 * 
 */
trait TraitSample
{
    function getReturnType(){
        echo "Trait Sample";
        parent::getReturnType();
    }
}
class Class1 extends BaseClass
{
    use TraitSample;
}
$obj = new Class1();
$obj->getReturnType();
?>