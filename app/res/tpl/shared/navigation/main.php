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
<!-- main navigation -->
<ul class="nav nav-main">
    <li>
        <a
            href="<?php echo Url::build('/admin/') ?>">
            <?php echo I18n::__('admin_index_nav') ?>
        </a>
		<ul>
			<li>
		        <a
		            href="<?php echo Url::build('/admin/user/') ?>">
		            <?php echo I18n::__('admin_user_nav') ?>
		        </a>
		    </li>
		</ul>
    </li>
</ul>
<!-- End of admin navigation -->
