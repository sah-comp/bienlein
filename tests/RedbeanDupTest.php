<?php
require __DIR__ . '/../vendor/autoload.php';
Flight::path(__DIR__ . '/../../src');
include 'setup.php';

class Model_Dupya extends Model
{
    public function dispense()
    {
    }
}

class RedbeanDupTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
    }
    
    public function tearDown()
    {
    }
    
    public function testFindOne()
    {
        $arms = R::dispense('arm', 2);
        $arms[0]->name = 'left arm';
        $arms[1]->name = 'right arm';
        $head = R::dispense('head');
        $head->name = 'pinhead';
        $body = R::dispense('body');
        $body->name = 'Ghool';
        $body->ownHead = $head;
        $body->sharedArm = array($arms[0], $arms[1]);
        R::store($body);
        $newbody = R::findOne('body', ' name = ?', array('Ghool'));
        $zombie = R::dup($newbody);
        $zombie->name = 'Nexus';
        R::store($zombie);
        $myZombie = R::findOne('body', ' name = ?', array('Nexus'));
        $this->assertEquals('Nexus', $myZombie->name);
        $myBody = R::findOne('body', ' name = ?', array('Ghool'));
        $this->assertEquals('Ghool', $myBody->name);
    }
}
