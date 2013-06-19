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
<!-- language edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('language_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('iso')) ? 'error' : ''; ?>">
        <label
            for="language-iso">
            <?php echo I18n::__('language_label_iso') ?>
        </label>
        <input
            id="language-iso"
            type="text"
            name="dialog[iso]"
            value="<?php echo htmlspecialchars($record->iso) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('enabled')) ? 'error' : ''; ?>">
        <input
            type="hidden"
            name="dialog[enabled]"
            value="0" />
        <input
            id="language-enabled"
            type="checkbox"
            name="dialog[enabled]"
            <?php echo ($record->enabled) ? 'checked="checked"' : '' ?>
            value="1" />
        <label
            for="language-enabled"
            class="cb">
            <?php echo I18n::__('language_label_enabled') ?>
        </label>
    </div>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="language-name">
            <?php echo I18n::__('language_label_name') ?>
        </label>
        <input
            id="language-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
</fieldset>
<!-- end of language edit form -->