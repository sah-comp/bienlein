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
 * Welcome controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Welcome extends Controller
{
    /**
     * Renders the welcome page.
     */
    static public function index()
    {
        Flight::render(Flight::get('language').'/welcome', array(), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('welcome_head_title'),
            'language' => Flight::get('language')
        ));
    }
}
