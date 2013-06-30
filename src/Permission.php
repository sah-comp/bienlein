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
     * @todo set goto query parameter with the last allowed url, not just the current url
     *
     * @param RedBean_OODBBean $user
     * @param mixed $domain either a bean or a string with the domain name
     * @param string $action_name
     * @return bool
     */
    static public function check(RedBean_OODBBean $user, $domain, $action_name)
    {
        if ($user->isadmin) return true;
        if (self::validate($user, $domain, $action_name)) return true;
        self::redirect('/forbidden/?goto'.urlencode(Flight::request()->url));
    }
    
    /**
     * Loads the domain by name and checks for user roles. If any role allows
     * the requested action boolean true will be returned.
     *
     * @param RedBean_OODBBean $user
     * @param mixed $domain either a bean or a string
     * @param string $action_name
     * @return bool
     */
    static public function validate(RedBean_OODBBean $user, $domain, $action_name) {
        if ( ! $user->sharedRole) return false;
        if ( ! is_a($domain, 'RedBean_OODBBean')) {
            if ( ! $domain = R::findOne('domain', 'name = ?', array($domain))) return false;
        }
        $permission = self::getPermission($domain, $action_name);
        foreach ($user->sharedRole as $id => $role) {
            if (isset($permission->sharedRole[$id])) return true;
        }
        return false;
     }
     
     /**
      * Returns a permission bean.
      *
      * The returned bean will be either the direct permission of the given domain or
      * the permission bean of the nearest parent of the domain given.
      * If no permission an empty permission will be returned.
      *
      * @param RedBean_OODBBean $domain
      * @param string $action_name
      * @return RedBean_OODBBean $permission
      */
     static public function getPermission(RedBean_OODBBean $domain, $action_name)
     {
         $permission = R::findOne('permission', 'method = ? AND domain_id = ?',
            array(
                $action_name,
                $domain->getId()
            )
         );
         if ($permission && $permission->sharedRole) return $permission;
         if ( ! $domain->domain) return R::dispense('permission');
         return self::getPermission($domain->domain, $action_name);
     }
}
