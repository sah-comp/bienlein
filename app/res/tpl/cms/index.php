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
	
	<ul id="websites">
	    <!-- main navigation -->
        <?php foreach ($records as $_id => $_record): ?>
        <li>
            <a
                href="<?php echo Url::build('/cms/node/%d', array($_record->getId())) ?>">
            <?php echo $_record->i18n(Flight::get('user')->getLanguage())->name ?>
            </a>
        </li>
        <?php endforeach ?>
        <!-- End of admin navigation -->
	</ul>
	
</article>
<!-- End of cms index page -->
