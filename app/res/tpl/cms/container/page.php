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
<?php if ( ! $page->getId()): ?>
<p class="page-choose"><?php echo I18n::__('cms_add_page') ?></p>
<?php return; ?>
<?php endif ?>
<?php
$regionsAssoc = array();
foreach ($regions = $page->template->ownRegion as $_region_id => $_region) {
    $regionAssoc['page-region-'.$_region_id] = ucfirst(strtolower($_region->name));
}
$firstRegion = reset($regions);
$default_tab = 'page-region-'.$firstRegion->getId();
if (isset($trigger_meta) && $trigger_meta) $default_tab = 'page-meta';
?>
<div
    class="tab-container">
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'page-tabs',
        'tabs' =>  $regionAssoc + array('page-meta' => I18n::__('page_meta_tab')),
        'default_tab' => $default_tab
    )) ?>
    <!-- page regions -->
    <?php foreach ($regions as $_region_id => $_region): ?>
    <div
        id="page-region-<?php echo $_region->getId() ?>"
        class="tab"
        style="display: <?php echo ($_region_id == $firstRegion->getId()) ? 'block' : 'none' ?>;">
        <!-- page region slices -->
        <div
            id="page-region-<?php echo $_region->getId() ?>-slices"
            class="slices-container"
            data-href="<?php echo Url::build('/cms/sortable/slice/slice/') ?>"
            data-container="page-region-<?php echo $_region->getId() ?>-slices"
            data-variable="slice">
            <?php foreach ($page->getSlicesByRegion($_region_id, false) as $_slice_id => $_slice): ?>
            <!-- slice -->
            <div
                id="slice-<?php echo $_slice->getId() ?>"
                class="slice-container"
                data-href="<?php echo Url::build('/cms/slice/%d', array($_slice->getId())) ?>"
                data-container="slice-<?php echo $_slice->getId() ?>">
                <?php echo $_slice->render('frontend') ?>
            </div>
            <!-- end of slice -->
            <?php endforeach ?>
        </div>
        <!-- end of page region slices -->
        <!-- add a new slice -->
        <form
            id="form-page-region-<?php echo $_region_id ?>-slice-new"
            data-container="page-region-<?php echo $_region->getId() ?>-slices"
            class="inline-add slice"
            method="POST"
            action="<?php echo Url::build('/cms/add/slice/') ?>"
            accept-charset="utf-8"
            enctype="multipart/form-data">
            <div>
                <input type="hidden" name="dialog[type]" value="slice" />
                <input type="hidden" name="dialog[id]" value="0" />
                <input type="hidden" name="dialog[region_id]" value="<?php echo $_region_id ?>" />
                <input type="hidden" name="dialog[page_id]" value="<?php echo $page->getId() ?>" />
            </div>
            <fieldset>
                <legend class="verbose"><?php echo I18n::__('module_legend_choose_module') ?></legend>
                <div class="row">
                    <select
                        name="dialog[module]">
                        <option value=""><?php echo I18n::__('slice_module_select') ?></option>
                        <?php foreach (R::find('module', ' enabled = ?', array(true)) as $_id => $_module): ?>
                        <option
                            value="<?php echo $_module->name ?>">
                            <?php echo I18n::__('module_'.$_module->name) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </fieldset>
            <div class="buttons">
                <input
                    type="submit"
                    name="submit"
                    value="<?php echo I18n::__('module_submit_choose') ?>" />
            </div>
        </form>
        <!-- end of new slice -->
    </div>
    <script>
        $("#page-region-<?php echo $_region->getId() ?>-slices").sortable({
            items: "> div",
            axis: "y",
            helper: "clone",
            placeholder: "ui-state-highlight",
            opacity: ".8",
            start: function(event, ui) {
                $(ui.item).show();
            },
            update: function(event, ui) {
                var url = $(this).attr("data-href");
                var container = $(this).attr("data-container");
                var sequence = $("#"+container).sortable("serialize");
                $.get(url + "?" + sequence);
            } 
        });
    </script>
    <?php endforeach; ?>
    <!-- end of page regions -->
    <!-- page meta -->
    <div
        id="page-meta"
        class="tab"
        style="display: none;">
        <!-- page meta information -->
        <?php echo $page_meta ?>
        <!-- end of page meta -->
    </div>
    <!-- end of page meta -->
</div>
<script>
    $("#page-tabs").idTabs("page-meta");
    <?php if (isset($trigger_meta) && $trigger_meta): ?>
    $("#page-name").focus();
    <?php endif; ?>
</script>
