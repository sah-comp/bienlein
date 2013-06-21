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
<!-- language chooser -->
<form
    id="form-langchooser"
    class="langchooser"
    action="<?php echo Url::build('/language/set') ?>"
    method="POST"
    accept-charset="utf-8">
    <div>
        <input
            type="hidden"
            name="goto"
            value="<?php echo htmlspecialchars(Flight::request()->url) ?>" />
    </div>
    <fieldset>
        <select
            name="language"
            onchange="this.form.submit()">
            <?php foreach (Flight::get('possible_languages') as $iso): ?>
            <option
                value="<?php echo $iso ?>"
                <?php echo (Flight::get('user')->getLanguage() == $iso) ? 'selected="selected"' : '' ?>>
                <?php echo I18n::__("language_{$iso}") ?>
            </option>
            <?php endforeach ?>
        </select>
    </fieldset>
</form>
<!-- End of admin navigation -->
