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
<!-- main navigation -->
<?php echo R::findOne('domain', 'blessed = ?', array(1))->hierMenu('/', Flight::get('language'))->render(array(
    'class' => 'main-navigation clearfix'
)); ?>
<!-- End of admin navigation -->
