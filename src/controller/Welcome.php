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
    public function index()
    {
        Flight::render('welcome/welcome_'.Flight::get('language'), array(), 'content');
        Flight::render('html5', array(
            'title' => I18n::__('welcome_head_title'),
            'language' => Flight::get('language')
        ));
    }
}
