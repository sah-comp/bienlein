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
 * Scaffold controller.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Scaffold extends Controller
{
    /**
     * Displays the index page of a given type.
	 *
	 * @param string $type of the bean to list
	 * @param string (optional) $layout defaults to 'default'
     */
    public function index($type, $layout = 'default')
    {
        session_start();
        Auth::check();
		$record = R::dispense($type);
		if (Flight::request()->method == 'POST') {
            //handle a selection
            $this->redirect("/admin/$type/");
        }
		// Pick up the pieces
        Flight::render('admin/navigation', array(), 'navigation');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(), 'footer');
		
		$template = "model/$type/list/$layout";
		if ( ! Flight::view()->exists($template)) $template = 'scaffold/list';
		
        Flight::render($template, array(
			'record' => $record,
            'records' => R::findAll($type)
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__("{$type}_head_title"),
            'language' => Flight::get('language')
        ));
    }

    /**
     * Displays page to add a new bean of given type.
	 *
	 * @param string $type of the bean to add
	 * @param int (optional) $id of the bean to duplicate
	 * @param string (optional) $layout
     */
    public function add($type, $id = null, $layout = 'default')
    {
        session_start();
        Auth::check();
		$record = R::dispense($type);
		if (Flight::request()->method == 'POST') {
            $record = R::graph(Flight::request()->data->dialog, true);
            R::store($record);
            $this->redirect("/admin/$type/");
        }
		// Pick up the pieces
        Flight::render('admin/navigation', array(), 'navigation');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(), 'footer');
		
		$template = "model/$type/form/$layout";
		if ( ! Flight::view()->exists($template)) $template = 'scaffold/form';
		
        Flight::render($template, array(
            'record' => $record
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__("{$type}_head_title"),
            'language' => Flight::get('language')
        ));
    }

    /**
     * Displays page to edit an existing bean.
	 *
	 * @param string $type of the bean to edit
	 * @param int $id of the bean to edit
	 * @param string (optional) $layout
     */
    public function edit($type, $id, $layout = 'default')
    {
        session_start();
        Auth::check();
		$record = R::load($type, $id);
		if (Flight::request()->method == 'POST') {
            $record = R::graph(Flight::request()->data->dialog, true);
            R::store($record);
            $this->redirect("/admin/$type/");
        }
		// Pick up the pieces
        Flight::render('admin/navigation', array(), 'navigation');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(), 'footer');
		
		$template = "model/$type/form/$layout";
		if ( ! Flight::view()->exists($template)) $template = 'scaffold/form';
		
        Flight::render($template, array(
            'record' => $record
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__("{$type}_head_title"),
            'language' => Flight::get('language')
        ));
    }

    /**
     * Displays page to delete an existing bean after confirmation.
	 *
	 * @param string $type of the bean to edit
	 * @param int $id of the bean to edit
     */
    public function delete($type, $id)
    {
        session_start();
        Auth::check();
		$record = R::load($type, $id);
		if (Flight::request()->method == 'POST') {
            $record = R::graph(Flight::request()->data->dialog, true);
            R::store($record);
            $this->redirect("/admin/$type/");
        }
		// Pick up the pieces
        Flight::render('admin/navigation', array(), 'navigation');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(), 'footer');
		
		$template = "model/$type/form/$layout";
		if ( ! Flight::view()->exists($template)) $template = 'scaffold/form';
		
        Flight::render($template, array(
            'record' => $record
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__("{$type}_head_title"),
            'language' => Flight::get('language')
        ));
    }
}
