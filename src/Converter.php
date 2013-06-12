<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Converter
 * @author $Author$
 * @version $Id$
 */

/**
 * Converter.
 *
 * To add your own converter simply add a php file to the converter directory of your Cinnebar
 * installation. Name the converter after the scheme Converter_* extends Cnoverter and
 * implement a convert() method. As an example see {@link Converter_MySqlDate}.
 *
 * Example usage of the MySqlDate converter:
 * <code>
 * <?php
 * $mysqldateconverter = new Converter_MySqlDate();
 * $mysqldate = $mysqldateconverter('23.03.1984');
 * ?>
 * </code>
 *
 * @package Cinnebar
 * @subpackage Converter
 * @version $Id$
 */
class Converter
{
    /**
     * Container for the converter options.
     *
     * @var array
     */
    public $options = array();

    /**
     * Constructor.
     *
     * @param array (optional) $options
     */
    public function __construct(array $options = array()) {
        $this->options = $options;
    }

    /**
     * Returns whatever the converters has converted the input to.
     *
     * @param mixed $value
     * @return mixed $convertedValue
     */
    public function convert($value)
    {
        return $value;
    }
}
