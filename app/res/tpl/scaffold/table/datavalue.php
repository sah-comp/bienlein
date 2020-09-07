<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<?php
if (isset($attribute['callback'])):
    echo htmlspecialchars($record->{$attribute['callback']['name']}($attribute['name']));
else:
    echo htmlspecialchars($record->{$attribute['name']});
endif;
?>
