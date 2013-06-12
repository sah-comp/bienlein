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
