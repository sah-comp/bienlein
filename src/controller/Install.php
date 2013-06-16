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
 * Install controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Install extends Controller
{
    /**
     * Renders the install page and handles POST request.
     */
    public function index()
    {
        session_start();
        $user = R::dispense('user');
        if (Flight::request()->method == 'POST' && 
                password_verify(Flight::request()->data->pass, CINNEBAR_INSTALL_PASS)) {
            $user = R::graph(Flight::request()->data->dialog, true);
            R::store($user);
            $this->redirect('/admin');
        }
        // either no yet submitted or the credentials given failed
        Flight::render('install/index', array(
            'record' => $user
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('install_head_title'),
            'language' => Flight::get('language')
        ));
    }
}
