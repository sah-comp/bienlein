<?php
/**
 * Scaffold edit template.
 *
 * This is used if there is no special edit template for the given model.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<!-- scaffold edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<?php if ( ! $_gestalt = R::findOne('gestalt', ' name = ? ', array($record->getMeta('type')))): ?>
    <fieldset>
        <legend class="verbose"><?php echo I18n::__($record->getMeta('type') . '_legend') ?></legend>
        <div>
            <p>Unfunny things to do in may</p>
        </div>
    </fieldset>
<?php else: ?>
    <fieldset>
        <legend class="verbose"><?php echo I18n::__($record->getMeta('type') . '_legend') ?></legend>
        <?php foreach ($_gestalt->withCondition(' active = 1 ORDER BY sequence ASC')->ownLimb as $_limb_id => $_limb): ?>
        <?php echo $_limb->render($record) ?>
        <?php endforeach ?>
    </fieldset>
<?php endif ?>
<!-- end of scaffold edit form -->
