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
<!-- person edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('person_legend') ?></legend>
    <!-- grid based header -->
    <div class="row nomargins">
        <div class="span3">&nbsp;</div>
        <div class="span3">
            <label
                for="person-nickname"
                class="<?php echo ($record->hasError('nickname')) ? 'error' : ''; ?>">
                <?php echo I18n::__('person_label_nickname') ?>
            </label>
        </div>
        <div class="span2">
            <label
                for="person-language"
                class="<?php echo ($record->hasError('language')) ? 'error' : ''; ?>">
                <?php echo I18n::__('person_label_language') ?>
            </label>
        </div>
        <div class="span2">
            <label
                for="person-account"
                class="<?php echo ($record->hasError('account')) ? 'error' : ''; ?>">
                <?php echo I18n::__('person_label_account') ?>
            </label>
        </div>
        <div class="span2">
            <label
                for="person-vatid"
                class="<?php echo ($record->hasError('vatid')) ? 'error' : ''; ?>">
                <?php echo I18n::__('person_label_vatid') ?>
            </label>
        </div>
    </div>
    <!-- end of grid based header -->
    <!-- grid based data -->
    <div class="row">
        <div class="span3">&nbsp;</div>
        <div class="span3">
            <input
                id="person-nickname"
                class="autowidth"
                type="text"
                name="dialog[nickname]"
                placeholder="<?php echo I18n::__('person_placeholder_nickname') ?>"
                value="<?php echo htmlspecialchars($record->nickname) ?>"
                required="required" />
        </div>
        <div class="span2">
            <select
                id="person-language"
                name="dialog[language]">
                <?php foreach (R::findAll('language') as $_lang_id => $_lang): ?>
                <option
                    value="<?php echo $_lang->iso ?>"
                    <?php echo ($record->language == $_lang->iso) ? 'selected="selected"' : '' ?>>
                    <?php echo htmlspecialchars($_lang->name) ?>
                </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="span2">
            <input
                id="person-account"
                class="autowidth"
                type="text"
                name="dialog[account]"
                value="<?php echo htmlspecialchars($record->account) ?>" />
        </div>
        <div class="span2">
            <input
                id="person-vatid"
                class="autowidth"
                type="text"
                name="dialog[vatid]"
                value="<?php echo htmlspecialchars($record->vatid) ?>" />
        </div>
    </div>
    <!-- end of grid based data -->
</fieldset>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('person_legend_email') ?></legend>
    <div class="row <?php echo ($record->hasError('email')) ? 'error' : ''; ?>">
        <label
            for="person-email">
            <?php echo I18n::__('person_label_email') ?>
        </label>
        <input
            id="person-email"
            type="email"
            name="dialog[email]"
            value="<?php echo htmlspecialchars($record->email) ?>" />
    </div>
</fieldset>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('person_legend_name') ?></legend>
    <div class="row <?php echo ($record->hasError('attention')) ? 'error' : ''; ?>">
        <label
            for="person-attention">
            <?php echo I18n::__('person_label_attention') ?>
        </label>
        <input
            id="person-attention"
            type="text"
            name="dialog[attention]"
            value="<?php echo htmlspecialchars($record->attention) ?>" />
    </div>
    <div class="row <?php echo ($record->hasError('title')) ? 'error' : ''; ?>">
        <label
            for="person-title">
            <?php echo I18n::__('person_label_title') ?>
        </label>
        <input
            id="person-title"
            type="text"
            name="dialog[title]"
            value="<?php echo htmlspecialchars($record->title) ?>" />
    </div>
    <div class="row <?php echo ($record->hasError('firstname')) ? 'error' : ''; ?>">
        <label
            for="person-firstname">
            <?php echo I18n::__('person_label_firstname') ?>
        </label>
        <input
            id="person-firstname"
            type="text"
            name="dialog[firstname]"
            value="<?php echo htmlspecialchars($record->firstname) ?>" />
    </div>
    <div class="row <?php echo ($record->hasError('lastname')) ? 'error' : ''; ?>">
        <label
            for="person-lastname">
            <?php echo I18n::__('person_label_lastname') ?>
        </label>
        <input
            id="person-lastname"
            type="text"
            name="dialog[lastname]"
            value="<?php echo htmlspecialchars($record->lastname) ?>" />
    </div>
    <div class="row <?php echo ($record->hasError('suffix')) ? 'error' : ''; ?>">
        <label
            for="person-suffix">
            <?php echo I18n::__('person_label_suffix') ?>
        </label>
        <input
            id="person-suffix"
            type="text"
            name="dialog[suffix]"
            value="<?php echo htmlspecialchars($record->suffix) ?>" />
    </div>
