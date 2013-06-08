<?php
/**
 * sah-comp/any welcome controller.
 *
 * @package X
 * @author $Author$
 * @version $Id$
 */

/**
 * Welcome controller.
 */
class Controller_Welcome
{
    static public function index()
    {
        Flight::render('welcome', array(), 'content');
        Flight::render('html5');
    }
}
