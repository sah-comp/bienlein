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
        if ( ! $user = R::findOne('user', 'email=:uname OR shortname=:uname', array(
            ':uname' => $this->bean->uname
        ))) {
            $this->addError(I18n::__('login_uname_not_found'), 'uname');
            return false;
        }
        if ( ! password_verify($this->bean->pw, $user->pw)) {
            $this->addError(I18n::__('login_pw_wrong'), 'pw');
            return false;
        }
        unset($this->bean->pw); //unset the good password in this login
        $this->bean->user = $user;
        return true;
    }
}
