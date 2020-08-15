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
<?php if (isset($_attribute['callback'])): ?>
    <?php echo htmlspecialchars($_record->{$_attribute['callback']['name']}($_attribute['name'])) ?>
<?php else: ?>
    <?php echo htmlspecialchars($_record->{$_attribute['name']}) ?>
<?php endif ?>
