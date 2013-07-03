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
<div
    id="pages-list"
    class="sortable"
    data-href="<?php echo Url::build('/cms/sortable/page/page/') ?>"
    data-container="pages-list"
    data-variable="page">
<?php foreach ($pages as $_id => $_page): ?>
    <?php $_classes = array() ?>
    <?php if ($page->getId() == $_page->getId()) $_classes[] = 'active' ?>
    <?php if ($_page->invisible) $_classes[] = 'unpublished' ?>
    <div
        id="page-<?php echo $_page->getId() ?>">
        <a
            href="<?php echo Url::build('/cms/page/%d', array($_page->getId())) ?>"
            class="<?php echo implode(' ', $_classes) ?>">
            <?php echo htmlspecialchars($_page->name) ?>
        </a>
    </div>
<?php endforeach ?>
</div>
<!-- js to make the pages-list sortable -->
<script>
    $("#pages-list").sortable({
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
<!-- end of js for sortable pages -->
<!-- form to add a new page -->
<?php echo $form_addpage ?>
<!-- end of form to add a new page -->
