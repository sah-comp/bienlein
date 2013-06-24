<?php
/**
 * Tabbed viewhelper partial.
 *
 * @see jquery.idTabs.min.js
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<?php if (isset($tabs) && is_array($tabs)): ?>
<!-- Tabbed menu -->
<div
    id="<?php echo $tab_id ?>"
    class="tabs"
    data-default="<?php echo isset($default_tab) ? $default_tab : '' ?>">
    <ul class="tab-navigation">
        <?php foreach ($tabs as $_tab_id => $_tab_label): ?>
            <li>
                <a
                    id="tab-<?php echo $_tab_id ?>"
                    href="#<?php echo $_tab_id ?>"
                    class="<?php echo (isset($default_tab) && $default_tab == $_tab_id) ? 'selected' : '' ?>">
                    <?php echo $_tab_label ?>
                </a>
            </li>
        <?php endforeach ?>
    </ul>
</div>
<!-- end of tabbed menu -->
<?php endif ?>
