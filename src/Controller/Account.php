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
 * Account controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Account
{
    /**
     * Displays the currently logged user account.
     *
     * A GET request will simply display the page and a POST request will change
     * the user account.
     */
    public function index()
    {
        echo "Account:index";
    }
    
    /**
     * Displays a page to change the password.
     *
     * A GET request will simply display the page and a POST request will try to
     * change the password.
     */
    public function changepassword()
    {
        echo "Account:changepassword";
    }
    
    /**
     * Displays a page to aquire a new password.
     *
     * A GET request will simply display the page and a POST request will lookup
     * the given email address and send a authorized link, valid for x time to
     * allow user to enter a new password.
     */
    public function lostpassword()
    {
        echo "Account:lostpassword";
    }
}
