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
<ul class="panel-navigation">
	<li>
		<a
			href="<?php echo Url::build("/account/") ?>">
			<?php echo I18n::__('account_index_nav') ?>
		</a>
	</li>
	<li>
		<a
			href="<?php echo Url::build("/account/changepassword/") ?>">
			<?php echo I18n::__('account_changepassword_nav') ?>
		</a>
	</li>
</ul>
