<?php
/**
 * Token fieldset for editing partial.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<!-- token edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('token_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="token-name">
            <?php echo I18n::__('token_label_name') ?>
        </label>
        <input
            id="token-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('desc')) ? 'error' : ''; ?>">
        <label
            for="token-desc">
            <?php echo I18n::__('token_label_desc') ?>
        </label>
        <textarea
            id="token-desc"
            name="dialog[desc]"
            placeholder="<?php echo I18n::__('token_placeholder_desc') ?>"
            rows="3"><?php echo htmlspecialchars($record->desc) ?></textarea>
            <p class="info">
                <?php echo I18n::__('token_info_desc') ?>
            </p>
    </div>
</fieldset>

<div class="tab-container">
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'token-tabs',
        'tabs' => array(
            'token-translation' => I18n::__('token_translation_tab')
        ),
        'default_tab' => 'token-translation'
    )) ?>
    <fieldset
        id="token-translation"
        class="tab">
        <legend class="verbose"><?php echo I18n::__('tokeni18n_legend') ?></legend>
        <?php foreach (R::findAll('language') as $_id => $_language): ?>
            <?php $_tokeni18n = $record->i18n($_language->iso) ?>
            <div class="row <?php echo ($_tokeni18n->hasError('name')) ? 'error' : ''; ?>">
                <input
                    type="hidden"
                    name="dialog[ownTokeni18n][<?php echo $_id ?>][type]"
                    value="tokeni18n" />
                <input
                    type="hidden"
                    name="dialog[ownTokeni18n][<?php echo $_id ?>][id]"
                    value="<?php echo $_tokeni18n->getId() ?>" />
                <input
                    type="hidden"
                    name="dialog[ownTokeni18n][<?php echo $_id ?>][language]"
                    value="<?php echo $_tokeni18n->language ?>" />
                <label
                    for="translation-<?php echo $_language->iso ?>-<?php echo $_tokeni18n->getId() ?>">
                    <?php echo I18n::__('language_'.$_tokeni18n->language) ?>
                </label>
                <textarea
                    id="translation-<?php echo $_language->iso ?>-<?php echo $_tokeni18n->getId() ?>"
                    class="scaleable"
                    name="dialog[ownTokeni18n][<?php echo $_id ?>][name]"
                    cols="60"
                    rows="2"><?php echo htmlspecialchars($_tokeni18n->name) ?></textarea>
            </div>
        <?php endforeach ?>
    </fieldset>
</div>
<!-- end of token edit form -->
