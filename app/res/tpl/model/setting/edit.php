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
<!-- setting form -->
<?php $domains = R::findAll('domain') ?>
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
    <input type="hidden" name="dialog[installed]" value="<?php echo $record->installed ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('setting_legend_fiscalyear') ?></legend>
    <div class="row <?php echo ($record->hasError('fiscalyear')) ? 'error' : ''; ?>">
        <label
            for="setting-fiscalyear">
            <?php echo I18n::__('setting_label_fiscalyear') ?>
        </label>
        <input
            id="setting-fiscalyear"
            type="number"
            step="1"
            name="dialog[fiscalyear]"
            value="<?php echo htmlspecialchars($record->fiscalyear) ?>"
            required="required" />
    </div>
</fieldset>
<div
    class="tab-container">
    <?php Flight::render('shared/navigation/tabs', array(
        'tab_id' => 'setting-tabs',
        'tabs' => array(
            'setting-folder' => I18n::__('setting_folder_tab'),
            'setting-currency' => I18n::__('setting_currency_tab')
        ),
        'default_tab' => 'setting-folder'
    )) ?>
    <fieldset
        id="setting-folder"
        class="tab">
        <legend class="verbose"><?php echo I18n::__('setting_legend_folder') ?></legend>
        <div class="row">
            <label
                for="setting-blessedfolder"
                class="<?php echo ($record->hasError('blessedfolder')) ? 'error' : ''; ?>">
                <?php echo I18n::__('setting_label_blessedfolder') ?>
            </label>
            <select
                id="setting-blessedfolder"
                name="dialog[blessedfolder]">
                <?php foreach ($domains as $_id => $_domain): ?>
                <option
                    value="<?php echo $_domain->getId() ?>"
                    <?php echo ($record->blessedfolder == $_domain->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_domain->i18n(Flight::get('language'))->name) ?></option>   
                <?php endforeach ?>
            </select>
        </div>
        <div class="row">
            <label
                for="setting-sitesfolder"
                class="<?php echo ($record->hasError('sitesfolder')) ? 'error' : ''; ?>">
                <?php echo I18n::__('setting_label_sitesfolder') ?>
            </label>
            <select
                id="setting-sitesfolder"
                name="dialog[sitesfolder]">
                <?php foreach ($domains as $_id => $_domain): ?>
                <option
                    value="<?php echo $_domain->getId() ?>"
                    <?php echo ($record->sitesfolder == $_domain->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_domain->i18n(Flight::get('language'))->name) ?></option>   
                <?php endforeach ?>
            </select>
        </div>
    </fieldset>
    <fieldset
        id="setting-currency"
        class="tab"
        style="display: none;">
        <legend class="verbose"><?php echo I18n::__('setting_legend_currency') ?></legend>
        <div class="row">
            <label
                for="setting-basecurrency"
                class="<?php echo ($record->hasError('basecurrency')) ? 'error' : ''; ?>">
                <?php echo I18n::__('setting_label_basecurrency') ?>
            </label>
            <select
                id="setting-basecurrency"
                name="dialog[basecurrency]">
                <?php foreach (R::findAll('currency') as $_id => $_currency): ?>
                <option
                    value="<?php echo $_currency->getId() ?>"
                    <?php echo ($record->basecurrency == $_currency->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_currency->name) ?></option>   
                <?php endforeach ?>
            </select>
        </div>
        <div
            class="row <?php echo $record->hasError('exchangerateservice') ? 'error' : '' ?>">
            <label
                for="setting-exchangerateservice">
                <?php echo I18n::__('setting_label_exchangerateservice') ?>
            </label>
            <input
                type="text"
                id="setting-exchangerateservice"
                name="dialog[exchangerateservice]"
                value="<?php echo htmlspecialchars($record->exchangerateservice) ?>" />
        </div>
        <div class="row">
            <label
                for="setting-loadexchangerates">
                <?php echo I18n::__('setting_label_loadexchangerates') ?>
            </label>
            <select
                id="setting-loadexchangerates"
                name="loadexchangerates">
                <option value="0"><?php echo I18n::__('setting_loadexchangerates_no', null, array($record->exchangeratelastupd)) ?></value>
                <option value="1"><?php echo I18n::__('setting_loadexchangerates_yes') ?></value>
            </select>
        </div>
    </fieldset>
</div>
<!-- end of setting form -->