<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<!-- mailserver edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('mailserver_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="mailserver-name">
            <?php echo I18n::__('mailserver_label_name') ?>
        </label>
        <input
            id="mailserver-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('host')) ? 'error' : ''; ?>">
        <label
            for="mailserver-host">
            <?php echo I18n::__('mailserver_label_host') ?>
        </label>
        <input
            id="mailserver-host"
            type="text"
            name="dialog[host]"
            value="<?php echo htmlspecialchars($record->host) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('port')) ? 'error' : ''; ?>">
        <label
            for="mailserver-port">
            <?php echo I18n::__('mailserver_label_port') ?>
        </label>
        <input
            id="mailserver-host"
            type="text"
            name="dialog[port]"
            value="<?php echo htmlspecialchars($record->port) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('user')) ? 'error' : ''; ?>">
        <label
            for="mailserver-user">
            <?php echo I18n::__('mailserver_label_user') ?>
        </label>
        <input
            id="mailserver-user"
            type="text"
            name="dialog[user]"
            value="<?php echo htmlspecialchars($record->user) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('pw')) ? 'error' : ''; ?>">
        <label
            for="mailserver-pw">
            <?php echo I18n::__('mailserver_label_pw') ?>
        </label>
        <input
            id="mailserver-pw"
            type="password"
            name="dialog[pw]"
            value="<?php echo htmlspecialchars($record->pw) ?>"
            required="required" />
    </div>
</fieldset>
<!-- end of mailserver edit form -->