<?php
/**
 * Cinnebar.
 *
 * My lightweight no-framework framework written in PHP.
 *
 * @package Cinnebar
 * @author $Author$
 * @version $Id$
 */

/**
 * Manages hierarchical menus.
 *
 * Parts of this code was taken from {@link http://coreyworrell.com}.
 *
 * @todo Fuzzy check of current url, e.g. /token/index should be active when /token/index/x/y is the url
 *
 * @package Cinnebar
 * @subpackage Menu
 * @version $Id$
 */
class Menu
{
    /**
     * Holds the current menu item.
     *
     * @var mixed
     */
    public $current = null;
    
    /**
     * Holds the attributes.
     *
     * @var mixed
     */
    public $attrs = null;

    /**
     * Container for templates.
     *
     * @var array 
     */
    public $templates = array(
        'list-open' => '<ul%s>',
        'item-open' => '<li %s %s><a href="%s">%s</a>', // id | class | url | linktext
        'item-close' => '</li>',
        'list-close' => '</ul>'
    );

    /**
     * Container for menu entries.
     *
     * @var array
     */
    public $items = array();
    
    /**
     * Renders the menu when echoed or printed.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
    
    /**
     * Sets a certain template string.
     *
     * @param string $name
     * @param string $template
     * @return $this for chaining
     */
    public function setTemplate($name, $template)
    {
        $this->templates[$name] = $template;
        return $this;
    }
    
    /**
     * Add a item to the menu.
     *
     * @param string $title
     * @param string $url
     * @param string $class
     * @param Menu (optional) $sub
     * @param string (optional) $id
     * @return $this
     */
    public function add($title, $url, $class = null, Menu $sub = null, $id = null)
    {
        $this->items[] = array(
            'id' => $id,
            'class' => $class,
            'title' => $title,
            'url' => $url,
            'children' => is_object($sub) ? $sub->items : null
        );
        return $this;
    }
    
	/**
	 * Renders the HTML output for the menu
	 *
	 * @param array $attrs associative array of html attributes
	 * @param array $current associative array containing the key and value of current url
	 * @param array $items the parent item's array, only used internally
	 * @return string HTML unordered list
	 */
	public function render(array $attrs = null, $current = null, array $items = null)
	{
		static $i;
		
		$items = empty($items) ? $this->items : $items;
		$current = empty($current) ? $this->current : $current;
		$attrs = empty($attrs) ? $this->attrs : $attrs;
		
		$i++;
		$menu = sprintf($this->templates['list-open'], ($i == 1 ? self::glue($attrs) : null));
		
		foreach ($items as $key => $item)
		{
			$has_children =  ! empty($item['children']);
			
			$class = array($item['class']);
			
			$has_children ? $class[] = 'parent sm2_liOpen' : null;
			
			if ( ! empty($current))
			{
				if ($current_class = self::current($current, $item))
				{
					$class[] = $current_class;
				}
			}
			$classes = ! empty($class) ? self::glue(array('class' => implode(' ', $class))) : null;
			$id = null;
			if (isset($item['id']) && $item['id']) $id = ' id="'.$item['id'].'"';
			$menu .= sprintf($this->templates['item-open'], $id, $classes, $item['url'], $item['title']);
			$menu .= $has_children ? $this->render(null, $current, $item['children']) : null;
			$menu .= $this->templates['item-close'];
		}
		
		$menu .= $this->templates['list-close'];
		
		$i--;
		
		return $menu;
	}
	
	/**
	 * Figures out if items are parents of the active item.
	 *
	 * @param array $current the current url array (key, match)
	 * @param array $item the array to check against
	 * @return bool
	 */
	protected static function current($current, array $item)
	{
		if ($current === $item['url']) {
			return 'active current';
		} else {
		    if (self::active($item, $current, 'url')) return 'active';
		}
		return '';
	}
	
	/**
	 * Recursive function to check if active item is child of parent item
	 *
	 * @param array $array the list item
	 * @param string $value the current active item
	 * @param string $key to match current against
	 * @return bool
	 */
	public static function active($array, $value, $key)
	{
		foreach ($array as $val) {
			if (is_array($val)) {
				if (self::active($val, $value, $key)) return true;
			} else {
				if ($array[$key] === $value) return true;
			}
		}
		return false;
	}
	
    /**
     * Glues together an array of key/values as a string and returns it.
     *
     * Usage Example:
     * <code>
     * <?php
     * $text = glue(array('title' => 'Test', 'lenght' => '4'));
     * ?>
     * </code>
     *
     * @param mixed (required) $dict
     * @param string (optional) $glueOpen
     * @param string (optional) $glueClose
     * @param string (optional) $pre
     * @param string (optional) $impChar
     * @return string $gluedString
     */
    public static function glue($dict, $glueOpen = '="', $glueClose = '"', $pre = ' ', $impChar = ' ')
    {
    	if (empty($dict)) return '';
    	$stack = array();
    	foreach ($dict as $key=>$value) {
    		$stack[] = $key.$glueOpen.htmlspecialchars($value).$glueClose;
    	}
    	return $pre.implode($impChar, $stack);
    }
}
