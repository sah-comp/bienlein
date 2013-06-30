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
<!-- domain edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('domain_legend') ?></legend>
    <div class="row">
        <label
            for="domain-parent"
            class="<?php echo ($record->hasError('domain_id')) ? 'error' : ''; ?>">
            <?php echo I18n::__('domain_label_parent') ?>
        </label>
        <select
            id="domain-parent"
            name="dialog[domain_id]">
            <option value=""><?php echo I18n::__('domain_parent_none') ?></option>
            <?php foreach (R::findAll('domain') as $_id => $_domain): ?>
            <option
                value="<?php echo $_domain->getId() ?>"
                <?php echo ($record->getId() == $_domain->getId()) ? 'disabled="disabled"' : '' ?>
                <?php echo ($record->domain_id == $_domain->getId()) ? 'selected="selected"' : '' ?>><?php echo $_domain->i18n(Flight::get('language'))->name ?></option>   
            <?php endforeach ?>
        </select>
    </div>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="domain-name">
            <?php echo I18n::__('domain_label_name') ?>
        </label>
        <input
            id="domain-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('url')) ? 'error' : ''; ?>">
        <label
            for="domain-url">
            <?php echo I18n::__('domain_label_url') ?>
        </label>
        <input
            id="domain-url"
            type="text"
            name="dialog[url]"
            value="<?php echo htmlspecialchars($record->url) ?>" />
    </div>
    <div class="row">
        <input
            type="hidden"
            name="dialog[invisible]"
            value="0" />
        <input
            id="domain-invisible"
            type="checkbox"
            name="dialog[invisible]"
            <?php echo ($record->invisible) ? 'checked="checked"' : '' ?>
            value="1" />
        <label
            for="domain-invisible"
            class="cb <?php echo ($record->hasError('invisible')) ? 'error' : ''; ?>">
            <?php echo I18n::__('domain_label_invisible') ?>
        </label>
    </div>
    <div class="row">
        <label
            for="domain-sequence"
            class="<?php echo ($record->hasError('sequence')) ? 'error' : ''; ?>">
            <?php echo I18n::__('domain_label_sequence') ?>
        </label>
        <input
            id="domain-sequence"
            type="number"
            min="0"
            step="10"
            max="99999999"
            name="dialog[sequence]"
            value="<?php echo htmlspecialchars($record->sequence) ?>" />
    </div>
</fieldset>
<div class="tab-container">
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'domain-tabs',
        'tabs' => array(
            'domain-rbac' => I18n::__('domain_rbac_tab'),
            'domain-translation' => I18n::__('domain_translation_tab')
        ),
        'default_tab' => 'domain-rbac'
    )) ?>
    <fieldset
        id="domain-rbac"
        class="tab">
        <legend class="verbose"><?php echo I18n::__('domain_legend_rbac') ?></legend>
        <?php $_roles = R::findAll('role') ?>
        <table>
            <thead>
                <tr class="">
                    <th class="label">
                        <?php echo I18n::__('domain_label_action') ?>
                    </th>
                    <?php foreach ($_roles as $_role_id => $_role): ?>
                    <th>
                        <?php echo $_role->i18n(Flight::get('language'))->name ?>
                    </th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
        <?php foreach (R::findAll('action') as $_action_id => $_action): ?>
                <?php $_permission = $record->getPermission($_action->name) ?>
                <tr>
                    <td>
                        <!-- permission on domain -->
                        <input
                            type="hidden"
                            name="dialog[ownPermission][<?php echo $_action->getId() ?>][type]"
                            value="<?php echo $_permission->getMeta('type') ?>" />
                        <input
                            type="hidden"
                            name="dialog[ownPermission][<?php echo $_action->getId() ?>][id]"
                            value="<?php echo $_permission->getId() ?>" />
                        <input
                            type="hidden"
                            name="dialog[ownPermission][<?php echo $_action->getId() ?>][method]"
                            value="<?php echo $_action->name ?>" />
                        <?php echo I18n::__("action_{$_action->name}") ?>
                    </td>
                    <?php foreach ($_roles as $_role_id => $_role): ?>
                    <td>
                        <input
                            type="hidden"
                            name="dialog[ownPermission][<?php echo $_action->getId() ?>][sharedRole][<?php echo $_role->getId() ?>][type]"
                            value="role" />                
                        <input
                            type="hidden"
                            name="dialog[ownPermission][<?php echo $_action->getId() ?>][sharedRole][<?php echo $_role->getId() ?>][id]"
                            value="0" />
                        <input
                            type="checkbox"
                            name="dialog[ownPermission][<?php echo $_action->getId() ?>][sharedRole][<?php echo $_role->getId() ?>][id]"
                            value="<?php echo $_role->getId() ?>"
                            <?php echo (isset($_permission->sharedRole[$_role->getId()])) ? 'checked="checked"' : '' ?> />
                    </td>
                    <?php endforeach ?>
                </tr>
        <?php endforeach ?>
            </tbody>
        </table>
    </fieldset>
    <fieldset
        id="domain-translation"
        class="tab"
        style="display: none;">
        <legend class="verbose"><?php echo I18n::__('tokeni18n_legend') ?></legend>
        <?php foreach (R::findAll('language') as $_id => $_language): ?>
            <?php $_tokeni18n = $record->i18n($_language->iso) ?>
            <div class="row <?php echo ($_tokeni18n->hasError('name')) ? 'error' : ''; ?>">
                <input
                    type="hidden"
                    name="dialog[ownDomaini18n][<?php echo $_id ?>][type]"
                    value="domaini18n" />
                <input
                    type="hidden"
                    name="dialog[ownDomaini18n][<?php echo $_id ?>][id]"
                    value="<?php echo $_tokeni18n->getId() ?>" />
                <input
                    type="hidden"
                    name="dialog[ownDomaini18n][<?php echo $_id ?>][language]"
                    value="<?php echo $_tokeni18n->language ?>" />
                <label
                    for="translation-<?php echo $_language->iso ?>-<?php echo $_tokeni18n->getId() ?>">
                    <?php echo I18n::__('language_'.$_tokeni18n->language) ?>
                </label>
                <textarea
                    id="translation-<?php echo $_language->iso ?>-<?php echo $_tokeni18n->getId() ?>"
                    class="scaleable"
                    name="dialog[ownDomaini18n][<?php echo $_id ?>][name]"
                    cols="60"
                    rows="2"><?php echo htmlspecialchars($_tokeni18n->name) ?></textarea>
            </div>
        <?php endforeach ?>
    </fieldset>
</div>
<!-- end of domain edit form -->