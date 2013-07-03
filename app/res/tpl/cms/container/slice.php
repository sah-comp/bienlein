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
<div
    id="slice-<?php echo $record->getId() ?>"
    class="slice-container active"
    data-href="<?php echo Url::build('/cms/slice/%d', array($record->getId())) ?>"
    data-container="slice-<?php echo $record->getId() ?>">
    <?php echo $form ?>
</div>
