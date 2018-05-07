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
<?php
$_personkinds = $record->sharedPersonkind;
?>
<!-- email edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('email_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('email')) ? 'error' : ''; ?>">
        <label
            for="email-email">
            <?php echo I18n::__('email_label_email') ?>
        </label>
        <input
            id="email-email"
            type="email"
            name="dialog[email]"
            value="<?php echo htmlspecialchars($record->email) ?>"
            required="required" />
    </div>
</fieldset>
<fieldset
    id="email-personkind"
    class="tab"
    style="display: block;">
    <legend class="verbose"><?php echo I18n::__('email_legend_personkind') ?></legend>
    <?php foreach (R::findAll('personkind') as $_id => $_pk): ?>
    <div class="row">
        <input
            type="hidden"
            name="dialog[sharedPersonkind][<?php echo $_pk->getId() ?>][type]"
            value="personkind" />
        <input
            type="hidden"
            name="dialog[sharedPersonkind][<?php echo $_pk->getId() ?>][id]"
            value="0" />
        <label
            for="email-<?php echo $record->getId() ?>-personkind-<?php echo $_pk->getId() ?>"
            class="cb"><?php echo htmlspecialchars($_pk->name) ?></label>
        <input
            type="checkbox"
            id="email-<?php echo $record->getId() ?>-personkind-<?php echo $_pk->getId() ?>"
            name="dialog[sharedPersonkind][<?php echo $_pk->getId() ?>][id]"
            value="<?php echo $_pk->getId() ?>"
            <?php echo (isset($_personkinds[$_pk->getId()])) ? 'checked="checked"' : '' ?> />
    </div>
    <?php endforeach ?>
</fieldset>
<!-- end of email edit form -->
