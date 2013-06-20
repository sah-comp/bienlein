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
			href="<?php echo Url::build('/') ?>">
			<?php echo I18n::__('app_header_h1') ?>
		</a>
	</h1>
	<h2><?php echo I18n::__('app_header_h2') ?></h2>
	<?php echo $navigation ?>
</header>
