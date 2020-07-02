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
 * Token cache manager.
 */
class TokenCache {
	/**
	 * Holds which language file will be created. Defaults to empty.
	 * If this parameter is empty, all active languages will be created as files.
	 */
	public $language = '';

	/**
	 * Constructor.
	 *
	 * @param mixed $language
	 */
	public function __construct($language = null)
	{
		$this->language = $language;
	}

	/**
	 * Runs the token cache creator.
	 */
	public function run()
	{
		if (!$this->language) {
			$languages = ['de', 'en', 'us', 'pt'];//gather all active languages
			foreach ($languages as $language) {
				$this->language = $language;
				$this->create();
			}
		} else {
			$this->create();
		}
	}

	/**
	 * Generates a file for a certain language.
	 *
	 * @return bool
	 */
	public function create()
	{
		echo "Created cache file for language \"{$this->language}\"." . PHP_EOL;
		return true;
	}
}

/**
 * Define our command line interface using docopt.
 */
$doc = <<<DOC
Create token cache files.

Usage:
  token-cache.php [--language=<iso>]
  token-cache.php (-h | --help)
  token-cache.php --version

Options:
  -h --help     Show this screen.
  --version     Show version.

DOC;

require '../vendor/docopt/docopt/src/docopt.php';

$args = Docopt::handle($doc, ['version' => 'Token-Cache 1.0']);

$tokenCache = new TokenCache($args['--language']);
$tokenCache->run();
