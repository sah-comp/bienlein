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
<!-- Account -->
<article>
    <header>
		<h1><?php echo I18n::__('account_h1') ?></h1>
		<nav>
            <?php echo $toolbar ?>
        </nav>
    </header>
    <form
        id="form-<?php echo $record->getMeta('type') ?>"
        class="panel panel-<?php echo $record->getMeta('type') ?> action-profile"
        method="POST"
        accept-charset="utf-8"
        enctype="multipart/form-data">        
        <!-- account form -->
        <fieldset>
            <legend><?php echo I18n::__('account_legend') ?></legend>
            <div
                class="row <?php echo $record->hasError('name') ? 'error' : '' ?>">
                <label
                    for="user-name">
                    <?php echo I18n::__('user_label_name') ?>
                </label>
                <input
                    type="text"
                    id="user-name"
                    name="dialog[name]"
                    value="<?php echo htmlspecialchars($record->name) ?>"
                    required="required" />
            </div>
            <div
                class="row <?php echo $record->hasError('email') ? 'error' : '' ?>">
                <label
                    for="user-email">
                    <?php echo I18n::__('user_label_email') ?>
                </label>
                <input
                    type="email"
                    id="user-email"
                    name="dialog[email]"
                    value="<?php echo htmlspecialchars($record->email) ?>"
                    required="required" />
            </div>
            <div
                class="row <?php echo $record->hasError('shortname') ? 'error' : '' ?>">
                <label
                    for="user-shortname">
                    <?php echo I18n::__('user_label_shortname') ?>
                </label>
                <input
                    type="text"
                    id="user-shortname"
                    name="dialog[shortname]"
                    value="<?php echo htmlspecialchars($record->shortname) ?>"
                    required="required" />
            </div>
            <div
                class="row <?php echo $record->hasError('screenname') ? 'error' : '' ?>">
                <label
                    for="user-screenname">
                    <?php echo I18n::__('user_label_screenname') ?>
                </label>
                <select
                    id="user-screenname"
                    name="dialog[screenname]">
                    <?php foreach (array('name','email','shortname') as $_attr_name): ?>
                    <option
                        value="<?php echo $_attr_name ?>"
                        <?php echo ($record->screenname == $_attr_name) ? 'selected="selected"' : '' ?>>
                        <?php echo I18n::__('user_label_'.$_attr_name) ?>
                    </option>
                    <?php endforeach ?>
                </select>
            </div>
        </fieldset>
        <!-- End of account form -->
        <div class="buttons">
            <input type="submit" name="submit" value="<?php echo I18n::__('account_submit') ?>" />
        </div>
    </form>
</article>
<!-- End of Account -->
