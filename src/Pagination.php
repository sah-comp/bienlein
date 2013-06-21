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
 * Calculates and renders pagination links.
 *
 * @package Cinnebar
 * @subpackage Pagination
 * @version $Id$
 */
class Pagination
{
    /**
	 * Holds the base url to use for pagination links.
	 * 
	 * @var string
	 */
	public $url;
	
	/**
	 * Holds the order index value.
	 *
	 * @var int
	 */
	public $order;

	/**
	 * Holds the order direction.
	 *
	 * @var int
	 */
	public $dir;

	/**
	 * Holds the current page number.
	 *
	 * @var int
	 */
	public $page;
	
	/**
	 * Holds the number of maximum pages.
	 *
	 * @var int
	 */
	public $max_pages;
	
	/**
	 * Holds the number of rows per page.
	 *
	 * @var int
	 */
	public $limit;
	
	/**
	 * Holds the number or total rows.
	 *
	 * @var int
	 */
	public $total_rows;
	
	/**
	 * Holds the number of pages to adjance when skipping.
	 *
	 * @var int $adjacents
	 */
	public $adjacents = 2;
	
	/**
	 * Flag to decide wether there is a previous page or not.
	 *
	 * @var bool
	 */
	public $has_previous_page = false;
	
	/**
	 * Flag to decide wether there is a next page or not.
	 *
	 * @var bool
	 */
	public $has_next_page = false;
	
	/**
	 * Flag to decide wether to generate page links or not.
	 *
	 * @var bool
	 */
	public $page_links = true;
	
	/**
	 * Constructor.
	 *
	 * @todo Do something about the mighty signature
	 *
	 * @param string (required) $url
	 * @param int (required) $offset
	 * @param int (required) $limit
	 * @param int (required) $layout
	 * @param int (required) $order
	 * @param int (required) $dir
 	 * @param int (required) $total_rows
  	 * @param bool (optional) $page_links decides wether to build page links or not, defaults to true
	 */
	public function __construct($url, $page, $limit, $layout, $order, $dir, $total_rows, $page_links = true)
	{
		$this->url = $url;
		$this->page = $page;
		$this->limit = $limit;
		$this->layout = $layout;
		$this->order = $order;
		$this->dir = $dir;
		$this->total_rows = $total_rows;
		$this->page_links = $page_links;
	}
	
	/**
	 * Render the pagination on string output.
	 *
	 * @return string
	 */
	public function __toString()
	{
        return $this->render();
	}
	
	/**
	 * Renders the pagination links and returns a string.
	 *
	 * @return string
	 */
	public function render()
	{
		$this->calculate();
		return $this->build_html_pagination();
	}
	
	/**
	 * Calculate the pagination values.
	 */
	protected function calculate()
	{	
		if ($this->limit)
		{
			$this->max_pages = ceil($this->total_rows / $this->limit);
		}
		else
		{
			$this->max_pages = 1;
		}
		$this->page = max(1, $this->page);
		$this->page = min($this->max_pages, $this->page);
		$this->has_previous_page = $this->page > 1;
		$this->has_next_page = $this->page < $this->max_pages;
	}
	
	/**
	 * Returns a string with HTML.
	 *
	 * @return string
	 */
	protected function build_html_pagination()
	{
		if ($this->max_pages == 1)
		{
			// uups, there is only one page in total
			return '';
		}
		$s = '<ul class="pagination-navigation clearfix">'."\n";
		
		// prev page
		if ($this->has_previous_page)
		{
			// with link
			$query = array(
			    $this->layout,
				$this->page - 1,
				$this->order,
				$this->dir
			);
			$s .= '<li class="prev">'.$this->ahref($this->url.implode('/', $query), I18n::__('pagination_page_prev')).'</li>'."\n";
		}
		else
		{
			// without link
			$s .= '<li class="prev">'.I18n::__('pagination_page_prev').'</li>'."\n";
		}
		
		// digg style pagination list
		if ($this->page_links) $s .= $this->build_html_page_links();
		
		// next page
		if ($this->has_next_page)
		{
			// with link
			$query = array(
			    $this->layout,
				$this->page + 1,
				$this->order,
				$this->dir
			);
			$s .= '<li class="next">'.$this->ahref($this->url.implode('/', $query), I18n::__('pagination_page_next')).'</li>'."\n";
		}
		else
		{
			// without link
			$s .= '<li class="next">'.I18n::__('pagination_page_next').'</li>'."\n";
		}
		
		$s .= '</ul>'."\n";
		return $s;
	}
	
