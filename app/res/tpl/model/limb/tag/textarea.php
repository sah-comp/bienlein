<?php
/**
 * Renders a row for a limb of "textarea"-kind.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<!-- tag:textarea -->
<div class="row <?php echo ($record->hasError($limb->name)) ? 'error' : ''; ?>">
    <label
        for="<?php echo $record->getMeta('type') ?>-<?php echo $limb->name ?>">
        <?php echo I18n::__(sprintf('%s_label_%s', $record->getMeta('type'), $limb->name)) ?>
    </label>
    <textarea
        id="<?php echo $record->getMeta('type') ?>-<?php echo $limb->name ?>"
        name="dialog[<?php echo $limb->name ?>]"
        rows="3"
        cols="60"><?php echo htmlspecialchars($record->{$limb->name}) ?></textarea>
</div>
<!-- end of tag:textarea -->
