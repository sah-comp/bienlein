<ul class="nav nav-toolbar">
	<li>
		<a
			href="<?php echo Url::build("{$base_url}/{$type}/") ?>">
			<?php echo I18n::__('scaffold_action_list') ?>
		</a>
	</li>
	<li>
		<a
			href="<?php echo Url::build("{$base_url}/{$type}/add/") ?>">
			<?php echo I18n::__('scaffold_action_add') ?>
		</a>
	</li>
</ul>