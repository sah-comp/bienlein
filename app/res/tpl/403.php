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
<!-- Error 403 article -->
<article>
    <header>
    	<h1><?php echo I18n::__('http_error_403_h1') ?></h1>
    	<h2><?php echo I18n::__('http_error_403_h2') ?></h2>
    </header>
    <?php echo Flight::textile(I18n::__('http_error_403_article')) ?>
</article>
<!-- End of Error 403 article -->
