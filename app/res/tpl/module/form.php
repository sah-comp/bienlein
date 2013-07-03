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
<form
    id="form-<?php echo $record->getMeta('type') ?>-<?php echo $record->getId() ?>"
    data-container="slice-<?php echo $record->getId() ?>"
    class="inline"
    method="POST"
    action="<?php echo Url::build('/cms/slice/%d/', array($record->getId())) ?>"
    accept-charset="utf-8"
    enctype="multipart/form-data">
    <div>
        <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
        <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
        <input type="hidden" name="dialog[region_id]" value="<?php echo $record->region_id ?>" />
        <input type="hidden" name="dialog[sequence]" value="<?php echo $record->sequence ?>" />
        <input type="hidden" name="dialog[module]" value="<?php echo $record->module ?>" />
        <input type="hidden" name="dialog[page_id]" value="<?php echo $record->page_id ?>" />
    </div>
    <?php echo $form_details ?>
    <div class="buttons">
        <!-- Ajax does not send the submit button value, so we transport with hidden field -->
        <input
            id="slice-delete"
            type="hidden"
            name="delete"
            value="0" />
        <input
            type="submit"
            onclick="$('#slice-delete').val('1');"
            class="danger"
            name="submit"
            value="<?php echo I18n::__('module_submit_delete') ?>" />
        <!-- End of hidden field to solve missing submit button when ajax(ed) -->
        <input
            type="submit"
            name="submit"
            value="<?php echo I18n::__('module_submit') ?>" />
    </div>
</form>
