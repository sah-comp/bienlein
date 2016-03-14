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
<!-- newsletter edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('action_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="newsletter-name">
            <?php echo I18n::__('newsletter_label_name') ?>
        </label>
        <input
            id="newsletter-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('template_id')) ? 'error' : ''; ?>">
        <label
            for="newsletter-template">
            <?php echo I18n::__('newsletter_label_template') ?>
        </label>
        <select
            id="newsletter-template"
            name="dialog[template_id]">
            <option value=""><?php echo I18n::__('newsletter_template_please_select') ?></option>
            <?php foreach (R::find('template', ' ORDER BY name') as $_id => $_template): ?>
            <option
                value="<?php echo $_template->getId() ?>"
                <?php echo ($record->template_id == $_template->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_template->name) ?></option>   
            <?php endforeach ?>
        </select>
    </div>
    <div class="row <?php echo ($record->hasError('mailserver_id')) ? 'error' : ''; ?>">
        <label
            for="newsletter-mailserver">
            <?php echo I18n::__('newsletter_label_mailserver') ?>
        </label>
        <select
            id="newsletter-mailserver"
            name="dialog[mailserver_id]">
            <option value=""><?php echo I18n::__('newsletter_mailserver_please_select') ?></option>
            <?php foreach (R::find('mailserver', ' ORDER BY name') as $_id => $_mailserver): ?>
            <option
                value="<?php echo $_mailserver->getId() ?>"
                <?php echo ($record->mailserver_id == $_mailserver->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_mailserver->name) ?></option>   
            <?php endforeach ?>
        </select>
    </div>
    <div class="row <?php echo ($record->hasError('replytoemail')) ? 'error' : ''; ?>">
        <label
            for="newsletter-replytoemail">
            <?php echo I18n::__('newsletter_label_replytoemail') ?>
        </label>
        <input
            id="newsletter-replytoemail"
            type="email"
            name="dialog[replytoemail]"
            value="<?php echo htmlspecialchars($record->replytoemail) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('replytoname')) ? 'error' : ''; ?>">
        <label
            for="newsletter-replytoname">
            <?php echo I18n::__('newsletter_label_replytoname') ?>
        </label>
        <input
            id="newsletter-replytoname"
            type="text"
            name="dialog[replytoname]"
            value="<?php echo htmlspecialchars($record->replytoname) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('testemail')) ? 'error' : ''; ?>">
        <label
            for="newsletter-testemail">
            <?php echo I18n::__('newsletter_label_testemail') ?>
        </label>
        <input
            id="newsletter-testemail"
            type="email"
            name="dialog[testemail]"
            value="<?php echo htmlspecialchars($record->testemail) ?>"
            required="required" />
    </div>
</fieldset>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('action_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('command')) ? 'error' : ''; ?>">
        <label
            for="newsletter-command">
            <?php echo I18n::__('newsletter_label_command') ?>
        </label>
        <select
            id="newsletter-command"
            name="dialog[command]">
            <option value=""><?php echo I18n::__('newsletter_command_please_select') ?></option>
            <?php foreach ($record->getCommands() as $_command): ?>
            <option
                value="<?php echo $_command ?>"><?php echo I18n::__('newsletter_command_'.$_command) ?></option>   
            <?php endforeach ?>
        </select>
    </div>
</fieldset>
<!-- end of newsletter edit form -->