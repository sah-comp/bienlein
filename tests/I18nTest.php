<?php
require __DIR__ . '/../vendor/autoload.php';
Flight::path(__DIR__ . '/../../src');
include 'setup.php';

// setup some test token
$token = R::dispense('token');
list($translation_de, $translation_en) = R::dispense('tokeni18n', 2);
$translation_de->language = 'de';
$translation_de->name = 'Dies ist ein Test';
$translation_en->language = 'en';
$translation_en->name = 'This is a test';
$token->name = 'test_thisisatest';
$token->ownTranslation = array($translation_de, $translation_en);
R::store($token);

// setup some test token
$token2 = R::dispense('token');
list($translation_de2, $translation_en2) = R::dispense('tokeni18n', 2);
$translation_de2->language = 'de';
$translation_de2->name = 'Guten Morgen';
$translation_en2->language = 'en';
$translation_en2->name = 'Good morning';
$token2->name = 'test_goodmorning';
$token2->ownTranslation = array($translation_de2, $translation_en2);
R::store($token2);

// setup some test token with replacement slots
$token3 = R::dispense('token');
list($translation_de3, $translation_en3) = R::dispense('tokeni18n', 2);
$translation_de3->language = 'de';
$translation_de3->name = 'Guten Morgen %s';
$translation_en3->language = 'en';
$translation_en3->name = 'Good morning %s';
$token3->name = 'test_goodmorning_w_name';
$token3->ownTranslation = array($translation_de3, $translation_en3);
R::store($token3);

class I18nTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
    }
    
    public function tearDown()
    {
    }
    
    public function testI18nTranslation1()
    {
        $token = 'test_thisisatest';
        $this->assertEquals('Dies ist ein Test', I18n::__($token, 'de'));
        $this->assertEquals('This is a test', I18n::__($token, 'en'));
        $this->assertEquals('Dies ist ein Test', I18n::__($token, 'de'));
        $this->assertEquals('test_iamuntranslated', I18n::__('test_iamuntranslated', 'de'));
        $this->assertEquals('test_iamuntranslated', I18n::__('test_iamuntranslated', 'en'));
    }
    
    public function testI18nTranslation2()
    {
        $token = 'test_goodmorning';
        $this->assertEquals('Guten Morgen', I18n::__($token, 'de'));
        $this->assertEquals('Good morning', I18n::__($token, 'en'));
        $this->assertEquals('Guten Morgen', I18n::__($token, 'de'));
    }
    
    public function testI18nTranslationWithValues()
    {
        $token = 'test_goodmorning_w_name';
        $this->assertEquals('Guten Morgen Stephan', I18n::__($token, 'de', array('Stephan')));
        $this->assertEquals('Good morning Lord Helmet', I18n::__($token, 'en', array('Lord Helmet')));
        $this->assertEquals('Guten Morgen Walt', I18n::__($token, 'de', array('Walt')));
    }
}
