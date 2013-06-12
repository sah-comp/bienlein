<?php
require __DIR__ . '/../vendor/autoload.php';
Flight::path(__DIR__ . '/../../src');

class ConvertersTest extends PHPUnit_Framework_TestCase
{    
    public function testConverterDecimal()
    {
        $converter = new Converter_Decimal();
        $this->assertEquals(12.33, $converter->convert('12,33'));
        $this->assertEquals(0, $converter->convert('AB,c'));
    }
    
    public function testConverterMySqlDate()
    {
        $converter = new Converter_MySqlDate();
        $this->assertEquals('1984-03-23', $converter->convert('23.03.1984'));
        $this->assertEquals('1984-03-23', $converter->convert('1984-03-23'));
        $this->assertEquals('0000-00-00', $converter->convert(null));
        $this->assertEquals('0000-00-00', $converter->convert(''));
    }
    
    public function testConverterMySqlTime()
    {
        $converter = new Converter_MySqlTime();
        $this->assertEquals('17:23:00', $converter->convert('17:23'));
        $this->assertEquals('23:00:00', $converter->convert('23:00'));
        $this->assertEquals('00:00:00', $converter->convert(null));
        $this->assertEquals('00:00:00', $converter->convert(''));
    }
    
    public function testConverterMySqlDatetime()
    {
        $converter = new Converter_MySqlDatetime();
        $this->assertEquals('1984-02-03 17:23:00', $converter->convert('3.2.1984 17:23'));
        $this->assertEquals('1972-01-17 23:00:00', $converter->convert('17-01-1972 23:00'));
        $this->assertEquals('0000-00-00 00:00:00', $converter->convert(null));
        $this->assertEquals('0000-00-00 00:00:00', $converter->convert(''));
    }
}
