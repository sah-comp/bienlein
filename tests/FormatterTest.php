<?php
mb_internal_encoding('UTF-8');
require __DIR__ . '/../vendor/autoload.php';
Flight::path(__DIR__ . '/../../src');
include 'setup.php';

class FormatterTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->address = R::dispense('address');
    }
    
    public function tearDown()
    {
        unset($this->address);
    }

    public function testFormatterAddressGermany()
    {
        $this->address->street = 'Waldweg 12';
        $this->address->zip = '1234';
        $this->address->city = 'Hamburgia';
        $faddress = "Waldweg 12\n1234 Hamburgia\nGERMANY";
        $formatter = new Formatter_Address_De();
        $this->assertEquals($faddress, $formatter->format($this->address));
    }
    
    public function testFormatterAddressGreatBritain()
    {
        $this->address->street = 'Maplestreet 3a';
        $this->address->zip = '3456';
        $this->address->city = 'Essex';
        $this->address->county = 'Sussex';
        $faddress = "Maplestreet 3a\nESSEX\nSussex\n3456\nUNITED KINGDOM";
        $formatter = new Formatter_Address_Gb();
        $this->assertEquals($faddress, $formatter->format($this->address));
    }
}
