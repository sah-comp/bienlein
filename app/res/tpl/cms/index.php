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
	
	<div id="websites">
	    <!-- main navigation -->
        <?php echo Flight::sitesfolder()
                            ->hierMenu('/cms/node/', Flight::get('user')->getLanguage(), true, 'id')
                            ->render(array('class' => 'sitemap-navigation clearfix'));
        ?>
        <!-- End of admin navigation -->
	</div>
	
</article>
<!-- End of cms index page -->
