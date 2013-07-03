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
<!-- cms index page -->
<article>
	<header>
    	<h1><?php echo I18n::__('cms_h1') ?></h1>
    	<nav>
            <?php echo $toolbar ?>
        </nav>
	</header>
	
	<!-- cms -->
	<div
	    id="cms-container"
	    class="row">
    	<!-- sitemap -->
    	<div
    	    id="sitemap"
    	    class="span2">
    	    <?php echo $sitemap ?>
    	</div>    
        <!-- end of sitemap -->
        <!-- content -->
        <div
            id="content-container"
            class="span10">
            <!-- pages and page placeholder -->
        	<p class="sitemap-choose"><?php echo I18n::__('cms_choose_a_node') ?></p>
        	<!-- end of pages and page placeholder -->
        </div>
        <!-- end of content -->
	</div>
	<!-- end of cms -->
	
</article>
<!-- End of cms index page -->
