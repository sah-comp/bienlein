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
    <div
        class="app-info">
        <?php echo Flight::textile(I18n::__('app_info')) ?>
    </div>
    <div
        class="sys-info">
        <?php echo Flight::textile(I18n::__('sys_info', null, array(round(memory_get_peak_usage(true)/1048576, 2), Flight::request()->ip))) ?>
    </div>
</footer>
