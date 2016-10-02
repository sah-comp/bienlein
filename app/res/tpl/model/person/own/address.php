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
<!-- address edit subform -->
<fieldset
    id="person-<?php echo $record->getId() ?>-ownaddress-<?php echo $index ?>">
    <legend class="verbose"><?php echo I18n::__('person_legend_address') ?></legend>
    <a
    	href="<?php echo Url::build(sprintf('/admin/person/detach/address/%d', $_address->getId())) ?>"
    	class="ir detach"
    	title="<?php echo I18n::__('scaffold_detach') ?>"
    	data-target="person-<?php echo $record->getId() ?>-ownaddress-<?php echo $index ?>">
    		<?php echo I18n::__('scaffold_detach') ?>
    </a>
    <a
    	href="<?php echo Url::build(sprintf('/admin/person/attach/own/address/%d', $record->getId())) ?>"
    	class="ir attach"
    	title="<?php echo I18n::__('scaffold_attach') ?>"
    	data-target="person-<?php echo $record->getId() ?>-address-container">
    		<?php echo I18n::__('scaffold_attach') ?>
    </a>
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
        for="person-<?php echo $record->getId() ?>-address-<?php echo $index ?>-label">
        <?php echo I18n::__('address_label_label') ?>
    </label>
    <select
        id="person-<?php echo $record->getId() ?>-address-<?php echo $index ?>-label"
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
        for="person-<?php echo $record->getId() ?>-address-<?php echo $index ?>-street">
        <?php echo I18n::__('address_label_street') ?>
    </label>
    <textarea
        id="person-<?php echo $record->getId() ?>-address-<?php echo $index ?>-street"
        name="dialog[ownAddress][<?php echo $index ?>][street]"
        rows="3"
        cols="60"><?php echo htmlspecialchars($_address->street) ?></textarea>
</div>
<div class="row <?php echo ($_address->hasError('zip')) ? 'error' : ''; ?>">
    <label
        for="person-<?php echo $record->getId() ?>-address-<?php echo $index ?>-zip">
        <?php echo I18n::__('address_label_zip') ?>
    </label>
    <input
        type="text"
        id="person-<?php echo $record->getId() ?>-address-<?php echo $index ?>-zip"
        name="dialog[ownAddress][<?php echo $index ?>][zip]"
        value="<?php echo htmlspecialchars($_address->zip) ?>" />
</div>
<div class="row <?php echo ($_address->hasError('city')) ? 'error' : ''; ?>">
    <label
        for="person-<?php echo $record->getId() ?>-address-<?php echo $index ?>-city">
        <?php echo I18n::__('address_label_city') ?>
    </label>
    <input
        type="text"
        id="person-<?php echo $record->getId() ?>-address-<?php echo $index ?>-city"
        name="dialog[ownAddress][<?php echo $index ?>][city]"
        value="<?php echo htmlspecialchars($_address->city) ?>" />
</div>
<div class="row <?php echo ($_address->hasError('county')) ? 'error' : ''; ?>">
    <label
        for="person-<?php echo $record->getId() ?>-address-<?php echo $index ?>-county">
        <?php echo I18n::__('address_label_county') ?>
    </label>
    <input
        type="text"
        id="person-<?php echo $record->getId() ?>-address-<?php echo $index ?>-county"
        name="dialog[ownAddress][<?php echo $index ?>][county]"
        value="<?php echo htmlspecialchars($_address->county) ?>" />
</div>
<div class="row <?php echo ($_address->hasError('country_id')) ? 'error' : ''; ?>">
    <label
        for="person-<?php echo $record->getId() ?>-address-<?php echo $index ?>-country">
        <?php echo I18n::__('address_label_country') ?>
    </label>
    <select
        id="person-<?php echo $record->getId() ?>-address-<?php echo $index ?>-country"
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
</fieldset>

<!-- /address edit subform -->
