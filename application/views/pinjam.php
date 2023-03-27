<html lang="en">
<!-- BEGIN: Head -->

<head>
	<meta charset="utf-8">
	<link href="<?php echo base_url('assets');?>/upload/logo.png" rel="shortcut icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inventaris Aset SMKN 1 Karanganyar</title>
	<!-- BEGIN: CSS Assets-->
	<link rel="stylesheet" href="<?php echo base_url('assets');?>/midone/dist/css/app.css" />
	<!-- END: CSS Assets-->
	<style>
		a:hover {
			font-size: 14px;
		}

	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<!-- END: Head -->

<body class="app">
	<!-- BEGIN: Mobile Menu -->
	<div class="mobile-menu md:hidden">
		<div class="mobile-menu-bar">
			<a href="<?php echo site_url('home');?>" class="intro-x flex items-center pl-5 pt-4">
				<span class="hidden xl:block text-white text-lg ml-3"> Inventaris<span class="font-medium"> Aset</span>
				</span>
			</a>
			<a href="javascript:;" id="mobile-menu-toggler"> <svg xmlns="http://www.w3.org/2000/svg" width="24"
					height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
					stroke-linecap="round" stroke-linejoin="round"
					class="feather feather-bar-chart-2 w-8 h-8 text-white transform -rotate-90">
					<line x1="18" y1="20" x2="18" y2="10"></line>
					<line x1="12" y1="20" x2="12" y2="4"></line>
					<line x1="6" y1="20" x2="6" y2="14"></line>
				</svg> </a>
		</div>
		<ul class="border-t border-theme-24 py-5 hidden">
			<li>
				<a href="<?php echo site_url('home');?>" class="menu">
					<div class="menu__icon"><i data-feather="home"></i></div>
					<div class="menu__title"> Dashboard </div>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('home/pinjam');?>" class="menu  menu--active">
					<div class="menu__icon"><i data-feather="framer"></i></div>
					<div class="menu__title"> Peminjaman </div>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('home/ambil');?>" class="menu  menu--active">
					<div class="menu__icon"><i data-feather="rewind"></i></div>
					<div class="menu__title"> Pengambilan </div>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('home/pinjam');?>" class="menu">
					<div class="menu__icon"> <i data-feather="log-out"></i></div>
					<div class="menu__title"> Login </div>
				</a>
			</li>
		</ul>
	</div>
	<!-- END: Mobile Menu -->
	<!-- BEGIN: Top Bar -->
	<div class="border-b border-theme-24 -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
		<div class="top-bar-boxed flex items-center">
			<!-- BEGIN: Logo -->
			<a href="<?php echo site_url('home');?>" class="intro-x flex items-center pl-5 pt-4">
				<img class="w-10" src="<?php echo base_url('assets');?>/upload/logo.png">
				<span class="hidden xl:block text-white text-lg ml-3"> INVENTARIS ASET<span class="font-medium"> SMKN 1
						KARANGANYAR</span>
				</span>
			</a>
			<!-- END: Logo -->
		</div>
	</div>
	<!-- END: Top Bar -->
	<!-- BEGIN: Top Menu -->
	<nav class="top-nav">
		<ul>
			<li>
				<a href="<?php echo site_url('home');?>" class="top-menu">
					<div class="top-menu__icon"> <i data-feather="home"></i></div>
					<div class="top-menu__title"> Dashboard </div>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('home/pinjam');?>" class="top-menu top-menu--active">
					<div class="top-menu__icon"> <i data-feather="framer"></i> </div>
					<div class="top-menu__title"> Peminjaman</div>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('home/ambil');?>" class="top-menu">
					<div class="top-menu__icon"> <i data-feather="rewind"></i> </div>
					<div class="top-menu__title"> Pengambilan</div>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('auth/login');?>" class="top-menu">
					<div class="top-menu__icon"> <i data-feather="log-in"></i> </div>
					<div class="top-menu__title"> Login </div>
				</a>
			</li>
		</ul>
	</nav>
	<!-- END: Top Menu -->
	<!-- BEGIN: Content -->
	<div class="content">
		<div class="intro-y flex flex-col sm:flex-row items-center mt-5">
			<h2 class="text-lg font-medium mr-auto"> Peminjaman Aset</h2>
		</div>
		<div class="intro-y datatable-wrapper box p-5 mt-5">
			<table class="table table-report table-report--bordered display datatable w-full">
				<thead>
					<tr>
						<th class="border-b-2 whitespace-no-wrap"># </th>
						<th class="border-b-2 whitespace-no-wrap">PEMINJAMAN </th>
						<th class="border-b-2 whitespace-no-wrap">TGL. PEMINJAMAN </th>
						<th class="border-b-2 whitespace-no-wrap">ALAT YANG DIPINJAM </th>
						<th class="border-b-2 whitespace-no-wrap">KETERANGAN </th>
						<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
					</tr>
				</thead>
				<tbody>
					<?php  $no = 1; foreach ($pinjam as $data) {?>
					<tr>
						<td class="text-left border-b"><?= $no; ?></td>
						<td class="text-left border-b"><?= $data['peminjam']; ?></td>
						<td class="text-left border-b"><?= mediumdate_indo($data['tanggal_pinjam']); ?></td>
						<td class="text-left border-b">
							<?= $this->Aset_model->get_aset_dipinjam($data['kode_pinjam']); ?></td>
						<td class="text-left border-b"><?= $data['keterangan']; ?></td>
						<td class="border-b w-5">
							<div class="flex sm:justify-center items-center">
								<a href="javascript:;" data-toggle="modal" data-target="#<?= 'e'.$no; ?>"
									class="flex items-center text-theme-1 mr-3">
									<i data-feather="search" class="w-4 h-4 mr-1"></i>
									Detail </a>
							</div>
							<div class="modal" id="<?= 'e'.$no; ?>">
								<div class="modal__content modal__content--xl">
									<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
										<h2 class="font-medium text-base mr-auto">DETAIL PEMINJAMAN ASET </h2>
									</div>
									<div class="intro-y box p-5">
										<table class="table" style="font-size: 12px;">
											<thead>
												<tr>
													<th class="border-b-2 whitespace-no-wrap">NAMA ASET </th>
													<th class="border-b-2 whitespace-no-wrap">NOMOR INVENTARIS </th>
													<th class="border-b-2 whitespace-no-wrap">STATUS </th>
												</tr>
											</thead>
											<tbody>
												<?php  $noo = 1; foreach ($this->Aset_model->getDipinjamAset($data['kode_pinjam']) as $user) {?>
												<tr>
													<td class="text-left border-b"><?= $user['nama']; ?></td>
													<td class="text-left border-b"><?= $user['nomor_inventaris']; ?>
													</td>
													<td class="text-left border-b">
														<?php if($user['status']==0){
						echo "belum dikembalikan";
					} else {
						echo "sudah dikembalikan"; 
					} ?>
													</td>
												</tr>
												<?php $noo++; } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</td>

					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>

	</div>

	<!-- END: Content -->
	<!-- BEGIN: JS Assets-->
	<script
		src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
	</script>
	<script src="<?php echo base_url('assets');?>/midone/dist/js/app.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<!-- END: JS Assets-->
	<script>
		setTimeout(function () {
			$('#myalert').fadeOut('slow');
		}, 4500); // <-- time in milliseconds

	</script>
</body>

</html>