</fieldset>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('person_legend_organization') ?></legend>
    <div class="row <?php echo ($record->hasError('organization')) ? 'error' : ''; ?>">
        <label
            for="person-organization">
            <?php echo I18n::__('person_label_organization') ?>
        </label>
        <textarea
            id="person-organization"
            name="dialog[organization]"
            rows="3"
            cols="60"><?php echo htmlspecialchars($record->organization) ?></textarea>
    </div>
    <div class="row <?php echo ($record->hasError('company')) ? 'error' : ''; ?>">
        <label
            for="person-company"
            class="cb">
            <?php echo I18n::__('person_label_company') ?>
        </label>
        <input
            type="hidden"
            name="dialog[company]"
            value="0" />
        <input
            id="person-company"
            type="checkbox"
            name="dialog[company]"
            <?php echo ($record->company) ? 'checked="checked"' : '' ?>
            value="1" />
    </div>
    <div class="row <?php echo ($record->hasError('jobtitle')) ? 'error' : ''; ?>">
        <label
            for="person-jobtitle">
            <?php echo I18n::__('person_label_jobtitle') ?>
        </label>
        <input
            id="person-jobtitle"
            type="text"
            name="dialog[jobtitle]"
            value="<?php echo htmlspecialchars($record->jobtitle) ?>" />
    </div>
    <div class="row <?php echo ($record->hasError('department')) ? 'error' : ''; ?>">
        <label
            for="person-department">
            <?php echo I18n::__('person_label_department') ?>
        </label>
        <input
            id="person-department"
            type="text"
            name="dialog[department]"
            value="<?php echo htmlspecialchars($record->department) ?>" />
    </div>
</fieldset>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('person_legend_phone') ?></legend>
    <div class="row <?php echo ($record->hasError('phone')) ? 'error' : ''; ?>">
        <label
            for="person-phone">
            <?php echo I18n::__('person_label_phone') ?>
        </label>
        <input
            id="person-phone"
            type="text"
            name="dialog[phone]"
            value="<?php echo htmlspecialchars($record->phone) ?>" />
    </div>
    <div class="row <?php echo ($record->hasError('fax')) ? 'error' : ''; ?>">
        <label
            for="person-fax">
            <?php echo I18n::__('person_label_fax') ?>
        </label>
        <input
            id="person-fax"
            type="text"
            name="dialog[fax]"
            value="<?php echo htmlspecialchars($record->fax) ?>" />
    </div>
</fieldset>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('person_legend_url') ?></legend>
    <div class="row <?php echo ($record->hasError('url')) ? 'error' : ''; ?>">
        <label
            for="person-url">
            <?php echo I18n::__('person_label_url') ?>
        </label>
        <input
            id="person-url"
            type="text"
            name="dialog[url]"
            value="<?php echo htmlspecialchars($record->url) ?>" />
    </div>
