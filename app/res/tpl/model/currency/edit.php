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
<!-- currency edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('currency_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('iso')) ? 'error' : ''; ?>">
        <label
            for="currency-iso">
            <?php echo I18n::__('currency_label_iso') ?>
        </label>
        <input
            id="currency-iso"
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
            id="currency-enabled"
            type="checkbox"
            name="dialog[enabled]"
            <?php echo ($record->enabled) ? 'checked="checked"' : '' ?>
            value="1" />
        <label
            for="currency-enabled"
            class="cb">
            <?php echo I18n::__('currency_label_enabled') ?>
        </label>
    </div>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="currency-name">
            <?php echo I18n::__('currency_label_name') ?>
        </label>
        <input
            id="currency-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('sign')) ? 'error' : ''; ?>">
        <label
            for="currency-sign">
            <?php echo I18n::__('currency_label_sign') ?>
        </label>
        <input
            id="currency-sign"
            type="text"
            name="dialog[sign]"
            value="<?php echo htmlspecialchars($record->sign) ?>" />
    </div>
    <div class="row <?php echo ($record->hasError('fractionalunit')) ? 'error' : ''; ?>">
        <label
            for="currency-fractionalunit">
            <?php echo I18n::__('currency_label_fractionalunit') ?>
        </label>
        <input
            id="currency-fractionalunit"
            type="text"
            name="dialog[fractionalunit]"
            value="<?php echo htmlspecialchars($record->fractionalunit) ?>" />
    </div>
    <div class="row <?php echo ($record->hasError('numbertobasic')) ? 'error' : ''; ?>">
        <label
            for="currency-numbertobasic">
            <?php echo I18n::__('currency_label_numbertobasic') ?>
        </label>
        <input
            id="currency-numbertobasic"
            type="number"
            name="dialog[numbertobasic]"
            value="<?php echo htmlspecialchars($record->numbertobasic) ?>" />
    </div>
    <div class="row <?php echo ($record->hasError('exchangerate')) ? 'error' : ''; ?>">
        <label
            for="currency-exchangerate">
            <?php echo I18n::__('currency_label_exchangerate') ?>
        </label>
        <input
            id="currency-exchangerate"
            type="text"
            class="number"
            name="dialog[exchangerate]"
            value="<?php echo htmlspecialchars($record->exchangerate) ?>" />
            <p class="info">
                <?php echo I18n::__('currency_info_basecurrency', null, array(Flight::basecurrency()->name)) ?>
            </p>
    </div>
</fieldset>
