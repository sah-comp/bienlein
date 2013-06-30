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
<!-- edit user form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
    <input type="hidden" name="dialog[pw]" value="<?php echo htmlspecialchars($record->pw) ?>" />
</div>
<fieldset>
    <legend><?php echo I18n::__('user_legend') ?></legend>
    <div
        class="row <?php echo $record->hasError('name') ? 'error' : '' ?>">
        <label
            for="user-name">
            <?php echo I18n::__('user_label_name') ?>
        </label>
        <input
            type="text"
            id="user-name"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
    <div
        class="row <?php echo $record->hasError('email') ? 'error' : '' ?>">
        <label
            for="user-email">
            <?php echo I18n::__('user_label_email') ?>
        </label>
        <input
            type="email"
            id="user-email"
            name="dialog[email]"
            value="<?php echo htmlspecialchars($record->email) ?>"
            required="required" />
    </div>
    <div
        class="row <?php echo $record->hasError('shortname') ? 'error' : '' ?>">
        <label
            for="user-shortname">
            <?php echo I18n::__('user_label_shortname') ?>
        </label>
        <input
            type="text"
            id="user-shortname"
            name="dialog[shortname]"
            value="<?php echo htmlspecialchars($record->shortname) ?>"
            required="required" />
    </div>
    <div
        class="row <?php echo $record->hasError('isadmin') ? 'error' : '' ?>">
        <input
            type="hidden"
            name="dialog[isadmin]"
            value="0" />
        <label
            for="user-isadmin"
            class="cb">
            <?php echo I18n::__('user_label_isadmin') ?>
        </label>
        <input
            id="user-isadmin"
            type="checkbox"
            name="dialog[isadmin]"
            <?php echo ($record->isadmin) ? 'checked="checked"' : '' ?>
            value="1" />
    </div>
</fieldset>
<div class="tab-container">
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'user-tabs',
        'tabs' => array(
            'user-setting' => I18n::__('user_setting_tab'),
            'user-role' => I18n::__('user_role_tab'),
            'user-team' => I18n::__('user_team_tab')
        ),
        'default_tab' => 'user-setting'
    )) ?>
    <fieldset
        id="user-setting"
        class="tab"
        style="display: block;">
        <legend><?php echo I18n::__('user_legend_setting') ?></legend>
        <div
            class="row <?php echo $record->hasError('isbanned') ? 'error' : '' ?>">
            <input
                type="hidden"
                name="dialog[isbanned]"
                value="0" />
            <label
                for="user-isbanned"
                class="cb">
                <?php echo I18n::__('user_label_isbanned') ?>
            </label>
            <input
                id="user-isbanned"
                type="checkbox"
                name="dialog[isbanned]"
                <?php echo ($record->isbanned) ? 'checked="checked"' : '' ?>
                value="1" />
        </div>
        <div
            class="row <?php echo $record->hasError('isdeleted') ? 'error' : '' ?>">
            <input
                type="hidden"
                name="dialog[isdeleted]"
                value="0" />
            <label
                for="user-isdeleted"
                class="cb">
                <?php echo I18n::__('user_label_isdeleted') ?>
            </label>
            <input
                id="user-isdeleted"
                type="checkbox"
                name="dialog[isdeleted]"
                <?php echo ($record->isdeleted) ? 'checked="checked"' : '' ?>
                value="1" />
        </div>
    </fieldset>
    <fieldset
        id="user-team"
        class="tab"
        style="display: none;">
        <legend class="verbose"><?php echo I18n::__('user_legend_team') ?></legend>
        <?php foreach (R::findAll('team') as $_id => $_team): ?>
        <div class="row">
            <input
                type="hidden"
                name="dialog[sharedTeam][<?php echo $_team->getId() ?>][type]"
                value="team" />
            <input
                type="hidden"
                name="dialog[sharedTeam][<?php echo $_team->getId() ?>][id]"
                value="0" />
            <label
                for="user-team-<?php echo $_team->getId() ?>"
                class="cb"><?php echo htmlspecialchars($_team->i18n(Flight::get('language'))->name) ?></label>
            <input
                type="checkbox"
                id="user-team-<?php echo $_team->getId() ?>"
                name="dialog[sharedTeam][<?php echo $_team->getId() ?>][id]"
                value="<?php echo $_team->getId() ?>"
                <?php echo (isset($record->sharedTeam[$_team->getId()])) ? 'checked="checked"' : '' ?> />
        </div>
        <?php endforeach ?>
    </fieldset>
    <fieldset
        id="user-role"
        class="tab"      
        style="display: none;">
        <legend class="verbose"><?php echo I18n::__('user_legend_role') ?></legend>
        <?php foreach (R::findAll('role') as $_id => $_role): ?>
        <div class="row">
            <input
                type="hidden"
                name="dialog[sharedRole][<?php echo $_role->getId() ?>][type]"
                value="role" />
            <input
                type="hidden"
                name="dialog[sharedRole][<?php echo $_role->getId() ?>][id]"
                value="0" />
            <label
                for="user-role-<?php echo $_role->getId() ?>"
                class="cb"><?php echo htmlspecialchars($_role->i18n(Flight::get('language'))->name) ?></label>
            <input
                type="checkbox"
                id="user-role-<?php echo $_role->getId() ?>"
                name="dialog[sharedRole][<?php echo $_role->getId() ?>][id]"
                value="<?php echo $_role->getId() ?>"
                <?php echo (isset($record->sharedRole[$_role->getId()])) ? 'checked="checked"' : '' ?> />
        </div>
        <?php endforeach ?>
    </fieldset>
</div>
<!-- End of edit user form -->
