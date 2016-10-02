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
<!-- limb edit subform -->
<fieldset
    id="gestalt-<?php echo $record->getId() ?>-ownlimb-<?php echo $index ?>">
    <legend class="verbose"><?php echo I18n::__('gestalt_legend_limb') ?></legend>
    <a
    	href="<?php echo Url::build(sprintf('/admin/gestalt/detach/address/%d', $_limb->getId())) ?>"
    	class="ir detach"
    	title="<?php echo I18n::__('scaffold_detach') ?>"
    	data-target="person-<?php echo $record->getId() ?>-ownaddress-<?php echo $index ?>">
    		<?php echo I18n::__('scaffold_detach') ?>
    </a>
    <a
    	href="<?php echo Url::build(sprintf('/admin/gestalt/attach/own/limb/%d', $record->getId())) ?>"
    	class="ir attach"
    	title="<?php echo I18n::__('scaffold_attach') ?>"
    	data-target="person-<?php echo $record->getId() ?>-address-container">
    		<?php echo I18n::__('scaffold_attach') ?>
    </a>

    <div>                
        <input
            type="hidden"
            name="dialog[ownLimb][<?php echo $index ?>][type]"
            value="<?php echo $_limb->getMeta('type') ?>" />
        <input
            type="hidden"
            name="dialog[ownLimb][<?php echo $index ?>][id]"
            value="<?php echo $_limb->getId() ?>" />
    </div>

    <div class="row">
    
        <div class="span3">
            &nbsp;
        </div>
        <div class="span1">
            <input
                type="hidden"
                name="dialog[ownLimb][<?php echo $index ?>][active]"
                value="0" />
            <input
                id="gestalt-<?php echo $record->getId() ?>-limb-<?php echo $_limb->getId() ?>-active"
                type="checkbox"
                name="dialog[ownLimb][<?php echo $index ?>][active]"
                <?php echo ($_limb->active) ? 'checked="checked"' : '' ?>
                value="1" />
        </div>
        <div class="span1">
            <input
                type="number"
                min="0"
                step="10"
                id="gestalt-<?php echo $record->getId() ?>-limb-<?php echo $_limb->getId() ?>-sequence"
                name="dialog[ownLimb][<?php echo $index ?>][sequence]"
                value="<?php echo htmlspecialchars($_limb->sequence) ?>" />
        </div>
        <div class="span2">
            <input
                type="text"
                id="gestalt-<?php echo $record->getId() ?>-limb-<?php echo $_limb->getId() ?>-name"
                name="dialog[ownLimb][<?php echo $index ?>][name]"
                value="<?php echo htmlspecialchars($_limb->name) ?>" />
        </div>
        <div class="span2">
            <select
                id="gestalt-<?php echo $record->getId() ?>-limb-<?php echo $_limb->getId() ?>-kind"
                name="dialog[ownLimb][<?php echo $index ?>][kind]">
                <option
                    value="">
                    <?php echo I18n::__('select_one_or_leave_empty') ?>
                </option>
                <?php foreach ($_limb->getKinds() as $_attr_name): ?>
                <option
                    value="<?php echo $_attr_name ?>"
                    <?php echo ($_limb->kind == $_attr_name) ? 'selected="selected"' : '' ?>>
                    <?php echo I18n::__(sprintf('limb_kind_%s', $_attr_name)) ?>
                </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="span2">
            <select
                id="gestalt-<?php echo $record->getId() ?>-limb-<?php echo $_limb->getId() ?>-tag"
                name="dialog[ownLimb][<?php echo $index ?>][tag]">
                <option
                    value="">
                    <?php echo I18n::__('select_one_or_leave_empty') ?>
                </option>
                <?php foreach ($_limb->getTags() as $_attr_name): ?>
                <option
                    value="<?php echo $_attr_name ?>"
                    <?php echo ($_limb->tag == $_attr_name) ? 'selected="selected"' : '' ?>>
                    <?php echo I18n::__(sprintf('limb_tag_%s', $_attr_name)) ?>
                </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="span1">
            <input
                type="hidden"
                name="dialog[ownLimb][<?php echo $index ?>][filter]"
                value="0" />
            <input
                id="gestalt-<?php echo $record->getId() ?>-limb-<?php echo $_limb->getId() ?>-filter"
                type="checkbox"
                name="dialog[ownLimb][<?php echo $index ?>][filter]"
                <?php echo ($_limb->filter) ? 'checked="checked"' : '' ?>
                value="1" />
        </div>

    </div>
</fieldset>
<!-- /limb edit subform -->