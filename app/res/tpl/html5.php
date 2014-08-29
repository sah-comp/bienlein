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
<!DOCTYPE html>
<!--[if lt IE 7]><html lang="<?php echo $language ?>" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html lang="<?php echo $language ?>" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html lang="<?php echo $language ?>" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="<?php echo $language ?>" class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<title><?php echo $title ?></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        
		<link rel="stylesheet" href="/css/style.css">
		<?php if (isset($stylesheets) && is_array($stylesheets)): ?>
            <?php foreach ($stylesheets as $_n=>$_stylesheet): ?>
            <link rel="stylesheet" href="/css/<?php echo $_stylesheet; ?>.css">
            <?php endforeach; ?>
		<?php endif ?>
		<!--[if lt IE 9]>
        <script src="/js/html5shiv.js"></script>
        <![endif]-->
	</head>

	<body>
		<!--[if lt IE 7]>
		<?php echo Flight::textile(I18n::__('browser_is_ancient')) ?>
		<![endif]-->
		
		<!-- Header (optional) -->
		<?php echo isset($header) ? $header : null ?>
		<!-- End of optional header -->

		<!-- Notification (optional) -->
		<?php echo isset($notification) ? $notification : null ?>
		<!-- End of optional notification -->

        <!-- Content (required) -->
		<?php echo $content; ?>
		<!-- End of required content -->
		
		<!-- Footer (optional) -->
		<?php echo isset($footer) ? $footer : null ?>
		<!-- End of optional footer -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
        <script src="/js/jquery.idTabs.min.js"></script>
        <script src="/js/jquery.form.min.js"></script>
        <script src="/js/jquery-scrolltofixed-min.js"></script>
        <?php if (isset($javascripts) && is_array($javascripts)): ?>
            <?php foreach ($javascripts as $_n=>$_js): ?>
            <script src="<?php echo $_js; ?>.js"></script>
            <?php endforeach; ?>
		<?php endif ?>
		<script src="/js/script.js"></script>
	</body>
</html>
