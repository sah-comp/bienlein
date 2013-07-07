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
<!-- newscat edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
    <input type="hidden" name="dialog[lastmodified]" value="<?php echo $record->lastmodified ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('newscat_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="newscat-name">
            <?php echo I18n::__('newscat_label_name') ?>
        </label>
        <input
            id="newscat-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
</fieldset>
<div class="tab-container">
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'newscat-tabs',
        'tabs' => array(
            'newscat-translation' => I18n::__('newscat_translation_tab')
        ),
        'default_tab' => 'newscat-translation'
    )) ?>
    <fieldset
        id="newscat-translation"
        class="tab">
        <legend class="verbose"><?php echo I18n::__('tokeni18n_legend') ?></legend>
        <?php foreach (R::findAll('language') as $_id => $_language): ?>
            <?php $_tokeni18n = $record->i18n($_language->iso) ?>
            <div class="row <?php echo ($_tokeni18n->hasError('name')) ? 'error' : ''; ?>">
                <input
                    type="hidden"
                    name="dialog[ownNewscati18n][<?php echo $_id ?>][type]"
                    value="newscati18n" />
                <input
                    type="hidden"
                    name="dialog[ownNewscati18n][<?php echo $_id ?>][id]"
                    value="<?php echo $_tokeni18n->getId() ?>" />
                <input
                    type="hidden"
                    name="dialog[ownNewscati18n][<?php echo $_id ?>][language]"
                    value="<?php echo $_tokeni18n->language ?>" />
                <label
                    for="translation-<?php echo $_language->iso ?>-<?php echo $_tokeni18n->getId() ?>">
                    <?php echo I18n::__('language_'.$_tokeni18n->language) ?>
                </label>
                <textarea
                    id="translation-<?php echo $_language->iso ?>-<?php echo $_tokeni18n->getId() ?>"
                    class="scaleable"
                    name="dialog[ownNewscati18n][<?php echo $_id ?>][name]"
                    cols="60"
                    rows="2"><?php echo htmlspecialchars($_tokeni18n->name) ?></textarea>
            </div>
        <?php endforeach ?>
    </fieldset>
</div>
<!-- end of newscat edit form -->