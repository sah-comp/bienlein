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
<!-- Error 404 article -->
<article>
    <article>
        <header>
        	<h1><?php echo I18n::__('http_error_404_h1') ?></h1>
        	<h2><?php echo I18n::__('http_error_404_h2') ?></h2>
        </header>
        <?php echo Flight::textile(I18n::__('http_error_404_article')) ?>
    </article>
</article>
<!-- End of Error 404 article -->
