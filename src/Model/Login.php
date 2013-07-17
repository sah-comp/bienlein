<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Model
 * @author $Author$
 * @version $Id$
 */

/**
 * Login model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Login extends Model
{
    /**
     * Returns true if the login was authorized or false if not.
     *
     * If a user was found and the password was verified the given password is unset
     * and the found user bean is stored in our login bean.
     *
     * @return bool
     */
    public function trial()
    {
        $this->bean->attempt++;
        if ( ! $user = R::findOne('user', 'email=:uname OR shortname=:uname', array(
            ':uname' => $this->bean->uname
        ))) {
            $this->addError(I18n::__('login_user_not_found'), 'uname');
            return false;
        }
        if ($user->isBanned() || $user->isDeleted()) {
            $this->addError(I18n::__('login_user_not_available'));
            return false;            
        }
        if ( ! password_verify($this->bean->pw, $user->pw)) {
            $this->addError(I18n::__('login_pw_wrong'), 'pw');
            return false;
        }
        $this->bean->user = $user;
        return true;
    }
    
    /**
     * dispense.
     */
    public function dispense()
    {
        $this->bean->stamp = time();
        $this->bean->attempt = 0;
        $this->bean->ipaddr = ip2long(Flight::request()->ip);
        $this->addValidator('uname', new Validator_HasValue());
    }
    
    /**
     * Update.
     */
    public function update()
    {
        unset($this->bean->pw);
        parent::update();
    }
}
