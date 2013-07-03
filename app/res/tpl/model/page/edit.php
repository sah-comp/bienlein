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
<!-- page edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
    <input type="hidden" name="dialog[language]" value="<?php echo $record->language ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('page_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="page-name">
            <?php echo I18n::__('page_label_name') ?>
        </label>
        <input
            id="page-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
</fieldset>
<div
    class="tab-container"> 
    <?php
    $regionsAssoc = array();
    foreach ($regions = $record->template->ownRegion as $_region_id => $_region) {
        $regionAssoc['page-region-'.$_region_id] = ucfirst(strtolower($_region->name));
    }
    $firstRegion = reset($regions);
    ?> 
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'page-tabs',
        'tabs' =>  $regionAssoc + array('page-meta' => I18n::__('page_meta_tab')),
        'default_tab' => 'page-region-'.$firstRegion->getId()
    )) ?>
    <?php foreach ($regions as $_region_id => $_region): ?>
    <fieldset
        id="page-region-<?php echo $_region->getId() ?>"
        class="tab"
        style="display: <?php echo ($_region_id == $firstRegion->getId()) ? 'block' : 'none' ?>;">
        <legend><?php echo I18n::__('page_legend_region') ?></legend>
        <?php $sequence = 0 ?>
        <?php foreach ($record->getSlicesByRegion($_region_id, true) as $_slice_id => $_slice): ?>
        <?php $sequence++ ?>
        <div
            id="region-<?php echo $_region_id ?>-slice-<?php echo $_slice->getId() ?>"
            class="container">
            
            <?php if ($_slice->getId()): ?>
            <a
                href="#detach"
        		class="ir detach"
        		data-target="region-<?php echo $_region_id ?>-slice-<?php echo $_slice->getId() ?>">
                <?php echo I18n::__('scaffold_detach_linktext') ?>
        	</a>
        	<?php else: ?>
        	<input
        	    type="submit"
        	    name="submit"
        	    class="ir attach"
        	    value="<?php echo I18n::__('scaffold_attach_linktext') ?>" />
            <?php endif ?>
            
            <input
                type="hidden"
                name="dialog[ownSlice][<?php echo $_region_id.'-'.$_slice_id ?>][type]"
                value="<?php echo $_slice->getMeta('type') ?>" />
            <input
                type="hidden"
                name="dialog[ownSlice][<?php echo $_region_id.'-'.$_slice_id ?>][id]"
                value="<?php echo $_slice->getId() ?>" />
            <input
                type="hidden"
                name="dialog[ownSlice][<?php echo $_region_id.'-'.$_slice_id ?>][region_id]"
                value="<?php echo $_region_id ?>" />
            <input
                type="hidden"
                name="dialog[ownSlice][<?php echo $_region_id.'-'.$_slice_id ?>][sequence]"
                value="<?php echo $sequence ?>" />
                
            <div
                class="row">            
                <div class="span3">
                    <select
                        name="dialog[ownSlice][<?php echo $_region_id.'-'.$_slice_id ?>][module]">
                        <option value=""><?php echo I18n::__('slice_module_select') ?></option>
                        <?php foreach (R::find('module', ' enabled = ?', array(true)) as $_id => $_module): ?>
                        <option
                            value="<?php echo $_module->name ?>"
                            <?php echo ($_slice->module == $_module->name) ? 'selected="selected"' : '' ?>><?php echo I18n::__('module_'.$_module->name) ?></option>   
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="span9">
                    <?php $_slice->render('backend') ?>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </fieldset>
    <?php endforeach ?>
    <fieldset
        id="page-meta"
        class="tab"
        style="display: none;">
        <legend class="verbose"><?php echo I18n::__('page_legend_meta') ?></legend>
        <div class="row <?php echo ($record->hasError('template_id')) ? 'error' : ''; ?>">
            <label
                for="page-template">
                <?php echo I18n::__('page_label_template') ?>
            </label>
            <select
                id="page-template"
                name="dialog[template_id]"
                required="required">
                <option value=""><?php echo I18n::__('page_template_none') ?></option>
                <?php foreach (R::findAll('template') as $_id => $_template): ?>
                <option
                    value="<?php echo $_template->getId() ?>"
                    <?php echo ($record->template_id == $_template->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_template->name) ?></option>   
                <?php endforeach ?>
            </select>
        </div>
        <div class="row">
            <label
                for="page-domain"
                class="<?php echo ($record->hasError('domain_id')) ? 'error' : ''; ?>">
                <?php echo I18n::__('page_label_domain') ?>
            </label>
            <select
                id="page-domain"
                name="dialog[domain_id]">
                <option value=""><?php echo I18n::__('page_domain_none') ?></option>
                <?php foreach (R::findAll('domain') as $_id => $_domain): ?>
                <option
                    value="<?php echo $_domain->getId() ?>"
                    <?php echo ($record->domain_id == $_domain->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_domain->i18n(Flight::get('language'))->name) ?></option>   
                <?php endforeach ?>
            </select>
        </div>
        <div class="row <?php echo ($record->hasError('url')) ? 'error' : ''; ?>">
            <label
                for="page-url">
                <?php echo I18n::__('page_label_url') ?>
            </label>
            <input
                id="page-url"
                type="text"
                name="dialog[url]"
                value="<?php echo htmlspecialchars($record->url) ?>" />
        </div>
        <div class="row <?php echo ($record->hasError('invisible')) ? 'error' : ''; ?>">
            <input
                type="hidden"
                name="dialog[invisible]"
                value="0" />
            <input
                id="page-invisible"
                type="checkbox"
                name="dialog[invisible]"
                <?php echo ($record->invisible) ? 'checked="checked"' : '' ?>
                value="1" />
            <label
                for="page-invisible"
                class="cb">
                <?php echo I18n::__('page_label_invisible') ?>
            </label>
        </div>
        <div class="row">
            <label
                for="page-sequence"
                class="<?php echo ($record->hasError('sequence')) ? 'error' : ''; ?>">
                <?php echo I18n::__('page_label_sequence') ?>
            </label>
            <input
                id="page-sequence"
                type="number"
                min="0"
                step="10"
                max="99999999"
                name="dialog[sequence]"
                value="<?php echo htmlspecialchars($record->sequence) ?>" />
        </div>
        <div class="row">
            <label
                for="page-keywords"
                class="<?php echo ($record->hasError('keywords')) ? 'error' : ''; ?>">
                <?php echo I18n::__('page_label_keywords') ?>
            </label>
            <textarea
                id="page-keywords"
                class="scaleable"
                name="dialog[keywords]"
                cols="60"
                rows="2"><?php echo htmlspecialchars($record->keywords) ?></textarea>
        </div>
        <div class="row">
            <label
                for="page-description"
                class="<?php echo ($record->hasError('desc')) ? 'error' : ''; ?>">
                <?php echo I18n::__('page_label_desc') ?>
            </label>
            <textarea
                id="page-description"
                class="scaleable"
                name="dialog[desc]"
                cols="60"
                rows="8"><?php echo htmlspecialchars($record->desc) ?></textarea>
        </div>
    </fieldset>
</div>
<!-- end of page edit form -->