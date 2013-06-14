<?php
require __DIR__ . '/../vendor/autoload.php';
Flight::path(__DIR__ . '/../../src');
include 'setup.php';

class UrlTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
    }
    
    public function tearDown()
    {
    }
    
    public function testUrlGeneratorCurLangIsDefaultLang()
    {
        Flight::set('default_language', 'de');
        Flight::set('language', 'de');
        $absUrl = '/admin/user/edit/1';
        $this->assertEquals('/admin/user/edit/1', Url::build($absUrl));
    }
    
    public function testUrlGeneratorCurLangIsNotDefaultLang()
    {
        Flight::set('default_language', 'de');
        Flight::set('language', 'en');
        $absUrl = '/admin/user/edit/1';
        $this->assertEquals('/en/admin/user/edit/1', Url::build($absUrl));
    }

    public function testUrlWithQueryParameters()
    {
        Flight::set('default_language', 'de');
        Flight::set('language', 'de');
        $absUrl = '/admin/user/%s/%d';
        $params = array(
            'edit',
            123
        );
        $this->assertEquals('/admin/user/edit/123', Url::build($absUrl, $params));
    }
    
    public function testUrlWithQueryParametersUrlEncoded()
    {
        Flight::set('default_language', 'de');
        Flight::set('language', 'de');
        $absUrl = '/admin/user/%s/%s';
        $params = array(
            'Mööp',
            'a&b'
        );
        $this->assertEquals('/admin/user/M%C3%B6%C3%B6p/a%26b', Url::build($absUrl, $params));
    }
    
    public function testUrlWithQueryParametersUrlEncodedWithNamedSlots()
    {
        Flight::set('default_language', 'de');
        Flight::set('language', 'de');
        $absUrl = '/admin/user/%1$s/%1$s';
        $params = array(
            'Mööp',
            'notused'
        );
        $this->assertEquals('/admin/user/M%C3%B6%C3%B6p/M%C3%B6%C3%B6p', Url::build($absUrl, $params));
    }
}
