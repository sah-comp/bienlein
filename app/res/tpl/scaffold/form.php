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
<article>
    <header>
        <h1><?php echo I18n::__("{$type}_h1") ?></h1>
        <nav>
            <?php echo $toolbar ?>
        </nav>
    </header>
    <form
        id="form-<?php echo $record->getMeta('type') ?>"
        class="dialog dialog-<?php echo $record->getMeta('type') ?> action-<?php echo $current_action ?>"
        method="POST"
        action=""
        accept-charset="utf-8"
        enctype="multipart/form-data">
        
        <!-- form details -->
        <?php echo $form_details ?>
        <!-- end of form details -->
        
        <!-- Scaffold buttons -->
        <div class="buttons">
            <select name="next_action">
                <?php foreach ($actions[$current_action] as $action): ?>
                <option
                    value="<?php echo $action ?>"
                    <?php echo ($next_action == $action) ? 'selected="selected"' : '' ?>><?php echo I18n::__('action_'.$action) ?></option>
                <?php endforeach ?>
            </select>
            <input
                type="submit"
                name="submit"
                accesskey="s"
                value="<?php echo I18n::__('scaffold_submit_apply_action') ?>" />
        </div>
        <!-- End of Scaffold buttons -->
    </form>
</article>
