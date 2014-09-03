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
    <input type="hidden" name="dialog[sequence]" value="<?php echo htmlspecialchars($record->sequence) ?>" />
</div>
<?php if ($record->isImage()): ?>
<img
	src="<?php echo Flight::get('media_path') . '/' . $record->file ?>"
	class="media-preview-icon <?php echo $record->extension ?>"
	width="72"
	height="72"
	alt="<?php echo htmlspecialchars($record->name) ?>"
	title="<?php echo htmlspecialchars($record->name) ?>" />
<?php endif ?>
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
    <?php if ($record->isImage()): ?>
    <div class="row">
        <label
            for="media-textile">
            <?php echo I18n::__('media_label_textile') ?>
        </label>
        <input
            id="media-textile"
            type="text"
            name="media-textile"
            disabled="disabled"
            value="<?php echo htmlspecialchars($record->imageAsTextile()) ?>" />
    </div>
    <?php endif ?>
</fieldset>
<!-- end of media edit form -->