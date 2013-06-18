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
 * @todo Main points:
 *  - Check permissions
 *  - Allow different layouts
 *  - Allow sorting
 *  - Allow filtering
 *
 * @package Cinnebar
 * @subpackage Controller
 * @version $Id$
 */
class Controller_Scaffold extends Controller
{
    /**
     * Holds the base url.
     *
     * @var string
     */
    public $base_url;
    
    /**
     * Holds the type of the bean(s) to handle.
     *
     * @var string
     */
    public $type;
    
    /**
     * Holds the id of the bean to handle.
     *
     * @var int
     */
    public $id;

    /**
     * Holds the name of the action that was requested.
     *
     * @var string
     */
    public $action;
    
    /**
     * Holds the name of the layout to use.
     *
     * @var string
     */
    public $layout;
    
    /**
     * Holds a instance of the bean to handle.
     *
     * @var RedBean_OODBBean
     */
    public $record;
    
    /**
     * Container for beans to browse.
     *
     * @var array
     */
    public $records = array();
    
    /**
     * Constructs a new Scaffold controller.
     *
     * @param string $base_url for scaffold links and redirects
     * @param string $type of the bean to scaffold
     * @param int (optional) $id of the bean to handle
     */
    public function __construct($base_url, $type, $id = null)
    {
        session_start();
        Auth::check();
        $this->base_url = $base_url;
        $this->type = $type;
        $this->id = $id;
        $this->record = R::load($type, $id);
        if ( ! isset($_SESSION['scaffold'])) {
            $_SESSION['scaffold'][$this->record->getMeta('type')]['index']['next_action'] = 'idle';
            $_SESSION['scaffold'][$this->record->getMeta('type')]['add']['next_action'] = 'add';
            $_SESSION['scaffold'][$this->record->getMeta('type')]['edit']['next_action'] = 'next_edit';
            $_SESSION['scaffold'][$this->record->getMeta('type')]['delete']['next_action'] = 'index';
        }
    }
    
    /**
     * Returns true or false wether the bean was stored or not.
     *
     * The current bean is challanged to be stored wrapped in a transaction. When the bean was
     * successfully stored a message is send to the user telling about that. In case the store
     * fails a failure message is send to the current user.
     *
     * @uses $record
     * @param string $redbeanAction can be either trash or store
     * @return bool
     */
    protected function doRedbeanAction($redbeanAction = 'store')
    {
        R::begin();
        try {
            R::$redbeanAction($this->record);//store or trash -- nothing else works here
            R::commit();
            $this->notifyAbout('success');
            return true;
        }
        catch (Exception $e) {
            R::rollback();
            $this->notifyAbout('failure');
            return false;
        }
    }
    
    /**
     * Add a notification to the user.
     *
     * @param string $type of the notification about the current action
     */
    protected function notifyAbout($type)
    {
        Flight::get('user')->notify(I18n::__("{$this->type}_{$type}_{$this->action}"));
    }
    
    /**
     * Returns an array of beans.
     *
     * @uses $type
     * @return array
     */
    protected function getCollection()
    {
        return R::findAll($this->type);
    }
    
    /**
     * Sets the next_action in scaffold session var.
     *
     * @uses $record
     * @uses $action
     * @param string $next_action
     */
    protected function setNextAction($action)
    {
        $_SESSION['scaffold'][$this->record->getMeta('type')][$this->action]['next_action'] = $action;
    }
    
    /**
     * Returns the next_action.
     *
     * @return string $next_action
     */
    protected function getNextAction()
    {
        return $_SESSION['scaffold'][$this->record->getMeta('type')][$this->action]['next_action'];
    }
    
    /**
     * Returns the next record id.
     *
     * @todo implement real next record
     *
     * @return int $nextRecordId
     */
    protected function getNextRecordId()
    {
        return $this->record->getId();
    }
    
    /**
     * Returns the previous record id.
     *
     * @todo implement real prev record
     *
     * @return int $prevRecordId
     */
    protected function getPrevRecordId()
    {
        return $this->record->getId();
    }
    
