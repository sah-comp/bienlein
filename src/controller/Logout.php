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
     * Renders the login page and handles a login attempt on POST.
     */
    static public function index()
    {
        session_start();
        unset($_SESSION);
        session_destroy();
        self::redirect('/');
    }
}
