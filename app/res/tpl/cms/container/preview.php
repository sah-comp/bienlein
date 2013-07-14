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
<iframe
    class="preview"
    src="<?php echo Url::build($domain->url.'/?preview') ?>"
    width="98%"
    height="640px"
    name="<?php echo htmlspecialchars($domain->name) ?>">
    <p><?php echo Flight::textile(I18n::__('browser_is_not_supporting_iframe', null, array($domain->url))) ?></p>
</iframe>
