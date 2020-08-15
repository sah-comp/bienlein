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
<?php
$_target = $_record->getMeta('type') . '-' . $_attribute['name'] . '-' . $_record->getId();
?>
<div id="<?php echo $_target ?>">
    <?php Flight::render('scaffold/table/attribute', [
        '_target' => $_target,
        '_record' => $_record,
        '_attribute' => $_attribute
    ]);
    ?>
</div>
