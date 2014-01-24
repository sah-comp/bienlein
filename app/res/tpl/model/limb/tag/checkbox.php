<?php
/**
 * Renders a row for a limb of "checkbox"-kind.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<!-- tag:checkbox -->
<div class="row <?php echo ($record->hasError($limb->name)) ? 'error' : ''; ?>">
    <input
        type="hidden"
        name="dialog[<?php echo $limb->name ?>]"
        value="0" />
    <input
        id="<?php echo $record->getMeta('type') ?>-<?php echo $limb->name ?>"
        type="checkbox"
        name="dialog[<?php echo $limb->name ?>]"
        <?php echo ($record->{$limb->name}) ? 'checked="checked"' : '' ?>
        value="1" />
    <label
        for="<?php echo $record->getMeta('type') ?>-<?php echo $limb->name ?>"
        class="cb">
        <?php echo I18n::__(sprintf('%s_label_%s', $record->getMeta('type'), $limb->name)) ?>
    </label>
</div>
<!-- end of tag:checkbox -->
