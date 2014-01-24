<?php
/**
 * Renders a row for a limb of "number"-kind.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<!-- tag:number -->
<div class="row <?php echo ($record->hasError($limb->name)) ? 'error' : ''; ?>">
    <label
        for="<?php echo $record->getMeta('type') ?>-<?php echo $limb->name ?>">
        <?php echo I18n::__(sprintf('%s_label_%s', $record->getMeta('type'), $limb->name)) ?>
    </label>
    <input
        id="<?php echo $record->getMeta('type') ?>-<?php echo $limb->name ?>"
        type="<?php echo $limb->tag ?>"
        name="dialog[<?php echo $limb->name ?>]"
        value="<?php echo htmlspecialchars($record->{$limb->name}) ?>" />
</div>
<!-- end of tag:number -->
