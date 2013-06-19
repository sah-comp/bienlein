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
 * Permission Manager.
 *
 * @package Cinnebar
 * @subpackage Permission
 * @version $Id$
 */
class Permission extends Controller
{
    /**
     * Checks if user has permission on domain to do action.
     *
     * If permision is not given client is redirected to a 403 forbidden page
     * otherwise true will be returned.
     *
     * @param RedBean_OODBBean $user
     * @param string $domain
     * @param string $action
     * @return bool
     */
    static public function check(RedBean_OODBBean $user, $domain, $action)
    {
        if ($user->isadmin) return true;
        self::redirect('/forbidden/');
    }
}
