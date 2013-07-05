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
<?php if ( ! $record->content): ?>
<p class="alert alert-error"><?php echo I18n::__('module_text_missing_content') ?></p>
<?php return ?>
<?php endif ?>
<?php echo nl2br(htmlspecialchars($record->content)) ?>
