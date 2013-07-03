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
    id="form-page-add"
    data-container="content-container"
    class="panel inline page-add"
    method="POST"
    action="<?php echo Url::build('/cms/add/page/') ?>"
    accept-charset="utf-8"
    enctype="multipart/form-data">
    <div>
        <input type="hidden" name="dialog[type]" value="page" />
        <input type="hidden" name="dialog[id]" value="0" />
        <input type="hidden" name="dialog[language]" value="<?php echo Flight::get('user')->getLanguage() ?>" />
        <input type="hidden" name="dialog[domain_id]" value="<?php echo $domain->getId() ?>" />
        <input type="hidden" name="dialog[sequence]" value="10000" />
        <input type="hidden" name="dialog[name]" value="<?php echo I18n::__('page_name_untitled') ?>" />
    </div>
    <fieldset>
        <legend class="verbose"><?php echo I18n::__('page_legend_meta') ?></legend>
        <div class="row">
            <select
                id="page-template"
                onchange="$('#form-page-add').trigger('submit')"
                name="dialog[template_id]"
                required="required">
                <option value=""><?php echo I18n::__('cms_addpage_w_template') ?></option>
                <?php foreach (R::findAll('template') as $_id => $_template): ?>
                <option
                    value="<?php echo $_template->getId() ?>"><?php echo htmlspecialchars($_template->name) ?></option>   
                <?php endforeach ?>
            </select>
        </div>
    </fieldset>
</form>
