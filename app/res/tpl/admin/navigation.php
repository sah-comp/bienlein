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
<!-- admin navigation -->
<nav>
    <ul class="nav nav-user">
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
    <ul class="nav nav-main">
        <li>
            <a
                href="<?php echo Url::build('/admin/') ?>">
                <?php echo I18n::__('admin_index_nav') ?>
            </a>
        </li>
        <li>
            <a
                href="<?php echo Url::build('/admin/user/') ?>">
                <?php echo I18n::__('admin_user_nav') ?>
            </a>
			<ul>
				<li>
					<a
		                href="<?php echo Url::build('/admin/user/add/') ?>">
		                <?php echo I18n::__('admin_user_add_nav') ?>
		            </a>
				</li>
			</ul>
        </li>
    </ul>
</nav>
<!-- End of admin navigation -->
