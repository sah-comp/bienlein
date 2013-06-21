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
<?php $_languages = R::find('language', ' enabled = ?', array(true)) ?>
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
            placeholder="<?php echo I18n::__('token_placeholder_name') ?>"
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
            rows="3"
            placeholder="<?php echo I18n::__('token_placeholder_desc') ?>"><?php echo htmlspecialchars($record->desc) ?></textarea>
    </div>
</fieldset>

<div class="tab-container">
    <fieldset
        id="token-translation"
        class="tab">
        <legend class="verbose"><?php echo I18n::__('tokeni18n_legend') ?></legend>
        <?php foreach ($_languages as $_id => $_language): ?>
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
