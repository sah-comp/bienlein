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
    static public function index()
    {
        session_start();
        $login = R::dispense('login');
        if (Flight::request()->method == 'POST') {
            $login = R::graph(Flight::request()->data->dialog, true);
            if ($login->trial()) {
                $_SESSION['user']['id'] = $login->user->getId();
                self::redirect(Flight::request()->data->goto, $raw = true);
            } 
        }
        // either no yet submitted or the credentials given failed
        Flight::render('login', array(
            'goto' => Flight::request()->query->goto,
            'record' => $login
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('login_head_title'),
            'language' => Flight::get('language')
        ));
    }
}
