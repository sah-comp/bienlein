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
class TokenCache
{
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
            $languages = Flight::get('possible_languages');
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
        $tokens = [];

        $sql = <<<SQL
        SELECT
            t.name AS token,
            i.name AS translation
        FROM tokeni18n AS i
        LEFT JOIN token AS t ON t.id = i.token_id
        WHERE
            i.language = ? AND t.name IS NOT NULL
        ORDER BY
            t.name
SQL;

        $tokens = R::getAssoc($sql, [$this->language]);
        $fname = __DIR__ . '/../app/res/lng/' . $this->language . '.php';

        $content = "<?php\n";
        $content .= "\$_tokens = ";
        $content .= var_export($tokens, true);
        $content .= ";\n";
        file_put_contents($fname, $content);

        echo "Created cache file for language \"{$this->language}\" in \"{$fname}\"." . PHP_EOL;
        return true;
    }
}

/**
 * Autoloader.
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * RedbeanPHP Version .
 */
require __DIR__ . '/../lib/redbean/rb-5.5.php';
require __DIR__ . '/../lib/redbean/Plugin/Cooker.php';

/**
 * Configuration.
 */
require __DIR__ . '/../app/config/config.php';

/**
 * Bootstrap.
 */
require __DIR__ . '/../app/config/bootstrap.php';

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

require __DIR__.'/../vendor/docopt/docopt/src/docopt.php';

$args = Docopt::handle($doc, ['version' => 'Token-Cache 1.0']);

$tokenCache = new TokenCache($args['--language']);
$tokenCache->run();
