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
<!-- container with all sortable medias of a gallery -->
<div
    id="gallery-<?php echo $record->getId() ?>"
    class="media-container"
    data-href="<?php echo Url::build('/cms/sortable/media/media/') ?>"
    data-container="gallery-<?php echo $record->getId() ?>"
    data-variable="media">
<?php $_i = 0 ?>
<?php
foreach ($record->getMedias() as $_media_id => $_media):
    if ( is_file(Flight::get('upload_dir').'/'.$_media->file)):
    $_i++;
    ?>
    <div
        id="media-<?php echo $_media_id ?>">        
        <input type="hidden" name="dialog[ownMedia][<?php echo $_i ?>][type]" value="media" />
        <input type="hidden" name="dialog[ownMedia][<?php echo $_i ?>][id]" value="<?php echo $_media_id ?>" />
        <input type="hidden" name="dialog[ownMedia][<?php echo $_i ?>][extension]" value="<?php echo htmlspecialchars($_media->extension) ?>" />
        <input type="hidden" name="dialog[ownMedia][<?php echo $_i ?>][name]" value="<?php echo htmlspecialchars($_media->name) ?>" />
        <input type="hidden" name="dialog[ownMedia][<?php echo $_i ?>][file]" value="<?php echo htmlspecialchars($_media->file) ?>" />
        <input type="hidden" name="dialog[ownMedia][<?php echo $_i ?>][size]" value="<?php echo (int)$_media->size ?>" />
        <input type="hidden" name="dialog[ownMedia][<?php echo $_i ?>][mime]" value="<?php echo htmlspecialchars($_media->mime) ?>" />
        <input type="hidden" name="dialog[ownMedia][<?php echo $_i ?>][desc]" value="<?php echo htmlspecialchars($_media->desc) ?>" />
        <input type="hidden" name="dialog[ownMedia][<?php echo $_i ?>][sanename]" value="<?php echo htmlspecialchars($_media->sanename) ?>" />
    <?php
    list($width, $height, $type, $attr) = getimagesize(Flight::get('upload_dir').'/'.$_media->file);
?>
    <img
        src="<?php echo Flight::get('media_path').'/'.$_media->file ?>"
        alt="<?php echo htmlspecialchars($_media->desc) ?>"
        title="<?php echo htmlspecialchars($_media->desc) ?>"
        width="<?php echo $width ?>"
        height="<?php echo $height ?>" />
    </div>
<?php
    endif;
endforeach;
$_i++;
?>
</div>
<!-- end of media container -->
<script>
    $("#gallery-<?php echo $record->getId() ?>").sortable({
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
<!-- add a new image to the gallery -->
<fieldset>
    <legend class="verbose"><?php echo I18n::__('media_legend') ?></legend>
    <div class="row">
        <input type="hidden" name="dialog[ownMedia][<?php echo $_i ?>][type]" value="media" />
        <input type="hidden" name="dialog[ownMedia][<?php echo $_i ?>][id]" value="0" />
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo Flight::get('max_upload_size') ?>" />
        <input
            id="media-file"
            type="file"
            name="file"
            value="" />
    </div>
    <div class="row">
        <input
            id="media-name"
            type="text"
            name="dialog[ownMedia][<?php echo $_i ?>][name]"
            placeholder="<?php echo htmlspecialchars(I18n::__('media_placeholder_name')) ?>"
            value="" />
    </div>
    <div class="row">
        <textarea
            id="media-desc"
            name="dialog[ownMedia][<?php echo $_i ?>][desc]"
            rows="5"
            cols="60"
            placeholder="<?php echo htmlspecialchars(I18n::__('media_placeholder_desc')) ?>"></textarea>
    </div>
</fieldset>
<!-- end of new image -->
