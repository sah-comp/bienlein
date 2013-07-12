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
<!-- module edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('module_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="module-name">
            <?php echo I18n::__('module_label_name') ?>
        </label>
        <input
            id="module-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('enabled')) ? 'error' : ''; ?>">
        <input
            type="hidden"
            name="dialog[enabled]"
            value="0" />
        <input
            id="module-enabled"
            type="checkbox"
            name="dialog[enabled]"
            <?php echo ($record->enabled) ? 'checked="checked"' : '' ?>
            value="1" />
        <label
            for="module-enabled"
            class="cb">
            <?php echo I18n::__('module_label_enabled') ?>
        </label>
    </div>
</fieldset>
<div class="tab-container">
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'module-tabs',
        'tabs' => array(
            'module-backend' => I18n::__('module_backend_tab'),
            'module-frontend' => I18n::__('module_frontend_tab')
        ),
        'default_tab' => 'module-backend'
    )) ?>
    <fieldset
        id="module-backend"
        class="tab"
        style="display: block;">
        <legend><?php echo I18n::__('module_legend_backend') ?></legend>
        <div class="row <?php echo ($record->hasError('backend')) ? 'error' : ''; ?>">
            <label
                for="module-backend-php"><?php echo I18n::__('module_backend_label') ?>
            </label>
            <textarea
                id="module-backend-php"
                name="dialog[backend]"
                rows="17"
                cols="60"><?php echo htmlspecialchars($record->backend) ?></textarea>
            <p class="info"><?php echo I18n::__('module_backend_info') ?></p>
        </div>
    </fieldset>
    <fieldset
        id="module-frontend"
        class="tab"
        style="display: none;">
        <legend><?php echo I18n::__('module_legend_frontend') ?></legend>
        <div class="row <?php echo ($record->hasError('frontend')) ? 'error' : ''; ?>">
            <label
                for="module-frontend-php"><?php echo I18n::__('module_frontend_label') ?>
            </label>
            <textarea
                id="module-backend-php"
                name="dialog[frontend]"
                rows="17"
                cols="60"><?php echo htmlspecialchars($record->frontend) ?></textarea>
            <p class="info"><?php echo I18n::__('module_frontend_info') ?></p>
        </div>
    </fieldset>
</div>
<!-- end of module edit form -->