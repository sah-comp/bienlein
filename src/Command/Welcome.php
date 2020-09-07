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
 * Welcome Command.
 *
 * @package Cinnebar
 * @subpackage Command
 * @version $Id$
 */
class Command_Welcome extends Command
{   
    /**
     * Run.
     */
    public function run()
    {
        echo i18n::__('cli_welcome_text').PHP_EOL;
    }
}
