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
<form
    id="form-page-<?php echo $page->getId() ?>-meta"
    data-container="content-container"
    class="panel inline page-meta"
    method="POST"
    action="<?php echo Url::build('/cms/meta/%d/', array($page->getId())) ?>"
    accept-charset="utf-8"
    enctype="multipart/form-data">
    <div>
        <input type="hidden" name="dialog[type]" value="page" />
        <input type="hidden" name="dialog[id]" value="<?php echo $page->getId() ?>" />
        <input type="hidden" name="dialog[language]" value="<?php echo $page->language ?>" />
        <input type="hidden" name="dialog[domain_id]" value="<?php echo $page->domain_id ?>" />
        <input type="hidden" name="dialog[sequence]" value="<?php echo $page->sequence ?>" />
    </div>
    <fieldset>
        <legend class="verbose"><?php echo I18n::__('page_legend_meta') ?></legend>
        <div class="row <?php echo ($page->hasError('name')) ? 'error' : ''; ?>">
            <label
                for="page-name">
                <?php echo I18n::__('page_label_name') ?>
            </label>
            <input
                id="page-name"
                type="text"
                name="dialog[name]"
                value="<?php echo htmlspecialchars($page->name) ?>"
                required="required" />
        </div>
        <div class="row <?php echo ($page->hasError('template_id')) ? 'error' : ''; ?>">
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
                    <?php echo ($page->template_id == $_template->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_template->name) ?></option>   
                <?php endforeach ?>
            </select>
        </div>
        <div class="row <?php echo ($page->hasError('invisible')) ? 'error' : ''; ?>">
            <input
                type="hidden"
                name="dialog[invisible]"
                value="0" />
            <input
                id="page-invisible"
                type="checkbox"
                name="dialog[invisible]"
                <?php echo ($page->invisible) ? 'checked="checked"' : '' ?>
                value="1" />
            <label
                for="page-invisible"
                class="cb">
                <?php echo I18n::__('page_label_invisible') ?>
            </label>
        </div>
        <div class="row">
            <label
                for="page-keywords"
                class="<?php echo ($page->hasError('keywords')) ? 'error' : ''; ?>">
                <?php echo I18n::__('page_label_keywords') ?>
            </label>
            <textarea
                id="page-keywords"
                class="scaleable"
                name="dialog[keywords]"
                cols="60"
                rows="2"><?php echo htmlspecialchars($page->keywords) ?></textarea>
        </div>
        <div class="row">
            <label
                for="page-description"
                class="<?php echo ($page->hasError('desc')) ? 'error' : ''; ?>">
                <?php echo I18n::__('page_label_desc') ?>
            </label>
            <textarea
                id="page-description"
                class="scaleable"
                name="dialog[desc]"
                cols="60"
                rows="8"><?php echo htmlspecialchars($page->desc) ?></textarea>
        </div>
    </fieldset>
    <div class="buttons">
        <!-- Ajax does not send the submit button value, so we transport with hidden field -->
        <input
            id="page-delete"
            type="hidden"
            name="delete"
            value="0" />
        <input
            type="submit"
            onclick="$('#page-delete').val('1');"
            class="danger"
            name="submit"
            value="<?php echo I18n::__('page_submit_delete') ?>" />
        <!-- End of hidden field to solve missing submit button when ajax(ed) -->
        <input
            type="submit"
            name="submit"
            value="<?php echo I18n::__('page_submit') ?>" />
    </div>
</form>