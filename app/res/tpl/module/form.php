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
    id="<?php echo $record->getMeta('type') ?>-<?php echo $record->getId() ?>-form"
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
    <fieldset
        class="options-container">
        <legend class="verbose"><?php echo I18n::__('slice_legend_options') ?></legend>
        <a
            href="#toggle"
            class="toggle-options"
            onclick="$('#slice-<?php echo $record->getId() ?>-options').toggle(); $(this).toggleClass('active'); return false;">
            <?php echo I18n::__('module_'.$record->module) ?>
        </a>
        <div
            id="slice-<?php echo $record->getId() ?>-options"
            class="panel options"
            style="display: none;">
            <div class="row">
                <label
                    for="slice-<?php echo $record->getId() ?>-tag">
                    <?php echo I18n::__('slice_label_tag') ?>
                </label>
                <input
                    id="slice-<?php echo $record->getId() ?>-tag"
                    type="text"
                    name="dialog[tag]"
                    placeholder="<?php echo I18n::__('slice_placeholder_tag') ?>"
                    value="<?php echo htmlspecialchars($record->tag) ?>" />
            </div>
            <div class="row">
                <label
                    for="slice-<?php echo $record->getId() ?>-class">
                    <?php echo I18n::__('slice_label_class') ?>
                </label>
                <input
                    id="slice-<?php echo $record->getId() ?>-class"
                    type="text"
                    name="dialog[class]"
                    placeholder="<?php echo I18n::__('slice_placeholder_class') ?>"
                    value="<?php echo htmlspecialchars($record->class) ?>" />
            </div>
            <div class="row">
                <label
                    for="slice-<?php echo $record->getId() ?>-css">
                    <?php echo I18n::__('slice_label_css') ?>
                </label>
                <input
                    id="slice-<?php echo $record->getId() ?>-css"
                    type="text"
                    name="dialog[css]"
                    placeholder="<?php echo I18n::__('slice_placeholder_css') ?>"
                    value="<?php echo htmlspecialchars($record->css) ?>" />
            </div>
        </div>
    </fieldset>
    <?php echo $form_details ?>
    <div class="buttons">
        <input
            id="slice-<?php echo $record->getId() ?>-update"
            type="submit"
            name="submit"
            value="<?php echo I18n::__('module_submit') ?>" />            
        <!-- Ajax does not send the submit button value, so we transport with hidden field -->
        <input
            id="slice-<?php echo $record->getId() ?>-delete"
            type="hidden"
            name="delete"
            value="0" />
        <input
            type="submit"
            onclick="$('#slice-<?php echo $record->getId() ?>-delete').val('1');"
            class="danger"
            name="submit"
            value="<?php echo I18n::__('module_submit_delete') ?>" />
        <!-- End of hidden field to solve missing submit button when ajax(ed) -->
    </div>
</form>
