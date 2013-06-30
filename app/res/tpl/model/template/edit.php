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
<!-- template edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('template_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="template-name">
            <?php echo I18n::__('template_label_name') ?>
        </label>
        <input
            id="template-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
</fieldset>
<div class="tab-container">
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'template-tabs',
        'tabs' => array(
            'template-region' => I18n::__('template_region_tab')
        ),
        'default_tab' => 'template-region'
    )) ?>
    <fieldset
        id="template-region"
        class="tab">
        <legend class="verbose"><?php echo I18n::__('region_legend') ?></legend>
        <?php $record->ownRegion[] = R::dispense('region') ?>
        <?php $_index = 0 ?>
        <?php foreach ($record->ownRegion as $_region_id => $_region): ?>
        <?php $_index++ ?>
        <div
            id="template-<?php echo $record->getId() ?>-region-<?php echo $_region->getId() ?>"
            class="container">
            
            <?php if ($_region->getId()): ?>
            <a
                href="#detach"
        		class="ir detach"
        		data-target="template-<?php echo $record->getId() ?>-region-<?php echo $_region->getId() ?>">
                <?php echo I18n::__('scaffold_detach_linktext') ?>
        	</a>
        	<?php else: ?>
        	<input
        	    type="submit"
        	    name="submit"
        	    class="ir attach"
        	    value="<?php echo I18n::__('scaffold_attach_linktext') ?>" />
            <?php endif ?>
            
            <div
                class="row">
                <input type="hidden" name="dialog[ownRegion][<?php echo $_region_id ?>][type]" value="region" />
                <input type="hidden" name="dialog[ownRegion][<?php echo $_region_id ?>][id]" value="<?php echo $_region->getId() ?>" />
                <label
                    for="region-<?php echo $_region_id ?>-name">
                    <?php echo I18n::__('region_label_name', null, array($_index)) ?>
                </label>
                <input
                    id="region-<?php echo $_region_id ?>-name"
                    type="text"
                    name="dialog[ownRegion][<?php echo $_region_id ?>][name]"
                    value="<?php echo htmlspecialchars($_region->name) ?>"
                    required="required" />
            </div>
        </div>
        <?php endforeach ?>
    </fieldset>
</div>
<!-- end of template edit form -->