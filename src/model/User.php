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
 * User model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_User extends Model
{
    /**
     * Returns the current user bean or an empty user bean.
     *
     * @return RedBean_OODBBean
     */
    public function current()
    {
        return R::dispense('user');
    }

    /**
     * Returns true when the new password was set or false if not.
     *
     * @param string $password
     * @param string $newPassword
     * @param string $newPasswordRepeat
     *
     * @return bool
     */
    public function changePassword($password, $newPassword, $newPasswordRepeat)
    {
        if ( ! password_verify($password, $this->bean->pw)) return false;
        if ( $newPassword !== $newPasswordRepeat) return false;
        if ( empty($newPassword)) return false;
        $this->bean->pw = password_hash($newPassword, PASSWORD_DEFAULT);
        return true;
    }
    
    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->autoInfo(true);
        $this->addValidator('name', new Validator_HasValue());
        $this->addValidator('pw', new Validator_HasValue());
        $this->addValidator('email', new Validator_IsEmail());
    }
    
    /**
     * Update.
     */
    public function update()
    {
        if ( ! $this->bean->getId()) {
            $this->bean->pw = password_hash($this->bean->pw, PASSWORD_DEFAULT);
        }
        parent::update();
    }
}
