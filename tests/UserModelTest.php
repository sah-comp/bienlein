<?php
require __DIR__ . '/../vendor/autoload.php';
Flight::path(__DIR__ . '/../../src');
include 'setup.php';

class UserModelTest extends PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->userAsModel = new Model_User();
        $this->userAsBean = R::dispense('user');
        $this->login = R::dispense('login');
    }
    
    public function tearDown()
    {
        unset($this->userAsModel);
        unset($this->userAsBean);
        unset($this->login);
    }
    
    public function testUserModelInstanciation()
    {
        $this->assertTrue(is_a($this->userAsModel, 'Model_User'));
    }
    
    public function testUserBeanInstanciation()
    {
        $this->assertTrue(is_a($this->userAsBean, 'RedBean_OODBBean'));
    }
    
    public function testUserStoreValidBean()
    {
        $this->userAsBean->name = 'John Doe';
        $this->userAsBean->shortname = 'jd';
        $this->userAsBean->email = 'info@example.com';
        $this->userAsBean->pw = 'secret';
        R::store($this->userAsBean);
        $this->assertTrue($this->userAsBean->getId() != 0);
    }
    
    public function testUserStoreInvalidBeanDefaultValidationModeExplicit()
    {
        $invalidUser = R::dispense('user');
        $invalidUser->setValidationMode(Model::VALIDATION_MODE_EXPLICIT);
        $invalidUser->name = 'Donald Duck';
        $invalidUser->shortname = 'dd';
        $invalidUser->email = 'donaldexample.com'; //invalid email address
        $invalidUser->pw = 'secret';
        $this->assertFalse($invalidUser->validate());
    }
    
    public function testUserStoreInvalidBeanDefaultValidationModeImplicit()
    {
        $invalidUser = R::dispense('user');
        $invalidUser->setValidationMode(Model::VALIDATION_MODE_IMPLICIT);
        $invalidUser->name = 'Donald Duck';
        $invalidUser->shortname = 'dd';
        $invalidUser->email = 'donaldexample.com'; //invalid email address
        $invalidUser->pw = 'secret';
        $this->assertFalse($invalidUser->validate());
        R::store($invalidUser);
        $this->assertTrue($invalidUser->getId() != 0);
        $this->assertNotEquals(false, $invalidUser->invalid);
    }
    
    /**
     * @expectedException Exception_Validation
     */
    public function testUserStoreInvalidBeanDefaultValidationModeException()
    {
        $invalidUser = R::dispense('user');
        $invalidUser->setValidationMode(Model::VALIDATION_MODE_EXCEPTION);
        $invalidUser->name = 'Donald Duck';
        $invalidUser->shortname = 'dd';
        $invalidUser->email = 'donaldexample.com'; //invalid email address
        $invalidUser->pw = 'secret';
        $this->assertFalse($invalidUser->validate());
        R::store($invalidUser);
    }
    
    public function testUserNotify()
    {
        $this->userAsBean->name = 'Receiver';
        $this->userAsBean->shortname = 'rec';
        $this->userAsBean->email = 'receiver@example.com';
        $this->userAsBean->pw = 'secret';
        R::store($this->userAsBean);
        $this->assertTrue($this->userAsBean->getId() != 0);
        $this->userAsBean->notify('My test notification 1');
        $this->userAsBean->notify('My test notification 2');
        $notifications = $this->userAsBean->getNotifications();
        $this->assertTrue(is_array($notifications));
        $this->assertTrue(count($notifications) == 2);
        // once loaded the notifications where deleted
        $notifications = $this->userAsBean->getNotifications();
        $this->assertTrue(is_array($notifications));
        $this->assertTrue(count($notifications) == 0);
        $this->userAsBean->notify('My test notification, to have something in the test db');
    }
 
    public function testLoginSQLInjection1()
    {
        $this->login->uname = "anything' OR 'x'='x";
        $this->login->pw = '*';
        $this->assertFalse($this->login->trial());
    }
    
    public function testLoginSQLInjection2()
    {
        $this->login->uname = "x' AND email IS NULL; --";
        $this->login->pw = '*';
        $this->assertFalse($this->login->trial());
    }
    
    public function testLoginSQLInjection3()
    {
        $this->login->uname = "x';
                INSERT INTO user ('email','pw','name','shortname') 
                VALUES ('hacker@example.com','hello','Hacker','hkr');--";
        $this->login->pw = '*';
        $this->assertFalse($this->login->trial());
        $this->assertNull(R::findOne('user', 'shortname=?', array('hkr')));
    }
    
    public function testLoginFailed()
    {
        $this->login->uname = 'badusername@example.com';
        $this->login->pw = 'secret';
        $this->assertFalse($this->login->trial());
                
        $this->login->uname = 'info@example.com'; //good username
        $this->login->pw = 'wrongpassword';
        $this->assertFalse($this->login->trial());
        
        $this->login->uname = 'badusername@example.com';
        $this->login->pw = 'wrongpassword';
        $this->assertFalse($this->login->trial());
        
        $this->login->uname = 'badusername@example.com';
        $this->login->pw = 'wrongpassword';
        $this->assertFalse($this->login->trial());
    }
    
    public function testLoginWithEmailGood()
    {
        $this->login->uname = 'info@example.com';
        $this->login->pw = 'secret';
        $this->assertTrue($this->login->trial());
        $this->assertTrue(is_a($this->login->user, 'RedBean_OODBBean'));
        $this->assertEmpty($this->login->pw);
    }
    
    public function testLoginWithNameGood()
    {
        $this->login->uname = 'jd';
        $this->login->pw = 'secret';
        $this->assertTrue($this->login->trial());
        $this->assertTrue(is_a($this->login->user, 'RedBean_OODBBean'));
        $this->assertEmpty($this->login->pw);
    }
    
    public function testLoginWithShortnameGood()
    {
        $this->login->uname = 'jd';
        $this->login->pw = 'secret';
        $this->assertTrue($this->login->trial());
        $this->assertTrue(is_a($this->login->user, 'RedBean_OODBBean'));
        $this->assertEmpty($this->login->pw);
    }

    public function testUserBugIsUniqueValidators()
    {
        $user = R::dispense('user');
        $user->name = 'Someone Lastname';
        $user->shortname = 'some';
        $user->email = 'some@example.com';
        $user->pw = 'somesecret';
        R::store($user);
        $this->assertTrue($user->getId() != 0);
        // some changes and restoring
        
        $reloaded = R::load('user', $user->getId());
        
        $reloaded->shortname = 'wow';
        R::store($reloaded);
    }

    public function testUserChangePassword()
    {
        $user = R::dispense('user');
        $user->name = 'Walter Disney';
        $user->shortname = 'waltdi';
        $user->email = 'waltdi@example.com';
        $user->pw = 'mickey';
        R::store($user);
        // reload user, because the validators get messed up else
        $user = R::load('user', $user->getId());
        // hmm.. dataProvider? for above
        $this->assertFalse($user->changePassword('wrongpassword', 'mickeymouse', 'mickeymouse'));
        $this->assertFalse($user->changePassword('wrongpassword', '', '')); //empty new password
        $this->assertFalse($user->changePassword('wrongpassword', 'mickey1', 'mickey2')); //new pw mismatch
        $this->assertTrue($user->changePassword('mickey', 'mickeymouse', 'mickeymouse'));
        R::store($user);
        // just for the sake of it
        $this->login->uname = 'waltdi';
        $this->login->pw = 'mickeymouse';
        $this->assertTrue($this->login->trial());
        $this->assertTrue($this->login->user->getId() == $user->getId());
    }
}
