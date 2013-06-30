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
<!-- Login -->
<article>
    <header>
		<h1><?php echo I18n::__('login_h1') ?></h1>
    </header>
    <form
        id="form-login"
        class="panel login"
        method="POST"
        accept-charset="utf-8">
        <div>
            <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
            <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
            <input type="hidden" name="goto" value="<?php echo $goto ?>" />
        </div>
        <fieldset>
            <legend><?php echo I18n::__('login_legend') ?></legend>
            <div
                class="row <?php echo $record->hasError('uname') ? 'error' : '' ?>">
                <label
                    for="login-username">
                    <?php echo I18n::__('login_label_username') ?>
                </label>
                <input
                    type="text"
                    id="login-username"
                    name="dialog[uname]"
                    value="<?php echo htmlspecialchars($record->uname) ?>"
                    required="required"
 					autofocus="autofocus" />
            </div>
            <div
                class="row <?php echo $record->hasError('pw') ? 'error' : '' ?>">
                <label
                    for="login-password">
                    <?php echo I18n::__('login_label_password') ?>
                </label>
                <input
                    type="password"
                    id="login-password"
                    name="dialog[pw]"
                    value=""
                    required="required" />
            </div>
        </fieldset>
        <div class="buttons">
            <input type="submit" name="submit" value="<?php echo I18n::__('login_submit') ?>" />
        </div>
    </form>
</article>
<!-- End of Login -->
