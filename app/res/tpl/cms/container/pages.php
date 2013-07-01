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
<ul>
<?php foreach ($pages as $_id => $_page): ?>
    <?php $_classes = array() ?>
    <?php if ($page->getId() == $_page->getId()) $_classes[] = 'active' ?>
    <?php if ($_page->invisible) $_classes[] = 'unpublished' ?>
    <li>
        <a
            href="<?php echo Url::build('/cms/page/%d', array($_page->getId())) ?>"
            class="<?php echo implode(' ', $_classes) ?>">
            <?php echo htmlspecialchars($_page->name) ?>
        </a>
    </li>
<?php endforeach ?>
</ul>
