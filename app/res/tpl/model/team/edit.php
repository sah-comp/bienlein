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
<!-- team edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('team_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="team-name">
            <?php echo I18n::__('team_label_name') ?>
        </label>
        <input
            id="team-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
</fieldset>
<div class="tab-container">
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'team-tabs',
        'tabs' => array(
            'team-translation' => I18n::__('team_translation_tab')
        ),
        'default_tab' => 'team-translation'
    )) ?>
    <fieldset
        id="team-translation"
        class="tab">
        <legend class="verbose"><?php echo I18n::__('tokeni18n_legend') ?></legend>
        <?php foreach (R::findAll('language') as $_id => $_language): ?>
            <?php $_tokeni18n = $record->i18n($_language->iso) ?>
            <div class="row <?php echo ($_tokeni18n->hasError('name')) ? 'error' : ''; ?>">
                <input
                    type="hidden"
                    name="dialog[ownTeami18n][<?php echo $_id ?>][type]"
                    value="teami18n" />
                <input
                    type="hidden"
                    name="dialog[ownTeami18n][<?php echo $_id ?>][id]"
                    value="<?php echo $_tokeni18n->getId() ?>" />
                <input
                    type="hidden"
                    name="dialog[ownTeami18n][<?php echo $_id ?>][language]"
                    value="<?php echo $_tokeni18n->language ?>" />
                <label
                    for="translation-<?php echo $_language->iso ?>-<?php echo $_tokeni18n->getId() ?>">
                    <?php echo I18n::__('language_'.$_tokeni18n->language) ?>
                </label>
                <textarea
                    id="translation-<?php echo $_language->iso ?>-<?php echo $_tokeni18n->getId() ?>"
                    class="scaleable"
                    name="dialog[ownTeami18n][<?php echo $_id ?>][name]"
                    cols="60"
                    rows="2"><?php echo htmlspecialchars($_tokeni18n->name) ?></textarea>
            </div>
        <?php endforeach ?>
    </fieldset>
</div>
<!-- end of team edit form -->