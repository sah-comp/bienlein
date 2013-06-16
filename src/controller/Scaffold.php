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
	 * Start a session and try to authenticate user.
	 *
	 * If the session was not authenticated client will be redirected to
	 * the login screen with goto parameter set to the original resource.
	 *
	 * @uses Auth::check()
	 * @return void
	 */
	protected function setup()
	{
		session_start();
        Auth::check();
	}

	/**
     * Displays the index page of a given type.
	 *
	 * @param string $type of the bean to list
	 * @param string (optional) $layout defaults to 'default'
     */
    public function index($type, $layout = 'default')
    {
		$this->setup();
		$record = R::dispense($type);
		if (Flight::request()->method == 'POST') {
            //handle a selection
            $this->redirect("/admin/$type/");
        }
		$records = R::findAll($type);
		$template = "model/$type/list/$layout";
		if ( ! Flight::view()->exists($template)) $template = 'scaffold/list';
		$this->render($template, $record, $records);
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
		$this->setup();
		$record = R::dispense($type);
		if (Flight::request()->method == 'POST') {
            $record = R::graph(Flight::request()->data->dialog, true);
            R::store($record);
            $this->redirect("/admin/$type/");
        }
		$template = "model/$type/form/$layout";
		if ( ! Flight::view()->exists($template)) $template = 'scaffold/form';
		$this->render($template, $record);
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
		$this->setup();
		$record = R::load($type, $id);
		if (Flight::request()->method == 'POST') {
            $record = R::graph(Flight::request()->data->dialog, true);
            R::store($record);
            $this->redirect("/admin/$type/");
        }
		$template = "model/$type/form/$layout";
		if ( ! Flight::view()->exists($template)) $template = 'scaffold/form';
		$this->render($template, $record);
    }

    /**
     * Displays page to delete an existing bean after confirmation.
	 *
	 * @param string $type of the bean to edit
	 * @param int $id of the bean to edit
     */
    public function delete($type, $id)
    {
		$this->setup();
		$record = R::load($type, $id);
		if (Flight::request()->method == 'POST') {
            $record = R::graph(Flight::request()->data->dialog, true);
            R::store($record);
            $this->redirect("/admin/$type/");
        }
		// Pick up the pieces
		$template = "model/$type/form/$layout";
		if ( ! Flight::view()->exists($template)) $template = 'scaffold/form';
		$this->render($template, $record);
    }

	/**
	 * Renders a scaffold page.
	 *
	 * @param string $template is the name of the content-template to render
	 * @param RedBean_OODBBean $record holds the current bean
	 * @param array (optional) $records may contain a list of beans
	 */
	protected function render($template, 
							RedBean_OODBBean $record, array $records = array())
	{
        Flight::render('shared/navigation/account', array(), 'navigation_account');
		Flight::render('shared/navigation/main', array(), 'navigation_main');
        Flight::render('shared/navigation', array(), 'navigation');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(), 'footer');
		Flight::render($template, array(
            'record' => $record,
			'records' => $records
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__("{$record->getMeta('type')}_head_title"),
            'language' => Flight::get('language')
        ));
	}
}
