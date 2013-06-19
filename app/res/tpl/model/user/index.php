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
<!-- user table -->
<table>
    
    <caption>
        <?php echo I18n::__('scaffold_caption_index', null, array($total_records)) ?>
    </caption>
    
    <thead>
        <tr>
            <th class="switch">
                <input
                    class="all"
                    type="checkbox"
                    name="void"
                    value="1"
                    title="<?php echo I18n::__('scaffold_select_all') ?>" />
            </th>
            <th><?php echo I18n::__('user_name_label') ?></th>
        </tr>
    </thead>
    
    <tfoot>
        <tr>
            <td colspan="2">
            </td>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($records as $id => $_record): ?>
        <tr
            id="<?php echo $_record->getMeta('type') ?>-<?php echo $_record->getId() ?>"
            class="bean bean-<?php echo $_record->getMeta('type') ?>">
            <td>
                <input
                    type="checkbox"
                    class="selector"
                    name="selection[<?php echo $_record->getMeta('type') ?>][<?php echo $_record->getId() ?>]"
                    value="1"
                    title="<?php echo I18n::__('scaffold_selector_tooltip') ?>"
                    <?php echo (isset($selection[$_record->getMeta('type')][$_record->getId()]) && $selection[$_record->getMeta('type')][$_record->getId()]) ? 'checked="checked"' : '' ?> />
            </td>
            <td
                class="fn fn-name link">
                <a
                	href="<?php echo Url::build('/admin/user/edit/%d', array($_record->getId())) ?>">
                    <?php echo $_record->name ?>
                </a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
    
</table>
<!-- End of user table -->
