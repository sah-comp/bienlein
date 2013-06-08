<?php
/**
 * bienlein routes for flight.
 *
 * @package X
 * @author $Author$
 * @version $Id$
 */

//Route the root to our welcome controller.
Flight::route('/', array('Controller_Welcome', 'index'));

//Not found.
Flight::map('notFound', function() {
    Flight::render('404', array(), 'content');
    Flight::render('html5', array());
});
