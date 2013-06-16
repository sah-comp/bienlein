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
<!-- admin user page -->
<?php if ( ! isset($records) || ! is_array($records)): ?>
<div class="alert alert-warning">
    <h4><?php echo I18n::__('alert_record_empty') ?></h4>
    <p><?php echo I18n::__('alert_add_record') ?></p>
</div>
<?php else: ?>
<?php foreach ($records as $id => $record): ?>
<a
	href="<?php echo Url::build('/admin/user/edit/%d', array($record->getId())) ?>">
	<figure
		id="user-<?php echo $id ?>"
		class="gravatar">
	    <img
	        src="<?php echo Gravatar::src($record->email, 64) ?>"
	        width="64"
	        height="64"
	        alt="<?php echo htmlspecialchars($record->name) ?>" />
	    <figcaption>
	        <?php echo htmlspecialchars($record->name) ?>
	    </figcaption>
	</figure>
</a>
<?php endforeach ?>
<?php endif ?>
<!-- End of admin user page -->
