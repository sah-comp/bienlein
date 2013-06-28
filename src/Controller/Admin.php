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
        // load
        $setting = R::load('setting', 1);
        
		if (Flight::request()->method == 'POST') {
            $setting = R::graph(Flight::request()->data->dialog, true);
            R::begin();
            try {
                R::store($setting);
                if (Flight::request()->data->loadexchangerates == 1 ) {
                    R::dispense('currency')->loadexchangerates();
                }
                R::commit();
                Flight::get('user')->notify(I18n::__('scaffold_success_edit'), 'success');
                $this->redirect('/admin/index');
            }
            catch (Exception $e) {
                R::rollback();
                Flight::get('user')->notify(I18n::__('scaffold_error_edit'), 'error');
            }
        }
        
		// Pick up the pieces
		Flight::render('shared/notification', array(), 'notification');
        Flight::render('shared/navigation/account', array(), 'navigation_account');
        Flight::render('shared/navigation/main', array(), 'navigation_main');
        Flight::render('shared/navigation', array(), 'navigation');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(), 'footer');

        Flight::render('model/setting/edit', array(
            'record' => $setting
        ), 'form_details');		

        Flight::render('admin/index', array(), 'content');
		// Use a layout to pack it all
        Flight::render('html5', array(
            'title' => I18n::__('admin_head_title'),
            'language' => Flight::get('language')
        ));
    }
}
