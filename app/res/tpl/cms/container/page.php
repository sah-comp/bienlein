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
<?php
$regionsAssoc = array();
foreach ($regions = $page->template->ownRegion as $_region_id => $_region) {
    $regionAssoc['page-region-'.$_region_id] = ucfirst(strtolower($_region->name));
}
$firstRegion = reset($regions);
?>
<div
    class="tab-container">
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'page-tabs',
        'tabs' =>  $regionAssoc + array('page-meta' => I18n::__('page_meta_tab')),
        'default_tab' => 'page-region-'.$firstRegion->getId()
    )) ?>
    <?php foreach ($regions as $_region_id => $_region): ?>
    <div
        id="page-region-<?php echo $_region->getId() ?>"
        class="tab"
        style="display: <?php echo ($_region_id == $firstRegion->getId()) ? 'block' : 'none' ?>;">
        Region <?php echo $_region ?>
    </div>
    <?php endforeach; ?>
    <div
        id="page-meta"
        class="tab"
        style="display: none;">
        Meta
    </div>
</div>
<script>
    $("#page-tabs").idTabs();
</script>