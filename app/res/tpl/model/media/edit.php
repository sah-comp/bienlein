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
<!-- media edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
    <input type="hidden" name="dialog[extension]" value="<?php echo htmlspecialchars($record->extension) ?>" />
    <input type="hidden" name="dialog[size]" value="<?php echo htmlspecialchars($record->size) ?>" />
    <input type="hidden" name="dialog[mime]" value="<?php echo htmlspecialchars($record->mime) ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('media_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('file')) ? 'error' : ''; ?>">
        <label
            for="media-file">
            <?php echo I18n::__('media_label_file') ?>
        </label>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo Flight::get('max_upload_size') ?>" />
        <input
            id="media-file"
            type="file"
            name="file"
            value="<?php echo htmlspecialchars($record->file) ?>" />
    </div>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="media-name">
            <?php echo I18n::__('media_label_name') ?>
        </label>
        <input
            id="media-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>" />
    </div>
    <div class="row <?php echo ($record->hasError('desc')) ? 'error' : ''; ?>">
        <label
            for="media-desc">
            <?php echo I18n::__('media_label_desc') ?>
        </label>
        <textarea
            id="media-desc"
            name="dialog[desc]"
            rows="5"
            cols="60"><?php echo htmlspecialchars($record->desc) ?></textarea>
    </div>
</fieldset>
<!-- end of media edit form -->