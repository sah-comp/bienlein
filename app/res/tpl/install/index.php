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
<!-- Install -->
<article>
    <header>
		<h1><?php echo I18n::__('install_h1') ?></h1>
    </header>
    <form
        id="form-install"
        class="dialog install"
        method="POST"
        action=""
        accept-charset="utf-8">
        <div>
            <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
            <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
            <input type="hidden" name="dialog[isadmin]" value="1" />
        </div>
        <fieldset>
            <legend><?php echo I18n::__('install_legend') ?></legend>
            <div
                class="row">
                <label
                    for="install-pass">
                    <?php echo I18n::__('install_pass_label') ?>
                </label>
                <input
                    type="password"
                    id="install-pass"
                    name="pass"
                    required="required" />
            </div>
        </fieldset>
        <fieldset>
            <legend><?php echo I18n::__('install_user_legend') ?></legend>
            <div
                class="row<?php echo $record->hasError('email') ? ' error' : '' ?>">
                <label
                    for="install-email">
                    <?php echo I18n::__('install_email_label') ?>
                </label>
                <input
                    type="email"
                    id="install-email"
                    name="dialog[email]"
                    placeholder="<?php echo I18n::__('install_email_placeholder') ?>"
                    value="<?php echo htmlspecialchars($record->email) ?>"
                    required="required" />
            </div>
            <div
                class="row<?php echo $record->hasError('name') ? ' error' : '' ?>">
                <label
                    for="install-name">
                    <?php echo I18n::__('install_name_label') ?>
                </label>
                <input
                    type="text"
                    id="install-name"
                    name="dialog[name]"
                    placeholder="<?php echo I18n::__('install_name_placeholder') ?>"
                    value="<?php echo htmlspecialchars($record->name) ?>"
                    required="required" />
            </div>
            <div
                class="row<?php echo $record->hasError('shortname') ? ' error' : '' ?>">
                <label
                    for="install-shortname">
                    <?php echo I18n::__('install_shortname_label') ?>
                </label>
                <input
                    type="text"
                    id="install-shortname"
                    name="dialog[shortname]"
                    placeholder="<?php echo I18n::__('install_shortname_placeholder') ?>"
                    value="<?php echo htmlspecialchars($record->shortname) ?>"
                    required="required" />
            </div>
            <div
                class="row<?php echo $record->hasError('pw') ? ' error' : '' ?>">
                <label
                    for="install-pw">
                    <?php echo I18n::__('install_pw_label') ?>
                </label>
                <input
                    type="password"
                    id="install-pw"
                    name="dialog[pw]"
                    value=""
                    required="required" />
            </div>
        </fieldset>
        <div class="buttons">
            <input type="submit" name="submit" value="<?php echo I18n::__('install_submit') ?>" />
        </div>
    </form>
</article>
<!-- End of Install -->
