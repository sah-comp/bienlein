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
<!-- gestalt edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('gestalt_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="gestalt-name">
            <?php echo I18n::__('gestalt_label_name') ?>
        </label>
        <input
            id="gestalt-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('enabled')) ? 'error' : ''; ?>">
        <input
            type="hidden"
            name="dialog[enabled]"
            value="0" />
        <input
            id="gestalt-enabled"
            type="checkbox"
            name="dialog[enabled]"
            <?php echo ($record->enabled) ? 'checked="checked"' : '' ?>
            value="1" />
        <label
            for="gestalt-enabled"
            class="cb">
            <?php echo I18n::__('gestalt_label_enabled') ?>
        </label>
    </div>
    <div class="row <?php echo ($record->hasError('desc')) ? 'error' : ''; ?>">
        <label
            for="gestalt-desc">
            <?php echo I18n::__('gestalt_label_desc') ?>
        </label>
        <textarea
            id="gestalt-desc"
            name="dialog[desc]"
            rows="3"
            cols="60"><?php echo htmlspecialchars($record->desc) ?></textarea>
    </div>
</fieldset>

<div class="tab-container">
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'gestalt-tabs',
        'tabs' => array(
            'gestalt-limb' => I18n::__('gestalt_limb_tab')
        ),
        'default_tab' => 'gestalt-limb'
    )) ?>
    <fieldset
        id="gestalt-limb"
        class="tab"
        style="display: block;">
        <legend class="verbose"><?php echo I18n::__('gestalt_limb_legend') ?></legend>

        <div class="row">
            
            
            <div class="span1">
                <?php echo I18n::__('limb_label_active') ?>
            </div>
            <div class="span2">
                <?php echo I18n::__('limb_label_sequence') ?>
            </div>
            <div class="span2">
                <?php echo I18n::__('limb_label_name') ?>
            </div>
            <div class="span2">
                <?php echo I18n::__('limb_label_kind') ?>
            </div>
            <div class="span2">
                <?php echo I18n::__('limb_label_tag') ?>
            </div>
            <div class="span1">
                <?php echo I18n::__('limb_label_filter') ?>
            </div>

        </div>

        <?php $_limbs = $record->with(' ORDER BY sequence ASC ')->ownLimb ?>
        <?php $_limbs[] = R::dispense('limb') ?>
        <?php $index = 0 ?>
        <?php foreach ($_limbs as $_limb_id => $_limb): ?>
        <?php $index++ ?>
        
        <div class="row">
            
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
            <div class="span2">
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
        
        
        <?php endforeach ?>
    </fieldset>
</div>
<!-- end of gestalt edit form -->