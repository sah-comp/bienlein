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
<!-- country edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('country_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('iso')) ? 'error' : ''; ?>">
        <label
            for="country-iso">
            <?php echo I18n::__('country_label_iso') ?>
        </label>
        <input
            id="country-iso"
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
            id="country-enabled"
            type="checkbox"
            name="dialog[enabled]"
            <?php echo ($record->enabled) ? 'checked="checked"' : '' ?>
            value="1" />
        <label
            for="country-enabled"
            class="cb">
            <?php echo I18n::__('country_label_enabled') ?>
        </label>
    </div>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="country-name">
            <?php echo I18n::__('country_label_name') ?>
        </label>
        <input
            id="country-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
</fieldset>
<div class="tab-container">
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'country-tabs',
        'tabs' => array(
            'country-translation' => I18n::__('country_translation_tab')
        ),
        'default_tab' => 'country-translation'
    )) ?>
    <fieldset
        id="country-translation"
        class="tab">
        <legend class="verbose"><?php echo I18n::__('tokeni18n_legend') ?></legend>
        <?php foreach (R::findAll('language') as $_id => $_language): ?>
            <?php $_tokeni18n = $record->i18n($_language->iso) ?>
            <div class="row <?php echo ($_tokeni18n->hasError('name')) ? 'error' : ''; ?>">
                <input
                    type="hidden"
                    name="dialog[ownCountryi18n][<?php echo $_id ?>][type]"
                    value="countryi18n" />
                <input
                    type="hidden"
                    name="dialog[ownCountryi18n][<?php echo $_id ?>][id]"
                    value="<?php echo $_tokeni18n->getId() ?>" />
                <input
                    type="hidden"
                    name="dialog[ownCountryi18n][<?php echo $_id ?>][language]"
                    value="<?php echo $_tokeni18n->language ?>" />
                <label
                    for="translation-<?php echo $_language->iso ?>-<?php echo $_tokeni18n->getId() ?>">
                    <?php echo I18n::__('language_'.$_tokeni18n->language) ?>
                </label>
                <textarea
                    id="translation-<?php echo $_language->iso ?>-<?php echo $_tokeni18n->getId() ?>"
                    class="scaleable"
                    name="dialog[ownCountryi18n][<?php echo $_id ?>][name]"
                    cols="60"
                    rows="2"><?php echo htmlspecialchars($_tokeni18n->name) ?></textarea>
            </div>
        <?php endforeach ?>
    </fieldset>
</div>
<!-- end of country edit form -->