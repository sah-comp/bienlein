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
<footer>
    <?php if (isset($pagination) && is_a($pagination, 'Pagination')): ?>
    <?php echo $pagination->render() ?>
    <?php endif ?>
</footer>
