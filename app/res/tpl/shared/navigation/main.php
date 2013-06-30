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
<?php echo Flight::blessedfolder()
                    ->hierMenu('/', Flight::get('language'))
                    ->render(array('class' => 'main-navigation clearfix'));
?>
<!-- End of admin navigation -->
