<?php
require __DIR__ . '/../vendor/autoload.php';
Flight::path(__DIR__ . '/../../src');
include 'setup.php';

class Model_Withtag extends Model
{
    public function dispense()
    {
        $this->autoTag(true);
    }
    
    public function keywords()
    {
        return array(
            $this->bean->nickname,
            $this->bean->kind
        );
    }
}

class ModelAutoTagTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
    }
    
    public function tearDown()
    {
    }
    
    public function testAutoTagFather()
    {
        $withtag = R::dispense('withtag');
        $withtag->nickname = 'Walter';
        $withtag->kind = 'father';
        R::store($withtag);
        $this->assertTrue(R::hasTag($withtag, array('father', 'Walter'), $all = true));
    }
    
    public function testAutoTagMother()
    {
        $withtag = R::dispense('withtag');
        $withtag->nickname = 'Doris';
        $withtag->kind = 'mother';
        R::store($withtag);
        $this->assertTrue(R::hasTag($withtag, array('mother', 'Doris'), $all = true));
    }
}
