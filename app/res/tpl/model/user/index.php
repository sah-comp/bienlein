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
<!-- users form details -->
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
<!-- End of users form details -->
