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
 * Logout controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Logout extends Controller
{
    /**
     * Resets and destroys the current session, then redirects to /.
     */
    public function index()
    {
        session_start();
        Auth::check();
        Flight::get('user')->logout();
        R::store(Flight::get('user'));
        unset($_SESSION);
        session_destroy();
        $this->redirect('/');
    }
}
