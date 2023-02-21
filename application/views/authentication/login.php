<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head -->

<head>
	<meta charset="utf-8">
	<link href="dist/images/logo.svg" rel="shortcut icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Inventaris Aset</title>
	<!-- BEGIN: CSS Assets-->
	<link rel="stylesheet" href="<?php echo base_url('assets');?>/midone/dist/css/app.css" />
	<!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="login">
	<div class="container sm:px-10">
		<div class="block xl:grid grid-cols-2 gap-4">
			<!-- BEGIN: Login Info -->
			<div class="hidden xl:flex flex-col min-h-screen">
				<div class="my-auto">
					<div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
						INVENTARIS ASET
					</div>
				</div>
			</div>
			<!-- END: Login Info -->
			<!-- BEGIN: Login Form -->
			<div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
				<div
					class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
					<h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Login</h2>
					<form method="post" action="<?php echo base_url('auth/login'); ?>" role="login">
						<div class="intro-x mt-8">
							<input type="text" class="intro-x login__input input input--lg border border-gray-300 block"
								placeholder="Username" name="username" required>
							<input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4"
								placeholder="Password" name="password" required>
						</div>
						<div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
							<button type="submit" name="submit" value="login"
								class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Login</button>
						</div>
					</form>
					<div class="intro-x mt-10 xl:mt-24 text-gray-700 text-center xl:text-left">
						<div id="myalert">
							<?php echo $this->session->flashdata('alert', true)?>
						</div>
					</div>
				</div>
			</div>
			<!-- END: Login Form -->
		</div>
	</div>
	<!-- BEGIN: JS Assets-->
	<!-- BEGIN: JS Assets-->
	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>
	<script src="<?php echo base_url('assets');?>/midone/dist/js/app.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<!-- END: JS Assets-->
	<script>
		setTimeout(function () {
			$('#myalert').fadeOut('slow');
		}, 2500); // <-- time in milliseconds

	</script>


	<!-- END: JS Assets-->
</body>

</html>
