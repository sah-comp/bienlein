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
 * Bienlein command.
 *
 * This is a command line interface (cli) stub. Please review the code to
 * learn how to write a command for Bienlein.
 *
 * To run a command call it like so:
 *
 *      php -f path/to/bienlein.php -- -h
 *
 */
class Bienlein
{
    /**
     * Constructor.
     */
    public function __construct()
    {
    }

    /**
     * Runs the token cache creator.
     */
    public function run()
    {
    }
}

/**
 * Define our command line interface using docopt.
 */
$doc = <<<DOC
Demonstrate how to use a Bienlein cli script.

Usage:
  bienlein.php (-h | --help)
  bienlein.php --version

Options:
  -h --help     Show this screen.
  --version     Show version.

DOC;

require __DIR__.'/../vendor/docopt/docopt/src/docopt.php';

$args = Docopt::handle($doc, ['version' => 'Bienlein cli 1.0']);
//$args = (new \Docopt\Handler)->handle($doc, ['version' => 'Bienlein cli 1.0']);

$bienlein = new Bienlein();
$bienlein->run();
