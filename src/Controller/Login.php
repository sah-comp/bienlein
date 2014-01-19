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
 * Login controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Login extends Controller
{
    /**
     * Renders the login page and handles a login attempt on POST.
     */
    public function index()
    {
        session_start();
        if ( ! isset($_SESSION['login_id'])) {
            $_SESSION['login_id'] = 0;
        }
        $login = R::load('login', $_SESSION['login_id']);
        if (Flight::request()->method == 'POST') {
            try {
                $login = R::graph(Flight::request()->data->dialog, true);
                if ($login->trial()) {
                    //you must trial before store because of pw reset in update
                    $_SESSION['user']['id'] = $login->user->getId();
                    $_SESSION['backend']['language'] = Flight::get('language');
                    $login->user->sid = session_id();
                    R::store($login);
                    $this->redirect(Flight::request()->data->goto, $raw = true);
                }
                R::store($login);//yes, only bad attempts are stored
            } catch (Exception $e) {
                error_log($e);
                //uups, login could not be saved
            }
        }
        // either no yet submitted or the credentials given failed
        Flight::render('account/login', array(
            'goto' => htmlspecialchars(Flight::request()->query->goto),
            'record' => $login
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('login_head_title'),
            'language' => Flight::get('language'),
            'stylesheets' => array('custom', 'default')
        ));
    }
}
