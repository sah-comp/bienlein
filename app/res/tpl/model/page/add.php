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
<!-- page add form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
    <input type="hidden" name="dialog[language]" value="<?php echo $record->language ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('page_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="page-name">
            <?php echo I18n::__('page_label_name') ?>
        </label>
        <input
            id="page-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
</fieldset>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('page_legend_meta') ?></legend>
    <div class="row <?php echo ($record->hasError('template_id')) ? 'error' : ''; ?>">
        <label
            for="page-template">
            <?php echo I18n::__('page_label_template') ?>
        </label>
        <select
            id="page-template"
            name="dialog[template_id]"
            required="required">
            <option value=""><?php echo I18n::__('page_template_none') ?></option>
            <?php foreach (R::findAll('template') as $_id => $_template): ?>
            <option
                value="<?php echo $_template->getId() ?>"
                <?php echo ($record->template_id == $_template->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_template->name) ?></option>   
            <?php endforeach ?>
        </select>
    </div>
    <div class="row">
        <label
            for="page-domain"
            class="<?php echo ($record->hasError('domain_id')) ? 'error' : ''; ?>">
            <?php echo I18n::__('page_label_domain') ?>
        </label>
        <select
            id="page-domain"
            name="dialog[domain_id]">
            <option value=""><?php echo I18n::__('page_domain_none') ?></option>
            <?php foreach (R::findAll('domain') as $_id => $_domain): ?>
            <option
                value="<?php echo $_domain->getId() ?>"
                <?php echo ($record->domain_id == $_domain->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_domain->i18n(Flight::get('language'))->name) ?></option>   
            <?php endforeach ?>
        </select>
    </div>
    <div class="row <?php echo ($record->hasError('url')) ? 'error' : ''; ?>">
        <label
            for="page-url">
            <?php echo I18n::__('page_label_url') ?>
        </label>
        <input
            id="page-url"
            type="text"
            name="dialog[url]"
            value="<?php echo htmlspecialchars($record->url) ?>" />
    </div>
    <div class="row <?php echo ($record->hasError('invisible')) ? 'error' : ''; ?>">
        <input
            type="hidden"
            name="dialog[invisible]"
            value="0" />
        <input
            id="domain-invisible"
            type="checkbox"
            name="dialog[invisible]"
            <?php echo ($record->invisible) ? 'checked="checked"' : '' ?>
            value="1" />
        <label
            for="domain-invisible"
            class="cb">
            <?php echo I18n::__('page_label_invisible') ?>
        </label>
    </div>
    <div class="row">
        <label
            for="page-sequence"
            class="<?php echo ($record->hasError('sequence')) ? 'error' : ''; ?>">
            <?php echo I18n::__('page_label_sequence') ?>
        </label>
        <input
            id="page-sequence"
            type="number"
            min="0"
            step="10"
            max="99999999"
            name="dialog[sequence]"
            value="<?php echo htmlspecialchars($record->sequence) ?>" />
    </div>
    <div class="row">
        <label
            for="page-keywords"
            class="<?php echo ($record->hasError('keywords')) ? 'error' : ''; ?>">
            <?php echo I18n::__('page_label_keywords') ?>
        </label>
        <textarea
            id="page-keywords"
            class="scaleable"
            name="dialog[keywords]"
            cols="60"
            rows="2"><?php echo htmlspecialchars($record->keywords) ?></textarea>
    </div>
    <div class="row">
        <label
            for="page-description"
            class="<?php echo ($record->hasError('desc')) ? 'error' : ''; ?>">
            <?php echo I18n::__('page_label_desc') ?>
        </label>
        <textarea
            id="page-description"
            class="scaleable"
            name="dialog[desc]"
            cols="60"
            rows="8"><?php echo htmlspecialchars($record->desc) ?></textarea>
    </div>
</fieldset>
<!-- end of page add form -->