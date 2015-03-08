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
<!-- region edit subform -->
<fieldset
    id="template-<?php echo $record->getId() ?>-ownregion-<?php echo $index ?>">
    <legend class="verbose"><?php echo I18n::__('template_legend_region') ?></legend>
    <a
    	href="<?php echo Url::build(sprintf('/admin/template/detach/region/%d', $index)) ?>"
    	class="ir detach"
    	title="<?php echo I18n::__('scaffold_detach') ?>"
    	data-target="template-<?php echo $record->getId() ?>-ownregion-<?php echo $index ?>">
    		<?php echo I18n::__('scaffold_detach') ?>
    </a>
    <a
    	href="<?php echo Url::build(sprintf('/admin/template/attach/own/region/%d', $record->getId())) ?>"
    	class="ir attach"
    	title="<?php echo I18n::__('scaffold_attach') ?>"
    	data-target="template-<?php echo $record->getId() ?>-region-container">
    		<?php echo I18n::__('scaffold_attach') ?>
    </a>
    <div>
        <input
            type="hidden"
            name="dialog[ownRegion][<?php echo $index ?>][type]"
            value="<?php echo $_region->getMeta('type') ?>" />
        <input
            type="hidden"
            name="dialog[ownRegion][<?php echo $index ?>][id]"
            value="<?php echo $_region->getId() ?>" />
    </div>
    <div
        class="row">
        <label
            for="template-<?php echo $record->getId() ?>-region-<?php echo $index ?>-name">
            <?php echo I18n::__('region_label_name', null, array($index)) ?>
        </label>
        <input
            id="template-<?php echo $record->getId() ?>-region-<?php echo $index ?>-name"
            type="text"
            name="dialog[ownRegion][<?php echo $index ?>][name]"
            value="<?php echo htmlspecialchars($_region->name) ?>" />
    </div>
</fieldset>

<!-- /region edit subform -->
