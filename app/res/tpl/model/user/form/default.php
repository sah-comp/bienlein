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
<!-- user form -->
<article>
	<header>
		<h1><?php echo I18n::__('user_form_h1') ?></h1>
		<nav>
			<ul class="nav nav-toolbar">
				<li>
					<a
						href="<?php echo Url::build('/admin/user') ?>">
						<?php echo I18n::__('toolbar_list') ?>
					</a>
				</li>
			</ul>
		</nav>
	</header>
	<form
	    id="form-user"
	    class="dialog user"
	    method="POST"
	    action=""
	    accept-charset="utf-8">
	    <div>
	        <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
	        <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
	    </div>
	    <fieldset>
	        <legend><?php echo I18n::__('user_legend') ?></legend>
	        <div
	            class="row<?php echo $record->hasError('name') ? ' error' : '' ?>">
	            <label
	                for="user-name"
	                class="<?php echo $record->hasError('name') ? 'error' : '' ?>">
	                <?php echo I18n::__('user_name_label') ?>
	            </label>
	            <input
	                type="text"
	                id="user-name"
	                name="dialog[name]"
	                placeholder="<?php echo I18n::__('user_name_placeholder') ?>"
	                value="<?php echo htmlspecialchars($record->name) ?>"
	                required="required" />
	        </div>
	<div
	            class="row<?php echo $record->hasError('email') ? ' error' : '' ?>">
	            <label
	                for="user-email"
	                class="<?php echo $record->hasError('email') ? 'error' : '' ?>">
	                <?php echo I18n::__('user_email_label') ?>
	            </label>
	            <input
	                type="email"
	                id="user-email"
	                name="dialog[email]"
	                placeholder="<?php echo I18n::__('user_email_placeholder') ?>"
	                value="<?php echo htmlspecialchars($record->email) ?>"
	                required="required" />
	        </div>
	<div
	            class="row<?php echo $record->hasError('shortname') ? ' error' : '' ?>">
	            <label
	                for="user-shortname"
	                class="<?php echo $record->hasError('shortname') ? 'error' : '' ?>">
	                <?php echo I18n::__('user_shortname_label') ?>
	            </label>
	            <input
	                type="text"
	                id="user-shortname"
	                name="dialog[shortname]"
	                placeholder="<?php echo I18n::__('user_shortname_placeholder') ?>"
	                value="<?php echo htmlspecialchars($record->shortname) ?>"
	                required="required" />
	        </div>
	<div
	            class="row<?php echo $record->hasError('pw') ? ' error' : '' ?>">
	            <label
	                for="user-pw">
	                <?php echo I18n::__('user_pw_label') ?>
	            </label>
	            <input
	                type="password"
	                id="user-pw"
	                name="dialog[pw]"
	                value=""
	                required="required" />
	        </div>
	    </fieldset>
	    <div class="buttons">
	        <input type="submit" name="submit" value="<?php echo I18n::__('user_submit') ?>" />
	    </div>
	</form>
</article>
<!-- End of user form -->
