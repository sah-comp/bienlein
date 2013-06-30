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
 * Cms controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Cms extends Controller
{
    /**
     * Displays the admin index page.
     */
    public function index()
    {
        session_start();
        Auth::check();
        Permission::check(Flight::get('user'), 'cms', 'index');
		// Pick up the pieces
		Flight::render('shared/notification', array(), 'notification');
        Flight::render('shared/navigation/account', array(), 'navigation_account');
        Flight::render('shared/navigation/main', array(), 'navigation_main');
        Flight::render('shared/navigation', array(), 'navigation');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(), 'footer');
        Flight::render('cms/toolbar', array(), 'toolbar');
        Flight::render('cms/index', array(), 'content');
		// Use a layout to pack it all
        Flight::render('html5', array(
            'title' => I18n::__('admin_head_title'),
            'language' => Flight::get('language')
        ));
    }
    
    /**
     * Edit a node.
     *
     * @param string $type
     */
    public function node($id)
    {
        session_start();
        Auth::check();
        $domain = R::load('domain', $id);
        $root = $domain->getRoot($stop_at = Flight::sitesfolder()->getId());
        Permission::check(Flight::get('user'), $domain, 'edit');
		// Pick up the pieces
		echo 'You want to edit node '.$id;
    }
    
    /**
     * Add a node.
     *
     * @param string $type
     */
    public function add($type)
    {
        session_start();
        Auth::check();
        Permission::check(Flight::get('user'), $type, 'add');
		// Pick up the pieces
		echo 'You want to add a new '.$type;
    }
}
