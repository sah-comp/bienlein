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
    
    <?php if (isset($record) && $record->hasErrors()): ?>
    <div class="alert alert-error validation-errors">
        <?php foreach ($record->getErrors() as $_attribute => $_errors): ?>
            <h1><?php echo I18n::__($record->getMeta('type') . '_label_' . $_attribute) ?></h1>
            <ul>
            <?php foreach ($_errors as $_error_id => $_error): ?>
                <li><?php echo $_error ?></li>
            <?php endforeach ?>
            </ul>
        <?php endforeach ?>
    </div>
    <?php endif ?>
</div>
<!-- End of notifications -->
<?php endif ?>
