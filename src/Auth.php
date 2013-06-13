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
 * Authentication Manager.
 *
 * @package Cinnebar
 * @subpackage Auth
 * @version $Id$
 */
class Auth extends Controller
{
    /**
     * Checks for a valid session.
     *
     * @todo implement some serious authentication check
     *
     * If no valid session is found client will be redirected to the login page
     * with the current URL as a query parameter in $goto.
     *
     * A session must already be started.
     */
    static public function check()
    {
        if (isset($_SESSION['user']['id'])) return true;
        $loginpage = '/login/?goto='.urlencode(Flight::request()->url);
        self::redirect($loginpage);
    }
}