	/**
     * Displays the index page of a given type.
     *
     * On a GET request a list view of the beans is represented where on a POST request
     * the choosen action is applied to all selected beans of a collection.
     */
    public function index()
    {
        $this->action = 'index';//aka browse
		if (Flight::request()->method == 'POST') {
            //handle a selection
            $this->redirect("{$this->base_url}/{$this->type}/");
        }
		$this->records = $this->getCollection();
		$this->render();
    }

    /**
     * Displays page to add a new bean of given type.
     *
     * On a GET request a form is represented that has to be filled in by the client. On a POST
     * request a new bean is created and the client is redirected to a choosen next url.
     */
    public function add()
    {
        $this->action = 'add';
		if (Flight::request()->method == 'POST') {
            $this->record = R::graph(Flight::request()->data->dialog, true);

            //R::store($this->record);
            $this->doRedbeanAction();

            $this->setNextAction(Flight::request()->data->next_action);
            if ($this->getNextAction() == 'add') {
                $this->redirect("{$this->base_url}/{$this->type}/add/");
            } elseif ($this->getNextAction() == 'edit') {
                $this->redirect("{$this->base_url}/{$this->type}/edit/{$this->record->getId()}");
            }
            $this->redirect("{$this->base_url}/{$this->type}/");
        }
		$this->render();
    }

    /**
     * Displays page to edit an existing bean.
     *
     * On a GET request a form is presented to edit the bean. On a POST request the changed bean
     * is stored and the client is redirected.
     */
    public function edit()
    {
        $this->action = 'edit';
		if (Flight::request()->method == 'POST') {
            $this->record = R::graph(Flight::request()->data->dialog, true);

            //R::store($this->record);
            $this->doRedbeanAction();
            
            $this->setNextAction(Flight::request()->data->next_action);
            if ($this->getNextAction() == 'edit') {
                $this->redirect("{$this->base_url}/{$this->type}/edit/{$this->record->getId()}");
            } elseif ($this->getNextAction() == 'next_edit') {
                $this->redirect("{$this->base_url}/{$this->type}/edit/{$this->getNextRecordId()}");
            } elseif ($this->getNextAction() == 'prev_edit') {
                    $this->redirect("{$this->base_url}/{$this->type}/edit/{$this->getPrevRecordId()}");
            }
            $this->redirect("{$this->base_url}/{$this->type}/");
        }
		$this->render();
    }

    /**
     * Displays page to delete an existing bean after confirmation.
     *
     * On a GET request a form is represented to confirm the deletion on the bean while on a POST
     * request the bean is deleted and client is redirected to the index view.
     */
    public function delete()
    {
        $this->action = 'delete';
		if (Flight::request()->method == 'POST') {
		    
            $this->doRedbeanAction('trash');
            
            $this->redirect("{$this->base_url}/{$this->type}/");
        }
		$this->render();
    }

	/**
	 * Renders a scaffold page.
	 *
	 * @todo Think about:
	 *  - Make the 'html5' layout configurable
	 */
	protected function render()
	{
        Flight::render('shared/navigation/account', array(), 'navigation_account');
		Flight::render('shared/navigation/main', array(), 'navigation_main');
        Flight::render('shared/navigation', array(), 'navigation');
        Flight::render('scaffold/toolbar', array(
            'base_url' => $this->base_url,
            'type' => $this->type
        ), 'toolbar');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(), 'footer');
		Flight::render("model/{$this->type}/{$this->action}", array(
            'record' => $this->record,
			'records' => $this->records
        ), 'form_details');
        Flight::render('scaffold/form', array(
            'actions' => $this->record->getActions(),
            'current_action' => $this->action,
            'next_action' => $this->getNextAction(),
            'record' => $this->record,
			'records' => $this->records
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__("scaffold_head_title_{$this->action}"),
            'language' => Flight::get('language')
        ));
	}
}
