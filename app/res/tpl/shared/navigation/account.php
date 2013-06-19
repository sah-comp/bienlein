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
<ul class="account-navigation">
    <li>
        <a
            href="<?php echo Url::build('/account/') ?>">
			<figure
				class="gravatar inline">
				<img
					src="<?php echo Gravatar::src(Flight::get('user')->email, 16) ?>"
					width="16"
					height="16"
					alt="<?php echo Flight::get('user')->name ?>" />
				<figcaption>
					<?php echo Flight::get('user')->name ?>
				</figcaption>
			</figure>
        </a>
    </li>
    <li>
        <a
            href="<?php echo Url::build('/logout/') ?>">
            <?php echo I18n::__('user_logout_nav') ?>
        </a>
    </li>
</ul>
<!-- End of account menu -->
