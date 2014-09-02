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
            

            <div class="span3">
                &nbsp;
            </div>
            <div class="span1">
                <?php echo I18n::__('limb_label_active') ?>
            </div>
            <div class="span1">
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
        
        <div
            id="person-<?php echo $record->getId() ?>-address-container"
            class="container attachable detachable sortable">

        <?php $_limbs = $record->with(' ORDER BY sequence ASC ')->ownLimb ?>
        <?php if (count($_limbs) == 0) $_limbs[] = R::dispense('limb') ?>
        <?php $index = 0 ?>
        <?php foreach ($_limbs as $_limb_id => $_limb): ?>
        <?php $index++ ?>
        <?php Flight::render('model/gestalt/own/limb', array(
            'record' => $record,
            '_limb' => $_limb,
            'index' => $index
        )) ?>
        <?php endforeach ?>
        </div>
    </fieldset>
</div>
<!-- end of gestalt edit form -->