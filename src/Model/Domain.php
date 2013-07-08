<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Model
 * @author $Author$
 * @version $Id$
 */

/**
 * Domain model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Domain extends Model
{
    /**
     * Returns an array with attributes for lists.
     *
     * @param string (optional) $layout
     * @return array
     */
    public function getAttributes($layout = 'table')
    {
        return array(
            array(
                'name' => 'name',
                'sort' => array(
                    'name' => 'domain.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'url',
                'sort' => array(
                    'name' => 'domain.url'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'sequence',
                'sort' => array(
                    'name' => 'domain.sequence'
                ),
                'class' => 'number',
                'filter' => array(
                    'tag' => 'number'
                )
            ),
            array(
                'name' => 'invisible',
                'sort' => array(
                    'name' => 'domain.invisible'
                ),
                'callback' => array(
                    'name' => 'boolean'
                ),
                'filter' => array(
                    'tag' => 'bool'
                )
            )
        );
    }
    
    /**
     * Returns either an array with rendered content or false if domain has no content.
     *
     * @param string $language
     * @return mixed either false or an array for use with template
     */
    public function getContent($language)
    {
        $pages = $this->getPages($language);
        if (empty($pages)) return false;
        R::preload($pages, array('template'));
        $first_page = reset($pages);
        $template_data = array(
            'mytemplate' => $first_page->template->name,
            'domain' => $this->bean,
            'title' => $first_page->name,
            'language' => $language,
            'meta_keywords' => $first_page->keywords,
            'meta_description' => $first_page->desc
        );
        //load the contents and push it into our template data
        foreach ($pages as $id => $page) {
            foreach ($page->template->ownRegion as $region_id => $region) {
                $slices = $page->getSlicesByRegion($region_id, false);
                foreach ($slices as $slice_id => $slice) {
                    if ( ! isset($template_data[mb_strtolower($region->name)])) {
                        $template_data[mb_strtolower($region->name)] = '';
                    }
                    ob_start();
                    $slice->render('frontend');
                    $content = ob_get_contents();
                    ob_end_clean();
                    if (($slice->css || $slice->class) && ! $slice->tag) {
                        //make it a div tag if we have css or class
                        $slice->tag = 'div';
                    }
                    if ($slice->tag) {
                        $content = sprintf('<%1$s class="%2$s" style="%3$s">'.$content.'</%1$s>', $slice->tag, $slice->class, $slice->css)."\n";
                    }
                    $template_data[mb_strtolower($region->name)] .= $content;
                }
            }
        } 
        return $template_data;       
    }
    
    /**
     * Returns an array with page beans.
     *
     * @param string $language
     * @param int (optional) $invisible
     * @return array
     */
    public function getPages($language, $invisible = 0)
    {
        return R::find('page', 'domain_id = ? AND language = ? AND invisible = ? ORDER BY sequence', array(
            $this->bean->getId(),
            $language,
            $invisible
        ));
    }
    
    /**
     * Returns the permission bean for the given method name.
     *
     * @param string $method_name
     * @return RedBean_OODBBean $permission
     */
    public function getPermission($method_name)
    {
        if ( ! $permission = R::findOne('permission', ' method = ? AND domain_id = ?', array(
            $method_name,
            $this->bean->getId()
        ))) {
            $permission = R::dispense('permission');
        }
        return $permission;
    }
    
    /**
     * Builds a hierarchical menu from an adjancy bean.
     *
     * @todo get rid of ugly signature
     *
     * @param string (optional) $url_prefix as a kind of basehref, e.g. 'http://localhost/s/de'
     * @param string (optional) $lng code of the language to retrieve
     * @param bool (optional) $invisibles default to false so that invisible beans wont show up
     * @param string (optional) $attr
     * @param mixed (optional) $break at which level
     * @param string (optional) $orderclause defaults to 'sequence'
     * @param int (optional) $level the current depth of the hierarchical menu
     * @return Cinnebar_Menu
     */
    public function hierMenu($url_prefix = '', $lng = null, $invisible = false, 
                            $attr = 'url', $break = null, $order = 'sequence ASC', $level = 0)
    {
        $level++;
        $sql_invisible = 'AND invisible != 1';
        if ($invisible) {
            $sql_invisible = null;
        }
        $sql = sprintf(
            '%s = ? %s ORDER BY %s',
            $this->bean->getMeta('type').'_id',
            $sql_invisible, $order
        );
        $records = R::find(
            $this->bean->getMeta('type'),
            $sql,
            array($this->bean->getId())
        );
        $menu = new Menu();
        if ($break !== null && $level > $break) return $menu;
        foreach ($records as $record) {
            $menu->add(
                $record->i18n($lng)->name,
                Url::build($url_prefix.$record->{$attr}),
                $record->getMeta('type').'-'.$record->getId(),
                $record->hierMenu($url_prefix, $lng, $invisible, $attr, $break, $order, $level)
            );
        }
        return $menu;
    }
    
    /**
     * Update.
     */
    public function update()
    {
        if ($this->bean->domain_id) {
            $this->bean->domain = R::load('domain', $this->bean->domain_id);
        }
        else {
            unset($this->bean->domain);
        }
    }
    
    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->bean->invisible = false;
        //$this->bean->blessed = false;
        $this->bean->sequence = 0;
        $this->addValidator('name', array(
            new Validator_HasValue()
        ));
    }
}
