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
<?php list($width, $height, $type, $attr) = getimagesize(Flight::get('upload_dir').'/'.$record->content); ?>
<img
    src="<?php echo Flight::get('media_path').'/'.$record->content ?>"
    alt=""
    width="<?php echo $width ?>"
    height="<?php echo $height ?>" />
