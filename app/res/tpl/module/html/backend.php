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
<fieldset>
    <legend class="verbose"><?php echo I18n::__('module_legend_html') ?></legend>
    <div class="row">
        <textarea
            name="dialog[content]"
            rows="8"
            cols="60"
            placeholder="<?php echo I18n::__('module_html_placeholder_content') ?>"><?php echo htmlspecialchars($record->content) ?></textarea>
    </div>
</fieldset>
