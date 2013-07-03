<?php
/**
 * Frontend of slice bean mode = textile.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('module_legend_image') ?></legend>
    <div class="row">
        <select
            style="width: auto;"
            name="dialog[content]">
            <option value=""><?php echo I18n::__('slice_media_select') ?></option>
            <?php foreach (R::findAll('media') as $_media_id => $_media): ?>
            <option
                value="<?php echo $_media->file ?>"
                <?php echo ($record->content == $_media->file) ? 'selected="selected"' : '' ?>><?php echo $_media->getPrintableName() ?></option>
            <?php endforeach ?>
        </select>
    </div>
</fieldset>
