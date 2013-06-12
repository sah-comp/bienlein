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
    public function auth()
    {
        if ( ! $user = R::findOne('user', 'email=:uname OR name=:uname OR shortname=:uname', array(
            ':uname' => $this->bean->uname
        ))) {
            return false;
        }
        if ( ! password_verify($this->bean->pw, $user->pw)) {
            return false;
        }
        unset($this->bean->pw); //unset the good password in this login
        $this->bean->user = $user;
        return true;
    }
}
