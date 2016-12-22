<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage System
 * @author $Author$
 * @version $Id$
 */

/**
 * RedbeanPHP Version 4.
 */
require __DIR__ . '/../lib/redbean/rb.php';
require __DIR__ . '/../lib/redbean/Plugin/Cooker.php';

/**
 * Autoloader.
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Configuration.
 */
require __DIR__ . '/../app/config/config.php';

// Send bulk mail
$bulks = R::find('bulk', ' newsletter_id IS NOT NULL AND send = 0 LIMIT 100');
foreach ($bulks as $id => $bulk) {
    
    $mail = new PHPMailer();
    $mail->Charset = 'UTF-8';
    $mail->Subject = utf8_decode($bulk->newsletter->name);
    $mail->From = $bulk->newsletter->replytoemail;
    $mail->FromName = utf8_decode($bulk->newsletter->replytoname);
    $mail->AddReplyTo($bulk->newsletter->replytoemail, utf8_decode($bulk->newsletter->replytoname));
    
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPKeepAlive = true;
    $mail->Host = $bulk->newsletter->mailserver->host;
    $mail->Port = $bulk->newsletter->mailserver->port;
    $mail->Username = $bulk->newsletter->mailserver->user;
    $mail->Password = $bulk->newsletter->mailserver->pw;
    
    $result = true;
    $body_html = $bulk->newsletter->template->html;
    $body_text = $bulk->newsletter->template->txt;
    $mail->MsgHTML($body_html);
    $mail->AltBody = $body_text;
    $mail->ClearAddresses();
    $mail->AddAddress($bulk->email->email);
    //$mail->AddAddress('sh@fettundrosig.com');//for testing purpose ONLY!!
    $result = $mail->Send();
    echo  $bulk->getId() . " " . $bulk->email->email ."\n";
    R::exec('UPDATE bulk SET send = ? WHERE id = ?', array($result, $bulk->getId()));
    //R::store($bulk);// Why does this fail when actually sending mail?
}
echo "Ready.\nYou man run this again until now bulk mail is left.\n\n";