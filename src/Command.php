<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Command
 * @author $Author$
 * @version $Id$
 */

/**
 * Command.
 *
 * @package Cinnebar
 * @subpackage Command
 * @version $Id$
 */
class Command
{
    /**
     * Constructs a new Controller.
     */
    public function __construct()
    {
    }
    
    /**
     * Run.
     */
    public function run()
    {
        echo i18n::__('cli_command_stub_text').PHP_EOL;
    }
}
