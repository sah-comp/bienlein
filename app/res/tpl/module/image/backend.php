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
        <!-- its a bit hmmm hmmm... to get and set a slice option -->
        <input
            type="hidden"
            name="dialog[ownSliceoption][0][type]"
            value="sliceoption" />
        <input
            type="hidden"
            name="dialog[ownSliceoption][0][id]"
            value="<?php echo $record->getOption('media_id')->getId() ?>" />
        <input
            type="hidden"
            name="dialog[ownSliceoption][0][name]"
            value="media_id" />
        <select
            style="width: auto;"
            name="dialog[ownSliceoption][0][value]">
            <option value=""><?php echo I18n::__('slice_media_select') ?></option>
            <?php foreach (R::find('media', ' extension IN ('.R::genSlots(array('jpg', 'png', 'gif', 'jpeg')).')', array('jpg', 'png', 'gif', 'jpeg')) as $_media_id => $_media): ?>
            <option
                value="<?php echo $_media->getId() ?>"
                <?php echo ($record->getOption('media_id')->value == $_media->getId()) ? 'selected="selected"' : '' ?>><?php echo $_media->getPrintableName() ?></option>
            <?php endforeach ?>
        </select>
        <!-- ... but you have to live with it for now -->
    </div>
    <div class="row">
        <textarea
            name="dialog[content]"
            rows="3"
            cols="60"
            placeholder="<?php echo I18n::__('module_image_placeholder_content') ?>"><?php echo htmlspecialchars($record->content) ?></textarea>
    </div>
</fieldset>
