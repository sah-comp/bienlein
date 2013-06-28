<?php
require __DIR__ . '/../vendor/autoload.php';
Flight::path(__DIR__ . '/../../src');
include 'setup.php';

class Model_General extends Model
{
    public function dispense()
    {
    }
}

class RedbeanGeneralTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
    }
    
    public function tearDown()
    {
    }
    
    public function testFindOne()
    {
        $beans = R::dispense('general', 2);
        //first bean
        $beans[0]->name = 'Hello World';
        $beans[0]->flag = true;
        //second bean
        $beans[1]->name = 'Goodbye World';
        $beans[1]->flag = false;
        R::storeAll($beans);
        $bean = R::findOne('general', 'flag = ?', array(true));
        $this->assertEquals('Hello World', $bean->name);
    }
}
