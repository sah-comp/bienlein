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
<?php $_attributes = $record->getAttributes($layout) ?>
<!-- <?php echo $record->getMeta('type') ?> scaffold table -->
<table>
    
    <caption>
        <?php echo I18n::__('scaffold_caption_index', null, array($total_records)) ?>
    </caption>
    
    <thead>
        <tr>
            <th class="edit">
                &nbsp;
            </th>
            <th class="switch">
                <input
                    class="all"
                    type="checkbox"
                    name="void"
                    value="1"
                    title="<?php echo I18n::__('scaffold_select_all') ?>" />
            </th>
            <!-- header attributes -->
            <?php foreach ($_attributes as $_i => $_attribute): ?>
                <?php
                    $_class = $record->getMeta('type').' fn-'.$_attribute['name'].' order';
                    $_dir = 0;
                    if ($order == $_i):
                        $_dir = ! $dir;
                        $_class .= ' active dir-'.$_dir;
                    endif;
                    if (isset($_attribute['class'])) $_class .= ' '.$_attribute['class'];
                ?>
            <th class="<?php echo $_class ?>">
                <a href="<?php echo Url::build("{$base_url}/{$type}/{$layout}/1/{$_i}/{$_dir}") ?>"><?php echo I18n::__($record->getMeta('type').'_label_'.$_attribute['name']) ?></a>
            </th>
            <?php endforeach ?>
            <!-- end of header attributes -->
        </tr>

        <?php if (isset($filter) && is_a($filter, 'RedBean_OODBBean')): ?>
        <tr
            class="filter">
            <th>
                <input
                    type="hidden"
                    name="filter[type]"
                    value="filter" />
                <input
                    type="hidden"
                    name="filter[id]"
                    value="<?php echo $filter->getId() ?>" />
                <input
                    type="hidden"
                    name="filter[model]"
                    value="<?php echo $record->getMeta('type') ?>" />
                <input
                    type="submit"
                    class="ir filter-refresh"
                    name="submit"
                    title="<?php echo I18n::__('filter_submit_refresh') ?>"
                    value="<?php echo I18n::__('filter_submit_refresh') ?>" />
            </th>
            
            <th>
                <input
                    type="submit"
                    class="ir filter-clear"
                    name="submit"
                    title="<?php echo I18n::__('filter_submit_clear') ?>"
                    value="<?php echo I18n::__('filter_submit_clear') ?>" />
            </th>

            <?php foreach ($_attributes as $_i => $_attribute): ?>
            <th>
                <?php if (isset($_attribute['filter']) && is_array($_attribute['filter'])): ?>
                <?php $_criteria = $filter->getCriteria($_attribute) ?>
                <input
                    type="hidden"
                    name="filter[ownCriteria][<?php echo $_i ?>][type]"
                    value="criteria" />
                <input
                    type="hidden"
                    name="filter[ownCriteria][<?php echo $_i ?>][id]"
                    value="<?php echo $_criteria->getId() ?>" />
                <input
                    type="hidden"
                    name="filter[ownCriteria][<?php echo $_i ?>][op]"
                    value="<?php echo htmlspecialchars($_criteria->op) ?>" />
                <input
                    type="hidden"
                    name="filter[ownCriteria][<?php echo $_i ?>][tag]"
                    value="<?php echo htmlspecialchars($_criteria->tag) ?>" />
                <input
                    type="hidden"
                    name="filter[ownCriteria][<?php echo $_i ?>][attribute]"
                    value="<?php echo htmlspecialchars($_criteria->attribute) ?>" />
                <input
                    type="text"
                    class="filter"
                    name="filter[ownCriteria][<?php echo $_i ?>][value]"
                    value="<?php echo htmlspecialchars($_criteria->value) ?>"
                    placeholder="<?php echo I18n::__('filter_placeholder_any') ?>" />
                <?php else: ?>
                    &nbsp;
                <?php endif ?>
            </th>
            <?php endforeach ?>
        </tr>
        <?php endif ?>

    </thead>
    
    <tfoot>
        <tr>
            <td colspan="<?php echo count($_attributes)+2 ?>">
                &nbsp;
            </td>
        </tr>
    </tfoot>
    
    <tbody>        
        <?php $offset = 0 ?>
        <?php foreach ($records as $id => $_record): ?>
            <?php $offset++ ?>
        <tr
            id="<?php echo $_record->getMeta('type') ?>-<?php echo $_record->getId() ?>"
            class="bean bean-<?php echo $_record->getMeta('type') ?>">
            <!-- table cells of the real bean -->     
            <td class="edit">
                <a
                    class="edit"
                	href="<?php echo Url::build('/admin/%s/edit/%d/%d/%d/%d/%s/', array($_record->getMeta('type'), $_record->getId(), $offset, $order, $dir, $layout)) ?>">
                    <?php echo I18n::__('scaffold_action_edit') ?>
                </a>
            </td>
            <td
                class="fn fn-name">
                <input
                    type="checkbox"
                    class="selector"
                    name="selection[<?php echo $_record->getMeta('type') ?>][<?php echo $_record->getId() ?>]"
                    value="1"
                    title="<?php echo I18n::__('scaffold_selector_tooltip') ?>"
                    <?php echo (isset($selection[$_record->getMeta('type')][$_record->getId()]) && $selection[$_record->getMeta('type')][$_record->getId()]) ? 'checked="checked"' : '' ?> />
            </td>
            
            <!-- body attributes -->
            <?php foreach ($_attributes as $_attribute): ?>
            <td>
                <?php if (isset($_attribute['callback'])): ?>
                    <?php echo htmlspecialchars($_record->{$_attribute['callback']['name']}()) ?>
                <?php else: ?>
                    <?php echo htmlspecialchars($_record->{$_attribute['name']}) ?>
                <?php endif ?>
            </td>
            <?php endforeach ?>
            <!-- end of body attributes -->
            
        </tr>
        <?php endforeach ?>
    </tbody>
    
</table>
<!-- End of scaffold table -->
