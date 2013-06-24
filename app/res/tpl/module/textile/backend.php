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
<textarea
    name="dialog[ownSlice][<?php echo $record->region_id.'-'.$record->getId() ?>][content]"
    rows="8"
    cols="60"><?php echo htmlspecialchars($record->content) ?></textarea>