</fieldset>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('person_legend_address') ?></legend>
    <?php $record->ownAddress[] = R::dispense('address') ?>
    <?php $index = 0 ?>
    <?php foreach ($record->ownAddress as $_address_id => $_address): ?>
    <?php $index++ ?>
    <div>
        <input
            type="hidden"
            name="dialog[ownAddress][<?php echo $index ?>][type]"
            value="<?php echo $_address->getMeta('type') ?>" />
        <input
            type="hidden"
            name="dialog[ownAddress][<?php echo $index ?>][id]"
            value="<?php echo $_address->getId() ?>" />
    </div>
    <div class="row <?php echo ($_address->hasError('label')) ? 'error' : ''; ?>">
        <label
            for="person-<?php echo $record->getId() ?>-address-<?php echo $_address->getId() ?>-label">
            <?php echo I18n::__('address_label_label') ?>
        </label>
        <select
            id="person-<?php echo $record->getId() ?>-address-<?php echo $_address->getId() ?>-label"
            name="dialog[ownAddress][<?php echo $index ?>][label]">
            <option value=""><?php echo I18n::__('address_label_select') ?></option>
            <?php foreach ($_address->getLabels() as $_label): ?>
            <option
                value="<?php echo $_label ?>"
                <?php echo ($_address->label == $_label) ? 'selected="selected"' : '' ?>>
                <?php echo I18n::__('address_label_'.$_label) ?>
            </option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="row <?php echo ($_address->hasError('street')) ? 'error' : ''; ?>">
        <label
            for="person-<?php echo $record->getId() ?>-address-<?php echo $_address->getId() ?>-street">
            <?php echo I18n::__('address_label_street') ?>
        </label>
        <textarea
            id="person-<?php echo $record->getId() ?>-address-<?php echo $_address->getId() ?>-street"
            name="dialog[ownAddress][<?php echo $index ?>][street]"
            rows="3"
            cols="60"><?php echo htmlspecialchars($_address->street) ?></textarea>
    </div>
    <div class="row <?php echo ($_address->hasError('zip')) ? 'error' : ''; ?>">
        <label
            for="person-<?php echo $record->getId() ?>-address-<?php echo $_address->getId() ?>-zip">
            <?php echo I18n::__('address_label_zip') ?>
        </label>
        <input
            type="text"
            id="person-<?php echo $record->getId() ?>-address-<?php echo $_address->getId() ?>-zip"
            name="dialog[ownAddress][<?php echo $index ?>][zip]"
            value="<?php echo htmlspecialchars($_address->zip) ?>" />
    </div>
    <div class="row <?php echo ($_address->hasError('city')) ? 'error' : ''; ?>">
        <label
            for="person-<?php echo $record->getId() ?>-address-<?php echo $_address->getId() ?>-city">
            <?php echo I18n::__('address_label_city') ?>
        </label>
        <input
            type="text"
            id="person-<?php echo $record->getId() ?>-address-<?php echo $_address->getId() ?>-city"
            name="dialog[ownAddress][<?php echo $index ?>][city]"
            value="<?php echo htmlspecialchars($_address->city) ?>" />
    </div>
    <div class="row <?php echo ($_address->hasError('county')) ? 'error' : ''; ?>">
        <label
            for="person-<?php echo $record->getId() ?>-address-<?php echo $_address->getId() ?>-county">
            <?php echo I18n::__('address_label_county') ?>
        </label>
        <input
            type="text"
            id="person-<?php echo $record->getId() ?>-address-<?php echo $_address->getId() ?>-county"
            name="dialog[ownAddress][<?php echo $index ?>][county]"
            value="<?php echo htmlspecialchars($_address->county) ?>" />
    </div>
    <div class="row <?php echo ($_address->hasError('country_id')) ? 'error' : ''; ?>">
        <label
            for="person-<?php echo $record->getId() ?>-address-<?php echo $_address->getId() ?>-country">
            <?php echo I18n::__('address_label_country') ?>
        </label>
        <select
            id="person-<?php echo $record->getId() ?>-address-<?php echo $_address->getId() ?>-country"
            name="dialog[ownAddress][<?php echo $index ?>][country_id]">
            <option value=""><?php echo I18n::__('address_country_select') ?></option>
            <?php foreach (R::findAll('country') as $_country_id => $_country): ?>
            <option
                value="<?php echo $_country->getId() ?>"
                <?php echo ($_address->country_id == $_country->getId()) ? 'selected="selected"' : '' ?>>
                <?php echo htmlspecialchars($_country->name) ?>
            </option>
            <?php endforeach ?>
        </select>
    </div>
    <?php endforeach ?>
</fieldset>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('person_legend_role') ?></legend>
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
            for="person-<?php echo $record->getId() ?>-role-<?php echo $_role->getId() ?>"
            class="cb"><?php echo htmlspecialchars($_role->i18n(Flight::get('language'))->name) ?></label>
        <input
            type="checkbox"
            id="person-<?php echo $record->getId() ?>-role-<?php echo $_role->getId() ?>"
            name="dialog[sharedRole][<?php echo $_role->getId() ?>][id]"
            value="<?php echo $_role->getId() ?>"
            <?php echo (isset($record->sharedRole[$_role->getId()])) ? 'checked="checked"' : '' ?> />
    </div>
    <?php endforeach ?>
</fieldset>
<!-- end of person edit form -->