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
 * Language controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Language extends Controller
{
    /**
     * Set the backend language from a POST request.
     */
    public function set()
    {
        session_start();
        $_SESSION['backend']['language'] = Flight::get('language'); //reset to current frontend lang
        if (in_array(Flight::request()->data->language, Flight::get('possible_languages'))) {
            $_SESSION['backend']['language'] = Flight::request()->data->language;
        }
        $this->redirect(Flight::request()->data->goto, true );
    }
}
