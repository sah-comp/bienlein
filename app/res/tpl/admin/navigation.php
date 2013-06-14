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
    <ul>
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
