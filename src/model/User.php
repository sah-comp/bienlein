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
     * A session must have been started before calling this method.
     *
     * @return RedBean_OODBBean
     */
    public function current()
    {
        if (isset($_SESSION['user']['id'])) return R::load('user', $_SESSION['user']['id']);
        return R::dispense('user');
    }
    
    /**
     * Adds a notification message for this user.
     *
     * @param string $message
     */
    public function notify($message)
    {
        if (empty($message) || ! $this->bean->getId()) return false;
        $notification = R::dispense('notification');
        $notification->content = $message;
        try {
            R::store($notification);
            R::associate($this->bean, $notification);
            return true;
        }
        catch (Exception $e) {
            return false;
        }
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
        $this->bean->name = I18n::__('user_name_guest');
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
