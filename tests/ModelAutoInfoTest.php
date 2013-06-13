<?php
require __DIR__ . '/../vendor/autoload.php';
Flight::path(__DIR__ . '/../../src');
include 'setup.php';

class Model_Withinfo extends Model
{
    public function dispense()
    {
        $this->autoInfo(true);
    }
}

class ModelAutoInfoTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
    }
    
    public function tearDown()
    {
    }
    
    public function testAutoInfo()
    {
        $withinfo = R::dispense('withinfo');
        $withinfo->name = 'Hello World. I know when i was last edited';
        R::store($withinfo);
        $this->assertTrue(count($withinfo->sharedInfo) > 0);
        
        
        $withinfo->name = 'Hello World. I know what time it is';
        R::store($withinfo);
        $this->assertTrue(count($withinfo->sharedInfo) == 2);
    }
}