	/**
	 * Renders the page links and returns a string with HTML.
	 *
     * Portions of this code from {@link http://www.strangerstudios.com/sandbox/pagination/diggstyle.php}
     *
	 * @todo refactor code so DRY applies in this code
	 * @todo get rid of magic numbers
	 *
	 * @return string
	 */
	protected function build_html_page_links()
	{
		$s = '';
		if ($this->max_pages < 7 + ($this->adjacents * 2))
		{
			// not so much possible pages
	        for ($n = 1; $n <= $this->max_pages; $n++)
			{
				$s .= '<li>';
	            if ($n != $this->page)
				{
					// other than current page
					$query = array(
    				    $this->layout,
						$n,
						$this->order,
						$this->dir
					);
					$s .= $this->ahref($this->url.implode('/', $query), $n);
				}
				else
				{	
					// current page
					$s .= '<span class="current">'.$n.'</span>';
				}
				$s .= '</li>'."\n";
			}
		}
		elseif ($this->max_pages >= 7 + ($this->adjacents * 2))
		{
			// hide some pages
			if ($this->page < 1 + ($this->adjacents * 3))
			{
				// At the beginning, hide pages at the end
	            for ($n = 1; $n < 4 + ($this->adjacents * 2); $n++)
				{
					$s .= '<li>';
	                if ($n != $this->page)
					{
						// other than current page
						$query = array(
        				    $this->layout,
							$n,
							$this->order,
							$this->dir
						);
						$s .= $this->ahref($this->url.implode('/', $query), $n);
					}
					else
					{
						$s .= '<span class="current">'.$n.'</span>';
					}
					$s .= '</li>'."\n";
				}
				// ellipsis
				$s .= '<li>&#8230</li>'."\n";
				$s .= '<li>';
				$query = array(
				    $this->layout,
					$this->max_pages - 1,
					$this->order,
					$this->dir
				);
				$s .= $this->ahref($this->url.implode('/', $query), $this->max_pages - 1);				
				$s .= '</li>'."\n";
				$s .= '<li>';
				$query = array(
				    $this->layout,
					$this->max_pages,
					$this->order,
					$this->dir
				);
				$s .= $this->ahref($this->url.implode('/', $query), $this->max_pages);				
				$s .= '</li>'."\n";
			}
			elseif ($this->max_pages - ($this->adjacents * 2) > $this->page && $this->page > ($this->adjacents * 2))
			{
				
				// In the middle, hide pages beginning and end
				$s .= '<li>';
				$query = array(
				    $this->layout,
					1,
					$this->order,
					$this->dir
				);
				$s .= $this->ahref($this->url.implode('/', $query), '1');				
				$s .= '</li>'."\n";
				$s .= '<li>';
				$query = array(
				    $this->layout,
					2,
					$this->order,
					$this->dir
				);
				$s .= $this->ahref($this->url.implode('/', $query), '2');				
				$s .= '</li>'."\n";
				$s .= '<li>&#8230</li>'."\n";

	            for ($n = $this->page - $this->adjacents; $n <= $this->page + $this->adjacents; $n++)
				{
					$s .= '<li>';
	                if ($n != $this->page)
					{
						// other than current page
						$query = array(
        				    $this->layout,
							$n,
							$this->order,
							$this->dir
						);
						$s .= $this->ahref($this->url.implode('/', $query), $n);
					}
					else
					{
						$s .= '<span class="current">'.$n.'</span>';
					}
					$s .= '</li>'."\n";
				}
				
				$s .= '<li>&#8230</li>'."\n";
				
				$s .= '<li>';
				$query = array(
				    $this->layout,
					$this->max_pages - 1,
					$this->order,
					$this->dir
				);
				$s .= $this->ahref($this->url.implode('/', $query), $this->max_pages - 1);				
				$s .= '</li>'."\n";
				$s .= '<li>';
				$query = array(
				    $this->layout,
					$this->max_pages,
					$this->order,
					$this->dir
				);
				$s .= $this->ahref($this->url.implode('/', $query), $this->max_pages);				
				$s .= '</li>'."\n";
				
			}
			else
			{
				// At the end, hide pages from the beginning
				$s .= '<li>';
				$query = array(
				    $this->layout,
					1,
					$this->order,
					$this->dir
				);
				$s .= $this->ahref($this->url.implode('/', $query), '1');				
				$s .= '</li>'."\n";
				$s .= '<li>';
				$query = array(
				    $this->layout,
					2,
					$this->order,
					$this->dir
				);
				$s .= $this->ahref($this->url.implode('/', $query), '2');				
				$s .= '</li>'."\n";
				$s .= '<li>&#8230</li>'."\n";
			
	            for ($n = $this->max_pages - (1 + ($this->adjacents * 3)); $n <= $this->max_pages; $n++)
				{
					$s .= '<li>';
	                if ($n != $this->page)
					{
						// other than current page
						$query = array(
        				    $this->layout,
							$n,
							$this->order,
							$this->dir
						);
						$s .= $this->ahref($this->url.implode('/', $query), $n);
					}
					else
					{
						$s .= '<span class="current">'.$n.'</span>';
					}
					$s .= '</li>'."\n";
				}

			}
		}
		return $s;
	}
	
	/**
	 * Returns a string with an ahref tag.
	 *
	 * @param string $url
	 * @param string $text
	 * @return string
	 */
	public function ahref($url, $text)
	{
        return sprintf('<a href="%s">%s</a>', $url, $text);
	}
}
