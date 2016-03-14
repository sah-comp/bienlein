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
 * Newsletter model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Newsletter extends Model
{
    /**
     * Commands to perform when updating
     */
    public $commands = array(
        'idle',
        'test',
        'make'
    );
    
    /**
     * Returns an array with possible commands.
     *
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }
    
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
                'name' => 'name',
                'sort' => array(
                    'name' => 'newsletter.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'template_name',
                'callback' => array(
                    'name' => 'templateName'
                ),
                'sort' => array(
                    'name' => 'template.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'mailserver_name',
                'callback' => array(
                    'name' => 'mailserverName'
                ),
                'sort' => array(
                    'name' => 'mailserver.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            )
        );
    }
    
    /**
     * Returns the template name.
     *
     * @return string
     */
    public function templateName()
    {
        if ( ! $this->bean->template ) return '';
        return $this->bean->template->name;
    }
    
    /**
     * Returns the mailserver name.
     *
     * @return string
     */
    public function mailserverName()
    {
        return $this->bean->mailserver->name;
    }
    
    /**
     * Returns SQL string.
     *
     * @param string (optional) $fields to select
     * @param string (optional) $where
     * @param string (optional) $order
     * @param int (optional) $offset
     * @param int (optional) $limit
     * @return string $sql
     */
    public function getSql($fields = 'id', $where = '1', $order = null, $offset = null, $limit = null)
    {
		$sql = <<<SQL
		SELECT
		    {$fields}
		FROM
		    {$this->bean->getMeta('type')}
		LEFT JOIN template ON template.id = template_id
		LEFT JOIN mailserver ON mailserver.id = mailserver_id
		WHERE
		    {$where}
SQL;
        //add optional order by
        if ($order) {
            $sql .= " ORDER BY {$order}";
        }
        //add optional limit
        if ($offset || $limit) {
            $sql .= " LIMIT {$offset}, {$limit}";
        }
        return $sql;
    }
    
    /**
     * Dispense.
     */
    public function dispense()
    {
    }

    /**
     * Update.
     */
    public function update()
    {
        if ($this->bean->template_id) {
            $this->bean->template = R::load('template', $this->bean->template_id);
        } else {
            unset($this->bean->template);
        }
        if ($this->bean->mailserver_id) {
            $this->bean->mailserver = R::load('mailserver', $this->bean->mailserver_id);
        } else {
            unset($this->bean->mailserver);
        }
        switch ($this->bean->command) {
            case 'idle':
                break;
            case 'test':
                if ( ! $this->test() ) {
                    Flight::get('user')->notify(I18n::__("newsletter_test_failed"), 'error');
                }
                break;
            case 'make':
                $this->make();
                break;
            default:   
        }
        $this->bean->command = 'idle';// Reset to idle whenever updated.
        parent::update();
    }
    
    /**
     * Send a test mail with this newsletter.
     *
     * @return bool
     */
    public function test()
    {
        $mail = new PHPMailer();
        $mail->Charset = 'UTF-8';
        $mail->Subject = utf8_decode($this->bean->name);
        $mail->From = $this->bean->replytoemail;
        $mail->FromName = utf8_decode($this->bean->replytoname);
        $mail->AddReplyTo($this->bean->replytoemail, utf8_decode($this->bean->replytoname));
        
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPKeepAlive = true;
        $mail->Host = $this->bean->mailserver->host;
        $mail->Port = $this->bean->mailserver->port;
        $mail->Username = $this->bean->mailserver->user;
        $mail->Password = $this->bean->mailserver->pw;
        
        $result = true;
        $body_html = $this->bean->template->html;
        $body_text = $this->bean->template->txt;
        $mail->MsgHTML($body_html);
        $mail->AltBody = $body_text;
        $mail->ClearAddresses();
        $mail->AddAddress($this->bean->testemail);
        return $result = $mail->Send();
    }
    
    /**
     * For all email addresses this newsletter will be prepared for bulk sending.
     *
     * @return bool
     */
    public function make()
    {
        $this->bean->ownBulk = array();
        $emails = R::findAll('email');
        foreach ($emails as $id => $email) {
            $bulk = R::dispense('bulk');
            $bulk->email = $email;
            $bulk->send = false;
            $this->bean->ownBulk[] = $bulk;
        }
        return true;
    }
}
