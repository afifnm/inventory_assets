<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head -->
<head>
	<meta charset="utf-8">
	<link href="<?php echo base_url('assets');?>/vendor/midone/dist/images/logo.svg" rel="shortcut icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php echo $title ?>
	</title>
	<?php require_once('_css.php') ?>
</head>
<!-- END: Head -->
<body class="app">
	<div class="flex">
		<?php require_once('_sidebar.php') ?>
		<!-- BEGIN: Content -->
		<div class="content">
			<?php require_once('_nav.php') ?>
			<?php echo $contents ;?>
		</div>
		<!-- END: Content -->
	</div>
	<?php require_once('_js.php') ?>
</body>
</html>
