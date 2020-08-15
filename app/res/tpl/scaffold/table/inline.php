<?php
/**
 * Scaffold inline field editor.
 *
 * @package Cinnebar
 * @subpackage Template
 * @author $Author$
 * @version $Id$
 */
?>
<!-- scaffold inline field edit -->
<input
    id="field-<?php echo $record->getMeta('type') . '-' . $attribute . '-' . $record->getId() ?>"
    type="text"
    name="inline"
    class="autowidth"
    value="<?php echo $record->{$attribute} ?>" />
<!-- end of scaffold inline field edit -->
