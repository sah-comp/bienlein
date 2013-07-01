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
     * Holds the real template to render.
     *
     * @var string
     */
    public $template;
    
    /**
     * Holds a instance of the bean to handle.
     *
     * @var RedBean_OODBBean
     */
    public $record;
    
    /**
     * Holds a instance of a filter bean.
     *
     * @var RedBean_OODBBean
     */
    public $filter;
    
    /**
     * Container for beans to browse.
     *
     * @var array
     */
    public $records = array();
    
    /**
     * Holds the maximum number of records per page.
     *
     * @var int
     */
    public $limit = 17;
    
    /**
     * Holds the default layout for index.
     *
     * @var string
     */
    public $default_layout = 'table';
    
    /**
     * Holds the total number of beans found.
     *
     * @var int
     */
    public $total_records = 0;
    
    /**
     * Container for selected beans.
     *
     * @var array
     */
    public $selection = array();
    
    /**
     * Holds the current page.
     *
     * @var int
     */
    public $page = 1;
    
    /**
     * Holds the current order index.
     *
     * @var int
     */
    public $order = 0;
    
    /**
     * Holds the current sort dir(ection) index.
     *
     * @var int
     */
    public $dir = 0;
    
    /**
     * Container for order dir(ections).
     *
     * @var array
     */
    public $dir_map = array(
        0 => 'ASC',
        1 => 'DESC'
    );
    
    /**
     * Holds a instance of a Pagination class.
     *
     * @var Pagination
     */
    public $pagination;
    
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
        $this->layout = $this->default_layout;
        $this->record = R::load($type, $id);
        if ( ! isset($_SESSION['scaffold'][$this->type])) {
            $_SESSION['scaffold'][$this->type]['filter']['id'] = 0;
            // next 
            $_SESSION['scaffold'][$this->type]['index']['next_action'] = 'idle';
            $_SESSION['scaffold'][$this->type]['add']['next_action'] = 'add';
            $_SESSION['scaffold'][$this->type]['edit']['next_action'] = 'edit';
            $_SESSION['scaffold'][$this->type]['delete']['next_action'] = 'index';
        }
        $this->filter = R::load('filter', $_SESSION['scaffold'][$this->type]['filter']['id']);
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
            error_log($e);
            R::rollback();
            $this->notifyAbout('error');
            return false;
        }
    }
    
    /**
     * Add a notification for currnet user.
     *
     * @param string $type of the notification (alert)
     * @param int (optional) $count number of beans affected
     */
    protected function notifyAbout($type, $count = null)
    {
        Flight::get('user')->notify(I18n::__("scaffold_{$type}_{$this->action}", 
                                                            null, array($count)), $type);
    }
    
    /**
     * Loads a bean collection according to filter or all if no filter was applied.
     *
     * @uses $filter
     * @uses $records
     * @return bool
     */
    protected function getCollection()
    {
        $where = $this->filter->buildWhereClause();
        $attributes = $this->record->getAttributes($this->layout);
        $order = $attributes[$this->order]['sort']['name'].' '.$this->dir_map[$this->dir];
        $sqlCollection = $this->record->getSql(
            "DISTINCT({$this->type}.id) AS id", 
            $where, 
            $order, 
            $this->offset($this->page, $this->limit), 
            $this->limit
        );
        $sqlTotal = $this->record->getSql(
            "COUNT(DISTINCT({$this->type}.id)) AS total", 
            $where, 
            $order
        );
        $this->total_records = 0;
		try {
		    //R::debug(true);
			$this->records = R::batch(
			    $this->type,
			    array_keys(R::$adapter->getAssoc(
			        $sqlCollection, $this->filter->getFilterValues())
			    )
			);
			//R::debug(false);
			//R::debug(true);
            $this->total_records = R::getCell(
                $sqlTotal, $this->filter->getFilterValues()
            );
			//R::debug(false);
			return true;
		} catch (Exception $e) {
			$this->records = array();
			return false;
		}
    }
    
    /**
     * Returns the offset calculated from the current page number and limit of rows per page.
     *
     * @param int $page
     * @param int $limit
     * @return int
     */
    protected function offset($page, $limit)
    {
        return ($page - 1) * $limit;
    }

    /**
     * Returns the id of a bean at a certain (filtered) list position or the id of
     * the current bean if the query failed.
     *
     * @uses Model_Filter::buildWhereClause()
     * @uses Model::getSql()
     * @param int $offset
     * @return mixed $idOfTheBeanAtPositionInFilteredListOrFalse
     */
    protected function id_at_offset($offset)
    {
        $offset--; //because we count page 1..2..3.. where the offset has to be 0..1..2..
        if ($offset < 0) return false;
        $where = $this->filter->buildWhereClause();
        $attributes = $this->record->getAttributes($this->layout);
        $order = $attributes[$this->order]['sort']['name'].' '.$this->dir_map[$this->dir];
    	try {
    		return R::getCell(
    		    $this->record->getSql("DISTINCT({$this->type}.id) AS id", $where, $order, $offset, 1), 
    		    $this->filter->getFilterValues()
    		);
    	} catch (Exception $e) {
    	    error_log($e);
            return false;
    	}
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
        $_SESSION['scaffold'][$this->type][$this->action]['next_action'] = $action;
    }
    
    /**
     * Returns the next_action.
     *
     * @return string $next_action
     */
    protected function getNextAction()
    {
        return $_SESSION['scaffold'][$this->type][$this->action]['next_action'];
    }
    
    /**
     * Apply a given action to a selection of beans.
     *
     * @param mixed $selection of beans on which the given action should be applied
     * @param string $action to apply
     */
    protected function applyToSelection($selection = null, $action = 'idle')
    {
        if (empty($selection)) return false;
        if ( ! is_array($selection)) return false;
        Permission::check(Flight::get('user'), $this->type, $action);
        R::begin();
        try {
            foreach ($selection as $id => $switch) {
                $record = R::load($this->type, $id);
                $record->$action();
            }
            R::commit();
            $this->notifyAbout('success', count($selection));
            return true;
        }
        catch (Exception $e) {
            R::rollback();
            $this->notifyAbout('error', count($selection));
            return false;
        }
    }
    
	/**
     * Displays the index page of a given type.
     *
     * On a GET request a list view of the beans is represented where on a POST request
     * the choosen action is applied to all selected beans of a collection.
     *
     * @param string $layout
     * @param int $page
     * @param int $order
     * @param int $dir
     */
    public function index($layout, $page, $order, $dir)
    {
        Permission::check(Flight::get('user'), $this->type, 'index');
        $this->action = 'index';
        $this->layout = $layout;
        $this->page = $page;
        $this->order = $order;
        $this->dir = $dir;
        //$this->template = "model/{$this->type}/{$this->layout}";
        $this->template = "scaffold/{$this->layout}";
		if (Flight::request()->method == 'POST') {
		    //clear filter?
		    if (Flight::request()->data->submit == I18n::__('filter_submit_clear')) {
                R::trash($this->filter);
                $_SESSION['scaffold'][$this->type]['filter']['id'] = 0;
                $this->redirect("{$this->base_url}/{$this->type}/{$this->layout}");
            }
            //refresh filter
		    if (Flight::request()->data->submit == I18n::__('filter_submit_refresh')) {
                $this->filter = R::graph(Flight::request()->data->filter, true);
                try {
                    R::store($this->filter);
                    $_SESSION['scaffold'][$this->type]['filter']['id'] = $this->filter->getId();
                    $this->redirect("{$this->base_url}/{$this->type}/{$this->layout}");
                } catch (Exception $e) {
                    Flight::get('user')->notify(I18n::__('action_filter_error', null, array(), 'error'));
                }
            }
            //handle a selection
            $this->selection = Flight::request()->data->selection;
            if ($this->applyToSelection($this->selection[$this->type], 
                                                Flight::request()->data->next_action)) {
                $this->redirect("{$this->base_url}/{$this->type}/");
            }
        }
        $this->getCollection();
        if ($this->total_records == 0) {
            if (Permission::check(Flight::get('user'), $this->type, 'add')) {
                Flight::get('user')->notify(I18n::__('scaffold_no_records_add_one'));
                //return $this->add($this->layout);//this would not work because we dont set form action
                $this->redirect("{$this->base_url}/{$this->type}/add/{$this->layout}");
            }
        }
        
        $this->pagination = new Pagination(
            Url::build("{$this->base_url}/{$this->type}/"),
            $this->page,
            $this->limit,
            $this->layout,
            $this->order,
            $this->dir,
            $this->total_records
        );
        
		$this->render();
    }

    /**
     * Displays page to add a new bean of given type.
     *
     * On a GET request a form is represented that has to be filled in by the client. On a POST
     * request a new bean is created and the client is redirected to a choosen next url.
     *
     * @param string $layout
     */
    public function add($layout)
    {
        Permission::check(Flight::get('user'), $this->type, 'add');
        $this->layout = $layout;
        $this->action = 'add';
        $this->template = "model/{$this->type}/add";
        if ( ! Flight::view()->exists($this->template)) {
            // if there is no special "add" template, we fallback to "edit"
            $this->template = "model/{$this->type}/edit";
        }
		if (Flight::request()->method == 'POST') {
            $this->record = R::graph(Flight::request()->data->dialog, true);
            $this->setNextAction(Flight::request()->data->next_action);
            if ($this->doRedbeanAction()) {
                if ($this->getNextAction() == 'add') {
                    $this->redirect("{$this->base_url}/{$this->type}/add/{$this->layout}/");
                } elseif ($this->getNextAction() == 'edit') {
                    $this->redirect("{$this->base_url}/{$this->type}/edit/{$this->record->getId()}/1/0/0/");
                }
                $this->redirect("{$this->base_url}/{$this->type}/{$this->layout}/");
            }
        }
		$this->render();
    }

    /**
     * Displays page to edit an existing bean.
     *
     * On a GET request a form is presented to edit the bean. On a POST request the changed bean
     * is stored and the client is redirected.
     *
     * @param int $page
     * @param int $order
     * @param int $dir
     * @param string $layout
     */
    public function edit($page, $order, $dir, $layout)
    {
        Permission::check(Flight::get('user'), $this->type, 'read');
        $this->action = 'edit';
        $this->page = $page;
        $this->order = $order;
        $this->dir = $dir;
        $this->layout = $layout;
        $this->template = "model/{$this->type}/edit";
		if (Flight::request()->method == 'POST') {
		    Permission::check(Flight::get('user'), $this->type, 'edit');//check for edit perm now
            $this->record = R::graph(Flight::request()->data->dialog, true);
            $this->setNextAction(Flight::request()->data->next_action);
            if ($this->doRedbeanAction()) {
                if ($this->getNextAction() == 'edit') {
                    $this->redirect("{$this->base_url}/{$this->type}/edit/{$this->record->getId()}/{$this->page}/{$this->order}/{$this->dir}/{$this->layout}/");
                } elseif ($this->getNextAction() == 'next_edit' && 
                                                $next_id = $this->id_at_offset($this->page + 1)) {
                    $next_page = $this->page + 1;
                    $this->redirect("{$this->base_url}/{$this->type}/edit/{$next_id}/{$next_page}/{$this->order}/{$this->dir}/{$this->layout}/");
                } elseif ($this->getNextAction() == 'prev_edit' && 
                                                $prev_id = $this->id_at_offset($this->page - 1)) {
                        $prev_page = $this->page - 1;
                        $this->redirect("{$this->base_url}/{$this->type}/edit/{$prev_id}/{$prev_page}/{$this->order}/{$this->dir}/{$this->layout}/");
                }
                $this->redirect("{$this->base_url}/{$this->type}/{$this->layout}/");
            }
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
	    Flight::render('shared/notification', array(), 'notification');
	    //
        Flight::render('shared/navigation/account', array(), 'navigation_account');
		Flight::render('shared/navigation/main', array(), 'navigation_main');
        Flight::render('shared/navigation', array(), 'navigation');
        Flight::render('scaffold/toolbar', array(
            'base_url' => $this->base_url,
            'type' => $this->type,
            'layout' => $this->layout,
            'page' => $this->page,
            'order' => $this->order,
            'dir' => $this->dir
        ), 'toolbar');
		Flight::render('shared/header', array(), 'header');
		Flight::render('shared/footer', array(
		    'pagination' => $this->pagination
		), 'footer');
		Flight::render($this->template, array(
		    'filter' => $this->filter,
            'record' => $this->record,
			'records' => $this->records,
			'selection' => $this->selection,
			'total_records' => $this->total_records,
			'dir_map' => $this->dir_map
        ), 'form_details');
        Flight::render('scaffold/form', array(
            'actions' => $this->record->getActions(),
            'current_action' => $this->action,
            'next_action' => $this->getNextAction(),
            'record' => $this->record,
			'records' => $this->records
        ), 'content');
        Flight::render('html5', array(
            'title' => I18n::__("scaffold_head_title_{$this->action}", null, array(
                I18n::__("domain_{$this->type}")
            )),
            'language' => Flight::get('language')
        ));
	}
}
