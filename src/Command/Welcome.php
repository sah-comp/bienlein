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
        echo 'Hello cli junkies.'."\n";
    }
}
