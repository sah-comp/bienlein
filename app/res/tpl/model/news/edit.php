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
<!-- news edit form -->
<div>
    <input type="hidden" name="dialog[type]" value="<?php echo $record->getMeta('type') ?>" />
    <input type="hidden" name="dialog[id]" value="<?php echo $record->getId() ?>" />
    <input type="hidden" name="dialog[language]" value="<?php echo $record->language ?>" />
</div>
<fieldset>
    <legend class="verbose"><?php echo I18n::__('news_legend') ?></legend>
    <div class="row <?php echo ($record->hasError('newscat_id')) ? 'error' : ''; ?>">
        <label
            for="news-newscat">
            <?php echo I18n::__('news_label_newscat') ?>
        </label>
        <select
            id="news-newscat"
            name="dialog[newscat_id]">
            <?php foreach (R::findAll('newscat') as $_id => $_newscat): ?>
            <option
                value="<?php echo $_newscat->getId() ?>"
                <?php echo ($record->newscat_id == $_newscat->getId()) ? 'selected="selected"' : '' ?>><?php echo htmlspecialchars($_newscat->i18n(Flight::get('user')->getLanguage())->name) ?></option>   
            <?php endforeach ?>
        </select>
    </div>
    <div class="row <?php echo ($record->hasError('online')) ? 'error' : ''; ?>">
        <input
            type="hidden"
            name="dialog[online]"
            value="0" />
        <input
            id="news-online"
            type="checkbox"
            name="dialog[online]"
            <?php echo ($record->online) ? 'checked="checked"' : '' ?>
            value="1" />
        <label
            for="news-online"
            class="cb">
            <?php echo I18n::__('news_label_online') ?>
        </label>
    </div>
    <div class="row <?php echo ($record->hasError('archived')) ? 'error' : ''; ?>">
        <input
            type="hidden"
            name="dialog[archived]"
            value="0" />
        <input
            id="news-archived"
            type="checkbox"
            name="dialog[archived]"
            <?php echo ($record->archived) ? 'checked="checked"' : '' ?>
            value="1" />
        <label
            for="news-archived"
            class="cb">
            <?php echo I18n::__('news_label_archived') ?>
        </label>
    </div>
    <div class="row <?php echo ($record->hasError('pubdatetime')) ? 'error' : ''; ?>">
        <label
            for="news-pubdatetime">
            <?php echo I18n::__('news_label_pubdatetime') ?>
        </label>
        <input
            id="news-pubdatetime"
            type="datetime"
            name="dialog[pubdatetime]"
            value="<?php echo htmlspecialchars($record->localizedDateTime('pubdatetime')) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('name')) ? 'error' : ''; ?>">
        <label
            for="news-name">
            <?php echo I18n::__('news_label_name') ?>
        </label>
        <input
            id="news-name"
            type="text"
            name="dialog[name]"
            value="<?php echo htmlspecialchars($record->name) ?>"
            required="required" />
    </div>
    <div class="row <?php echo ($record->hasError('teaser')) ? 'error' : ''; ?>">
        <label
            for="news-teaser">
            <?php echo I18n::__('news_label_teaser') ?>
        </label>
        <textarea
            id="news-teaser"
            name="dialog[teaser]"
            rows="5"
            cols="60"
            required="required"><?php echo htmlspecialchars($record->teaser) ?></textarea>
        <p class="info"><?php echo I18n::__('news_info_teaser') ?></p>
    </div>
    <div class="row <?php echo ($record->hasError('content')) ? 'error' : ''; ?>">
        <label
            for="news-content">
            <?php echo I18n::__('news_label_content') ?>
        </label>
        <textarea
            id="news-content"
            name="dialog[content]"
            rows="13"
            cols="60"><?php echo htmlspecialchars($record->content) ?></textarea>
        <p class="info"><?php echo I18n::__('news_info_content') ?></p>
    </div>
</fieldset>
<!-- end of news edit form -->