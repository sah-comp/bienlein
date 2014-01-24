<?php
/**
 * Renders a row for a limb of "subform"-kind.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<!-- tag:subform -->
<p>
    I will handle <?php echo $limb->kind ?><?php echo ucfirst($limb->name) ?> of <?php echo $record->getMeta('type') ?>#<?php echo $record->getId() ?>
</p>
<!-- end of tag:subform -->
