<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @author $Author$
 * @version $Id$
 */

/**
 * Admin controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Admin extends Controller
{
    /**
     * Displays the admin index page.
     */
    public function index()
    {
        session_start();
        Auth::check();
		// Pick up the pieces
		Flight::render('shared/notification', array(), 'notification');
        Flight::render('shared/navigation/account', array(), 'navigation_account');
        Flight::render('shared/navigation/main', array(), 'navigation_main');
        Flight::render('shared/navigation', array(), 'navigation');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(), 'footer');
        Flight::render('admin/index', array(), 'content');
		// Use a layout to pack it all
        Flight::render('html5', array(
            'title' => I18n::__('admin_head_title'),
            'language' => Flight::get('language')
        ));
    }
}
