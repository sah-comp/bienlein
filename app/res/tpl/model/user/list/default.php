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
<!-- user list -->
<article>
	<header>
		<h1><?php echo I18n::__('user_list_h1') ?></h1>
		<nav>
			<ul class="nav nav-toolbar">
				<li>
					<a
						href="<?php echo Url::build('/admin/user') ?>">
						<?php echo I18n::__('toolbar_list') ?>
					</a>
				</li>
				<li>
					<a
						href="<?php echo Url::build('/admin/user/add') ?>">
						<?php echo I18n::__('toolbar_add') ?>
					</a>
				</li>
			</ul>
		</nav>
	</header>
	<?php foreach ($records as $id => $record): ?>
	<a
		href="<?php echo Url::build('/admin/user/edit/%d', array($record->getId())) ?>">
		<figure
			id="user-<?php echo $id ?>"
			class="gravatar">
		    <img
		        src="<?php echo Gravatar::src($record->email, 64) ?>"
		        width="64"
		        height="64"
		        alt="<?php echo htmlspecialchars($record->name) ?>" />
		    <figcaption>
		        <?php echo htmlspecialchars($record->name) ?>
		    </figcaption>
		</figure>
	</a>
	<?php endforeach ?>
</article>
<!-- End of user list -->
