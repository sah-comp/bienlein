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
<!-- Scaffold form -->
<p>
	Form of <?php echo $record->getMeta('type') ?>s.
</p>
<pre><?php print_r($record->export()) ?></pre>
<!-- End of scaffold form -->
