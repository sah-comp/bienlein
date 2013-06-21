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
<ul class="main-navigation clearfix">
    <li class="parent">
        <a
            href="<?php echo Url::build('/admin/') ?>">
            <?php echo I18n::__('domain_admin_nav') ?>
        </a>
		<ul>
			<li>
		        <a
		            href="<?php echo Url::build('/admin/user/') ?>">
		            <?php echo I18n::__('domain_user_nav') ?>
		        </a>
		    </li>
			<li>
		        <a
		            href="<?php echo Url::build('/admin/language/') ?>">
		            <?php echo I18n::__('domain_language_nav') ?>
		        </a>
		    </li>
		    <li>
		        <a
		            href="<?php echo Url::build('/admin/country/') ?>">
		            <?php echo I18n::__('domain_country_nav') ?>
		        </a>
		    </li>
		    <li>
		        <a
		            href="<?php echo Url::build('/admin/domain/') ?>">
		            <?php echo I18n::__('domain_domain_nav') ?>
		        </a>
		    </li>
		    <li>
		        <a
		            href="<?php echo Url::build('/admin/action/') ?>">
		            <?php echo I18n::__('domain_action_nav') ?>
		        </a>
		    </li>
		    <li>
		        <a
		            href="<?php echo Url::build('/admin/role/') ?>">
		            <?php echo I18n::__('domain_role_nav') ?>
		        </a>
		    </li>
		    <li>
		        <a
		            href="<?php echo Url::build('/admin/team/') ?>">
		            <?php echo I18n::__('domain_team_nav') ?>
		        </a>
		    </li>
		    <li>
		        <a
		            href="<?php echo Url::build('/admin/token/') ?>">
		            <?php echo I18n::__('domain_token_nav') ?>
		        </a>
		    </li>
		</ul>
    </li>
</ul>
<!-- End of admin navigation -->
