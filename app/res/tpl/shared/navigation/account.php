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
<!-- account menu -->
<ul class="account-navigation clearfix">
    <li>
        <a
            href="<?php echo Url::build('/account/') ?>">
			<img
				src="<?php echo Gravatar::src(Flight::get('user')->email, 16) ?>"
				width="16"
				height="16"
				alt="<?php echo htmlspecialchars(Flight::get('user')->name) ?>" />
			<?php echo htmlspecialchars(Flight::get('user')->getName()) ?>
        </a>
    </li>
    <li>
        <a
            href="<?php echo Url::build('/logout/') ?>">
            <?php echo I18n::__('account_logout_nav') ?>
        </a>
    </li>
    <li>
        <?php Flight::render('shared/navigation/langchooser'); ?>
    </li>
</ul>
<!-- End of account menu -->
