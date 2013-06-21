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
<header>
	<h1>
		<a
		    class="ir logo"
			href="<?php echo Url::build('/') ?>">
			<?php echo I18n::__('app_header_h1') ?>
		</a>
	</h1>
	<h2 class="visuallyhidden"><?php echo I18n::__('app_header_h2') ?></h2>
	<?php echo $navigation ?>
</header>
