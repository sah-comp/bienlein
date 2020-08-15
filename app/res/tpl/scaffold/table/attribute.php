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
<a
    href="<?php echo Url::build(sprintf('/admin/%s/inline/%s/%d', $_record->getMeta('type'), $_attribute['name'], $_record->getId())) ?>"
    class="fox-on-the-run"
    title="Inline Editor"
    data-target="<?php echo $_target ?>">
    <?php if (isset($_attribute['callback'])): ?>
        <?php echo htmlspecialchars($_record->{$_attribute['callback']['name']}($_attribute['name'])) ?>
    <?php else: ?>
        <?php echo htmlspecialchars($_record->{$_attribute['name']}) ?>
    <?php endif ?>
</a>
