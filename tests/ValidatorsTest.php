<?php
require __DIR__ . '/../vendor/autoload.php';
Flight::path(__DIR__ . '/../../src');
include 'setup.php';

class ValidatorsTest extends PHPUnit_Framework_TestCase
{    
    public function testValidatorHasValue()
    {
        $validator = new Validator_HasValue();
        $value = '';
        $this->assertFalse($validator->validate(null));
        $this->assertFalse($validator->validate(1-1));
        $this->assertFalse($validator->validate('AA'-'AA'));
        $this->assertFalse($validator->validate(0 * 3.14));
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate($value));
        
        $this->assertTrue($validator->validate(1));
        $this->assertTrue($validator->validate('1'));
        $this->assertTrue($validator->validate('ABC'));
    }
    
    public function testValidatorIsDate()
    {
        $validator = new Validator_IsDate();
        $value = '1668-03-23';
        $this->assertFalse($validator->validate(null));
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate('ABC'));
        $this->assertFalse($validator->validate(12));
        $this->assertfalse($validator->validate('1.1.1902'));
        
        $this->assertTrue($validator->validate($value));
    }
    
    public function testValidatorIsEmail()
    {
        $validator = new Validator_IsEmail();
        $this->assertFalse($validator->validate(null));
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate('ABC'));
        $this->assertFalse($validator->validate(12));
        $this->assertFalse($validator->validate('infoœsah.com'));
        $this->assertFalse($validator->validate('info@sah'));
        $this->assertFalse($validator->validate('@sah.com'));
        
        $this->assertTrue($validator->validate('info@example.com'));
        $this->assertTrue($validator->validate('123geheim@example.org'));
        $this->assertTrue($validator->validate('a.b.c@example.de'));
    }
    
    public function testValidatorIsNumeric()
    {
        $validator = new Validator_IsNumeric();
        $this->assertFalse($validator->validate('ABC'));
        $this->assertFalse($validator->validate(''));
        
        $this->assertTrue($validator->validate('123'));
        $this->assertTrue($validator->validate('123.45'));
        $this->assertTrue($validator->validate(12));
        $this->assertTrue($validator->validate(12.45));
    }
    
    public function testValidatorIsUnique()
    {
        $bean = R::dispense('uniqueness');
        $bean->name = 'Walt';
        R::store($bean);
        
        $validator = new Validator_IsUnique(array('bean' => $bean, 'attribute' => 'name'));
        $this->assertTrue($validator->validate('Walth'));
        $this->assertFalse($validator->validate('Walt'));
    }
    
    public function testValidatorRange()
    {
        $validator = new Validator_Range(array('min' => 100, 'max' => 112));
        $this->assertFalse($validator->validate(1));
        $this->assertFalse($validator->validate(99.99));
        $this->assertFalse($validator->validate(112.0001));
        $this->assertFalse($validator->validate(12333));
        
        $this->assertTrue($validator->validate('105'));
        $this->assertTrue($validator->validate(107));
        $this->assertTrue($validator->validate(108.23));
    }
}
