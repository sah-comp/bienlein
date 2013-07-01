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
            class="row span10">
            <!-- pages -->
        	<div
        	    id="pages-container"
        	    class="span3">
        	    <?php echo $pages ?>
        	</div>
        	<!-- end of pages -->
        	<!-- page -->
        	<div
        	    id="page-container"
        	    class="span9">
        	    <?php echo $page ?>
        	</div>
        	<!-- end of page -->
        </div>
        <!-- end of content -->
	</div>
	<!-- end of cms -->
	
</article>
<!-- End of cms index page -->
