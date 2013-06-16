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
     * Displays the user index page.
     */
    static public function index()
    {
        session_start();
        Auth::check();
		// Pick up the pieces
        Flight::render('admin/navigation', array(), 'navigation');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(), 'footer');
        Flight::render('model/user/list/default', array(
            'records' => R::findAll('user')
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('admin_user_head_title'),
            'language' => Flight::get('language')
        ));
    }

    /**
     * Displays page to add a new user.
     */
    static public function add()
    {
        session_start();
        Auth::check();
		$user = R::dispense('user');
		if (Flight::request()->method == 'POST') {
            $user = R::graph(Flight::request()->data->dialog, true);
            R::store($user);
            $this->redirect('/admin/user/');
        }
		// Pick up the pieces
        Flight::render('admin/navigation', array(), 'navigation');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(), 'footer');
        Flight::render('model/user/form/default', array(
            'record' => $user
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('admin_user_head_title'),
            'language' => Flight::get('language')
        ));
    }

    /**
     * Displays page to edit an existing user.
     */
    static public function edit($id)
    {
        session_start();
        Auth::check();
		$user = R::load('user', $id);
		if (Flight::request()->method == 'POST') {
            $user = R::graph(Flight::request()->data->dialog, true);
            R::store($user);
            $this->redirect('/admin/user/');
        }
		// Pick up the pieces
        Flight::render('admin/navigation', array(), 'navigation');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(), 'footer');
        Flight::render('model/user/form/default', array(
            'record' => $user
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('admin_user_head_title'),
            'language' => Flight::get('language')
        ));
    }
}
