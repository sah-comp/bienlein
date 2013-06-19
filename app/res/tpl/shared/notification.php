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
<?php if (Flight::has('user') && $items = Flight::get('user')->getNotifications()): ?>
<!-- notifications of the current user -->
<div
    id="notification"
    class="notification"
    style="display: none;">
    <?php foreach ($items as $id => $item): ?>
    <div class="alert alert-<?php echo $item->class ?>">
        <?php echo Flight::textile($item->content) ?>
    </div>
    <?php endforeach ?>
</div>
<!-- End of notifications -->
<?php endif ?>
