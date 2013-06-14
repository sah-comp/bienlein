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
                <?php echo I18n::__('user_account_nav') ?>
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
                href="<?php echo Url::build('/admin/index/') ?>">
                <?php echo I18n::__('admin_index_nav') ?>
            </a>
        </li>
        <li>
            <a
                href="<?php echo Url::build('/admin/user/') ?>">
                <?php echo I18n::__('admin_user_nav') ?>
            </a>
        </li>
    </ul>
</nav>
<!-- End of admin navigation -->
