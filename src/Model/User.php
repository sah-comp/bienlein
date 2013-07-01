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
     * Returns an array with attributes for lists.
     *
     * @param string (optional) $layout
     * @return array
     */
    public function getAttributes($layout = 'table')
    {
        return array(
            array(
                'name' => 'shortname',
                'sort' => array(
                    'name' => 'user.shortname'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'name',
                'sort' => array(
                    'name' => 'user.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'email',
                'sort' => array(
                    'name' => 'user.email'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'isadmin',
                'sort' => array(
                    'name' => 'user.isadmin'
                ),
                'callback' => array(
                    'name' => 'boolean'
                ),
                'filter' => array(
                    'tag' => 'bool'
                )
            )
        );
    }
    
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
     * Returns the users screenname, depending on what the user has choose in the profile.
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->bean->{$this->bean->screenname};
    }
    
    /**
     * Returns the current backend iso language code.
     *
     * A session must have already been started before using this.
     *
     * @return string
     */
    public function getLanguage()
    {
        if ( ! isset($_SESSION['backend']['language'])) {
            $_SESSION['backend']['language'] = Flight::get('language');
        }
        return $_SESSION['backend']['language'];
    }
    
    /**
     * Returns wether the user is banned or not.
     *
     * @return bool
     */
    public function isBanned()
    {
        return $this->bean->isbanned;
    }
    
    /**
     * Returns wether the user is deleted or not.
     *
     * @return bool
     */
    public function isDeleted()
    {
        return $this->bean->isdeleted;
    }
    
    /**
     * Adds a notification message for this user.
     *
     * @param string $message
     * @param string (optional) $class can be info, warning, success, danger and so on
     */
    public function notify($message, $class = 'info')
    {
        if (empty($message) || ! $this->bean->getId()) return false;
        $notification = R::dispense('notification');
        $notification->class = $class;
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
     * Returns an array with unread notification(s) of this user.
     *
     * If optional parameter is set to false the notifcations are not 
     * deleted after loading.
     *
     * @param bool (optional) $readOnlyOnce defaults to true
     * @return array
     */
    public function getNotifications($readOnlyOnce = true)
    {
        $all = R::related($this->bean, 'notification', ' 1 ORDER BY stamp');
        if ($readOnlyOnce === true) R::trashAll($all);
        return $all;
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
        $this->bean->screenname = 'shortname';
        $this->autoInfo(true);
        $this->addValidator('name', array(
            new Validator_HasValue()
        ));
        $this->addValidator('shortname', array(
            new Validator_HasValue(),
            new Validator_IsUnique(array('bean' => $this->bean, 'attribute' => 'shortname'))
        ));
        $this->addValidator('pw', new Validator_HasValue());
        $this->addValidator('email', array(
            new Validator_IsEmail(),
            new Validator_IsUnique(array('bean' => $this->bean, 'attribute' => 'email'))
        ));
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
