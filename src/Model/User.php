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
                ),
                'width' => '8rem'
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
                ),
                'width' => '5rem'
            )
        );
    }

    /**
     * Returns the current user bean or an empty user bean.
     *
     * A session must have been started before calling this method.
     *
     * @return RedBeanPHP\OODBBean
     */
    public function current()
    {
        if (isset($_SESSION['user']['id'])) {
            return R::load('user', $_SESSION['user']['id']);
        }
        return R::dispense('user');
    }

    /**
     * Logout the user.
     */
    public function logout()
    {
        $this->bean->sid = null;
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
        if (! isset($_SESSION['backend']['language'])) {
            $_SESSION['backend']['language'] = Flight::get('language');
        }
        return $_SESSION['backend']['language'];
    }

    /**
     * Returns a users max session lifetime.
     *
     * @return int
     */
    public function maxLifetime()
    {
        if (! $this->bean->maxlifetime) {
            return MAX_SESSION_LIFETIME;
        }
        return $this->bean->maxlifetime;
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
        if (empty($message) || ! $this->bean->getId()) {
            return false;
        }
        $notification = R::dispense('notification');
        $notification->class = $class;
        $notification->content = $message;
        try {
            $this->bean->noLoad()->sharedNotification[] = $notification;
            R::store($this->bean);
            return true;
        } catch (Exception $e) {
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
        $all = $this->bean->with(' ORDER BY stamp ')->sharedNotification;
        if ($readOnlyOnce === true) {
            R::trashAll($all);
        }
        return $all;
    }

    /**
     * Returns an integer with the number of records per page the
     * user wants to see on one page. If user has not set that limit
     * and has not checked to see all records of one type per page
     * the default records per page limit is returned.
     *
     * @param string $type the bean type
     * @return int
     */
    public function getRecordsPerPage($type = null)
    {
        if (!$this->bean->recordsperpage && !$this->bean->allrecordsperpage) {
            return CINNEBAR_RECORDS_PER_PAGE;
        }
        if ($this->bean->allrecordsperpage) {
            return R::count($type) + 1;// we have to avoid division by zero
        }
        return $this->bean->recordsperpage;
    }

    /**
     * Send an email with a authorization token, allowing to set a new password
     * in a second step.
     *
     * @todo Implement this feature
     *
     * @return bool
     */
    public function requestPassword()
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        //$mail->isSMTP();                                      // Set mailer to use SMTP
        //$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup server
        //$mail->SMTPAuth = true;                               // Enable SMTP authentication
        //$mail->Username = 'jswan';                            // SMTP username
        //$mail->Password = 'secret';                           // SMTP password
        //$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

        $mail->From = 'info@sah-company.com';
        $mail->FromName = 'SAH';
        $mail->addAddress('info@sah-company.com', 'Stephan Hombergs');  // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('info@sah-company.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        return $mail->send();
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
        if (! password_verify($password, $this->bean->pw)) {
            return false;
        }
        if ($newPassword !== $newPasswordRepeat) {
            return false;
        }
        if (empty($newPassword)) {
            return false;
        }
        $this->bean->pw = password_hash($newPassword, PASSWORD_DEFAULT);
        return true;
    }

    /**
     * Returns wether the user has a editable list view or not.
     *
     * @see app/res/tpl/scaffold/table.php
     *
     * @return bool
     */
    public function hasfoxylisteditor()
    {
        if ($this->bean->foxylisteditor) {
            return true;
        }
        return false;
    }

    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->bean->screenname = 'shortname';
        $this->bean->maxlifetime = MAX_SESSION_LIFETIME;
        $this->bean->recordsperpage = CINNEBAR_RECORDS_PER_PAGE;
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
        if (! $this->bean->getId()) {
            $this->bean->pw = password_hash($this->bean->pw, PASSWORD_DEFAULT);
        }
        parent::update();
    }
}
