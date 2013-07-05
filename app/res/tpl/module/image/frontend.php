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
<?php $media = R::load('media', $record->getOption('media_id')->value) ?>
<?php if ( ! is_file(Flight::get('upload_dir').'/'.$media->file)): ?>
<p class="alert alert-error"><?php echo I18n::__('module_image_missing_media') ?></p>
<?php return ?>
<?php endif ?>

<?php list($width, $height, $type, $attr) = getimagesize(Flight::get('upload_dir').'/'.$media->file); ?>
<img
    src="<?php echo Flight::get('media_path').'/'.$media->file ?>"
    alt="<?php echo htmlspecialchars($record->content) ?>"
    title="<?php echo htmlspecialchars($record->content) ?>"
    width="<?php echo $width ?>"
    height="<?php echo $height ?>" />
