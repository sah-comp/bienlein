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
 * Admin user controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Admin_User extends Controller
{
    /**
     * Displays the admin index page.
     */
    static public function index()
    {
        session_start();
        Auth::check();
        Flight::render('admin/navigation', array(), 'navigation');
        Flight::render('admin/user/index', array(
            'records' => R::findAll('user')
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('admin_user_head_title'),
            'language' => Flight::get('language')
        ));
    }
}
