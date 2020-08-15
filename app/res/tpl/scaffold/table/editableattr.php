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
    id="<?php echo $_record->getMeta('type') . '-' . $_record->getId() ?>"
    class="fox-on-the-run"
    data-bean-type="<?php echo $_record->getMeta('type') ?>"
    data-bean-id="<?php echo $_record->getId() ?>"
    data-bean-attribute="<?php echo $_attribute['name'] ?>">
    <?php if (isset($_attribute['callback'])): ?>
        <?php echo htmlspecialchars($_record->{$_attribute['callback']['name']}($_attribute['name'])) ?>
    <?php else: ?>
        <?php echo htmlspecialchars($_record->{$_attribute['name']}) ?>
    <?php endif ?>
</div>
