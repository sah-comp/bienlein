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
 * Model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model extends RedBean_SimpleModel
{
    /**
     * Container for the validators.
     *
     * @var array
     */
    protected $validators = array();
    
    /**
     * Container for the converters.
     *
     * @var array
     */
    protected $converters = array();
    
    /**
     * Container for the errors.
     *
     * @var array
     */
    protected $errors = array();
    
    /**
     * Holds the auto tag status.
     *
     * @var bool
     */
    protected $auto_tag = false;
    
    /**
     * Holds the auto info status.
     *
     * @var bool
     */
    protected $auto_info = false;
    
    /**
     * Returns automatic keywords for this bean.
     *
     * @param array (optional) $tags which the user may has entered
     * @return array
     */
    public function keywords()
    {
        return array(
            $this->bean->getId()
        );
    }
    
    /**
     * Returns or sets the auto tag flag.
     *
     * @param bool (optional) $switch
     * @return bool
     */
    public function autoTag($switch = null)
    {
        if ($switch !== null) $this->auto_tag = $switch;
        return $this->auto_tag;
    }
    
    /**
     * Returns or sets the auto info flag.
     *
     * @param bool (optional) $switch
     * @return bool
     */
    public function autoInfo($switch = null)
    {
        if ($switch !== null) $this->auto_info = $switch;
        return $this->auto_info;
    }

    /**
     * Returns a *i18n bean for this bean.
     *
     * A i18n bean means an internationalized version of a bean where the localizeable fields
     * are stored in a bean that extends the original beans name with the string 'i18n'.
     * If there is no i18n version for the asked language then the default language is
     * looked up and duplicated.
     *
     * @param string $language iso code of the wanted language
     * @return RedBean_OODBBean
     */
    public function i18n($language)
    {
        $i18nType = $this->bean->getMeta('type').'i18n';
        if ( ! $i18n = R::findOne($i18nType, $this->bean->getMeta('type').'_id = ? AND language = ?', array($this->bean->getId(), $language))) {
            $i18n = R::dispense($i18nType);
            $i18n->language = $language;
            $i18n->name = $this->bean->name;
        }
        return $i18n;
    }
    
    /**
     * Update.
     */
    public function update()
    {
        $this->convert();
        $this->validate();
    }
    
    /**
     * This is called after the bean was updated.
     *
     * @return void
     */
    public function after_update()
    {
        if ($this->autoInfo()) $this->addInfo();
        if ($this->autoTag()) $this->setAutoTags();
    }
    
    /**
     * Create a new info bean and associate it with this bean.
     *
     * If there is a current user with a valid session that guy is linked as a user, otherwise
     * the user relation of the auto info bean is NULL.
     *
     * @return RedBean_OODBean $info
     */
    protected function addInfo()
    {
        if ( ! $this->bean->getId()) return false;
        $info = R::dispense('info');
        $user = R::dispense('user')->current();
        if ($user->getId()) $info->user = $user;
        $info->stamp = time();
        R::store($info);
        R::associate($this->bean, $info);
        return $info;
    }
    
    /**
     * setAutoTags()
     *
     * @uses keywords()
     * @return array $tags
     */
    protected function setAutoTags()
    {
        if ( ! $this->bean->getId()) return false;
        $tags = array();
        foreach ($this->keywords() as $n=>$keyword) {
            if (trim($keyword) == '') continue;
            $tags[] = trim($keyword);
        }
        R::tag($this->bean, $tags);
        return $tags;
    }

    /**
     * Adds an error to the general errors or to a certain attribute if the optional parameter is set.
     *
     * @param string $errorText
     * @param string (optional) $attribute
     * @return void
     */
    public function addError($errorText, $attribute = '')
    {
        $this->errors[$attribute][] = $errorText;
    }
    
    /**
     * Returns the errors of this model.
     *
     * @return array $errors
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * Returns true if model has errors.
     *
     * If the optional parameter is set a certain attribute is tested for having an error or not.
     *
     * @uses Cinnebar_Model::$errors
     * @param string (optional) $attribute
     * @return bool $hasErrorOrHasNoError
     */
    public function hasError($attribute = '')
    {
        if ($attribute === '') return ! empty($this->errors);
        return isset($this->errors[$attribute]);
    }

    /**
     * Alias for {@link hasError()} call without an special attribute.
     *
     * @return bool $hasErrorsOrNone
     */
    public function hasErrors()
    {
        return $this->hasError();
    }

    /**
     * Add a validator to the attribute.
     *
     * @param string $attribute
     * @param mixed $validator
     *
     * @return Model $this
     */
    public function addValidator($attribute, $validator)
    {
        if ( ! is_array($validator)) $validator = array($validator);
        foreach ($validator as $oneValidator) {
            $this->validators[$attribute][] = $oneValidator;
        }
        return $this;
    }

    /**
     * Returns true or false wether the model validates or not.
     *
     * @return bool
     */
    public function validate()
    {
        if (empty($this->validators)) return true;
        $valid = true;
        foreach ($this->validators as $attribute => $attributeValidators) {
            foreach ($attributeValidators as $validator) {
                $valid = $validator->validate($this->bean->$attribute);
            }
        }
        return $valid;
    }
    
    /**
     * Add a converter to the attribute.
     *
     * @param string $attribute
     * @param mixed $converter
     *
     * @return Model $this
     */
    public function addConverter($attribute, $converter)
    {
        if ( ! is_array($converter)) $converter = array($converter);
        foreach ($converter as $oneConverter) {
            $this->converters[$attribute][] = $oneConverter;
        }
        return $this;
    }

    /**
     * Runs all converters of this model.
     *
     * @return void
     */
    public function convert()
    {
        if (empty($this->converters)) return;
        foreach ($this->converters as $attribute => $attributeConverters) {
            foreach ($attributeConverters as $converter) {
                $this->bean->$attribute = $converter->convert($this->bean->$attribute);
            }
        }
        return;
    }
}
