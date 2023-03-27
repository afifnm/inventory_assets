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
				<a href="<?php echo site_url('home');?>" class="menu menu--active">
					<div class="menu__icon"><i data-feather="home"></i></div>
					<div class="menu__title"> Dashboard </div>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('home/pinjam');?>" class="menu">
					<div class="menu__icon"><i data-feather="framer"></i></div>
					<div class="menu__title"> Peminjaman</div>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('home/ambil');?>" class="menu">
					<div class="menu__icon"><i data-feather="rewind"></i></div>
					<div class="menu__title"> Pengambilan</div>
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
				<a href="<?php echo site_url('home');?>" class="top-menu top-menu--active">
					<div class="top-menu__icon"> <i data-feather="home"></i></div>
					<div class="top-menu__title"> Dashboard </div>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('home/pinjam');?>" class="top-menu">
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
            <h2 class="text-lg font-medium mr-auto"> <?= $label; ?> </h2>
			<div class="relative text-gray-700 ml-auto">
				<a href="javascript:;" data-toggle="modal" data-target="#pencarian"
					class="button mr-1 inline-block bg-theme-1 text-white">Pencarian Aset </a>
			</div>
		</div>
		<div class="intro-y datatable-wrapper box p-5 mt-5">
			<table class="table table-report table-report--bordered display datatable w-full" style="font-size: 12px;">
				<thead>
					<tr>
						<th class="border-b-2 text-center whitespace-no-wrap">NO</th>
						<th class="border-b-2 whitespace-no-wrap">NAMA ASET </th>
						<th class="border-b-2 whitespace-no-wrap">NOMOR INVENTARIS </th>
						<th class="border-b-2 whitespace-no-wrap">STOK </th>
						<th class="border-b-2 whitespace-no-wrap">TEMPAT </th>
						<th class="border-b-2 text-center whitespace-no-wrap">STATUS</th>
						<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
					</tr>
				</thead>
				<tbody>
					<?php  $no = 1; foreach ($data2 as $user) {?>
					<tr>
						<td class="text-center border-b"><?= $no; ?></td>
						<td class="text-left border-b"><?= $user['nama']; ?></td>
						<td class="text-left border-b"><?= $user['nomor_inventaris']; ?></td>
						<td class="text-left border-b">
							<?php if($user['aset']=="Tetap"){ echo "Tetap"; } else { echo $user['stok']; } ?> </td>
						<td class="text-left border-b"><?= $user['ruang']; ?></td>
						<td class="text-left border-b text-center ">
							<label
								class="button w-24 rounded-full mr-1 mb-2 bg-theme-9 text-white"><?= $user['status']; ?></label>
						</td>
						<td class="border-b w-5">
							<div class="flex sm:justify-center items-center">
								<a href="javascript:;" onclick="edit(
								'<?php echo $user['id_aset'] ?>',
								'<?php echo $user['nama'] ?>',
								'<?php echo $user['aset'] ?>',
								'<?php echo $user['stok'] ?>',
								'<?php echo $user['nomor_inventaris'] ?>',
								'<?php echo $user['merk'] ?>',
								'<?php echo $user['jenis'] ?>',
								'<?php echo $user['tahun_perolehan'] ?>',
								'<?php echo 'Rp. '.number_format($user['harga'],0,',','.') ?>',
								'<?php echo $user['sumber_dana'] ?>',
								'<?php echo mediumdate_indo($user['tanggal_masuk']) ?>',
								'<?php echo $user['ruang'] ?>',
								'<?php echo $user['status'] ?>',
								'<?php echo $user['kondisi'] ?>',
								<?php echo $this->Aset_model->count_foto_aset($user['nomor_inventaris']) ?>
								)" class="flex items-center pr-1" data-toggle="modal" data-target="#edit-data">
									<i data-feather="search" class="w-4 h-4 mr-1"></i>
									Detail
								</a>
							</div>
						</td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="modal" id="pencarian">
		<div class="modal__content modal__content--lg">
			<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
				<h2 class="font-medium text-base mr-auto">PENCARIAN ASET </h2>
			</div>
			<form action="<?php echo site_url('home/pencarian');?>" method="POST">
				<div class="intro-y box p-5">
					<div class="mt-3">
						<label>Nama Aset</label>
						<div class="relative mt-2">
							<input type="text" class="input pr-4 w-full border col-span-4"
								placeholder="nomor inventaris" name="nama">
						</div>
					</div>
					<div class="mt-3">
						<label>Nomor Inventaris</label>
						<div class="relative mt-2">
							<input type="text" class="input pr-4 w-full border col-span-4"
								placeholder="nomor inventaris" name="nomor_inventaris">
						</div>
					</div>
					<div class="mt-3">
						<label>Merk</label>
						<div class="relative mt-2">
							<input type="text" class="input pr-4 w-full border col-span-4" placeholder="merk aset"
								name="merk">
						</div>
					</div>
					<div class="mt-3">
						<label>Jenis Aset</label>
						<div class="relative mt-2">
							<select name="id_jenis" class="input pr-4 w-full border col-span-4">
								<option value="0" selected>Semua Jenis Aset</option>
								<?php foreach ($this->Aset_model->jenis() as $jenis){ ?>
								<option value="<?= $jenis['id_jenis']; ?>">
									<?= $jenis['jenis']; ?>
								</option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="mt-3">
						<label>Ruang/Tempat</label>
						<div class="relative mt-2">
							<select name="id_ruang" class="input pr-4 w-full border col-span-4">
								<option value="0" selected>Semua Ruang</option>
								<?php foreach ($this->Aset_model->ruang() as $ruang){ ?>
								<option value="<?= $ruang['id_ruang']; ?>"><?= $ruang['ruang']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="mt-3">
						<label>Sumber Dana</label>
						<div class="relative mt-2">
							<select name="id_sumber_dana" class="input pr-4 w-full border col-span-4">
								<option value="0" selected>Semua Sumber Dana</option>
								<?php foreach ($this->Aset_model->sumber_dana() as $sumber_dana){ ?>
								<option value="<?= $sumber_dana['id_sumber_dana']; ?>">
									<?= $sumber_dana['sumber_dana']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="mt-3">
						<label>Tahun Perolehan</label>
						<div class="relative mt-2">
							<input type="number" class="input w-full pl-4 border" name="tahun_perolehan" value="0">
						</div>
					</div>
				</div>
				<div class="px-5 py-3 text-right border-t border-gray-200">
					<button type="submit" class="button w-30 bg-theme-1 text-white">Cari Aset</button>
				</div>
			</form>
		</div>
	</div>
    <!-- BEGIN: EDIT Confirmation Modal -->
<div class="modal" id="edit-data">
	<div class="modal__content modal__content--xl">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base ml-3" id="h2_nama">PERBARUI ASET </h2>
		</div>
		<div class="intro-y box p-5">
			<table class="ml-3 mb-3">
				<tr>
					<td>Nomor Inventaris </td>
					<td id="nomor_inventaris">: </td>
				</tr>
				<tr>
					<td>Jumlah/Stok</td>
					<td id="qty">: </td>
				</tr>
				<tr>
					<td>Merk</td>
					<td id="merk">: </td>
				</tr>
				<tr>
					<td>Tanggal Masuk</td>
					<td id="tanggal_masuk">: </td>
				</tr>
				<tr>
					<td>Ruang </td>
					<td id="ruang">: </td>
				</tr>
				<tr>
					<td>Tahun Perolehan </td>
					<td id="tahun_perolehan">: </td>
				</tr>
				<tr>
					<td>Harga </td>
					<td id="harga">: </td>
				</tr>
				<tr>
					<td>Sumber Dana </td>
					<td id="sumber_dana">: </td>
				</tr>
				<tr>
					<td>Status</td>
					<td id="status">: </td>
				</tr>
				<tr>
					<td>Kondisi</td>
					<td id="kondisi">: </td>
				</tr>
			</table>
			<h3 class="font-medium text-base ml-3" id="belum_ada">Foto aset belum dimasukan. Klik edit untuk memasukan
				foto aset. </h3>
			<div class="slider mx-6 fade-mode" id="ada">
				<div class="h-64 px-2">
					<div class="h-full image-fit rounded-md overflow-hidden"> <img id="foto1" alt="Foto belum diupload"
							src="<?php echo base_url('assets');?>/midone/dist/images/preview-8.jpg" /> </div>
				</div>
				<div class="h-64 px-2">
					<div class="h-full image-fit rounded-md overflow-hidden"> <img id="foto2" alt="Foto belum diupload"
							src="<?php echo base_url('assets');?>/midone/dist/images/preview-13.jpg" /> </div>
				</div>
				<div class="h-64 px-2">
					<div class="h-full image-fit rounded-md overflow-hidden"> <img id="foto3" alt="Foto belum diupload"
							src="<?php echo base_url('assets');?>/midone/dist/images/preview-12.jpg" /> </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: EDIT Confirmation Modal -->
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
    <script>
		function edit(id_aset, nama, aset, stok, nomor_inventaris, merk, jenis,tahun_perolehan, harga, sumber_dana,
	 tanggal_masuk, ruang, status, kondisi,
		count_foto) {
		document.getElementById('h2_nama').innerHTML = nama;
		document.getElementById('nomor_inventaris').innerHTML = ': ' + nomor_inventaris;
		document.getElementById('qty').innerHTML = ': ' + stok + ' (Aset ' + aset + ')';
		document.getElementById('merk').innerHTML = ': ' + merk;
		document.getElementById('tanggal_masuk').innerHTML = ': ' + tanggal_masuk;
		document.getElementById('ruang').innerHTML = ': ' + ruang;
		document.getElementById('tahun_perolehan').innerHTML = ': ' + tahun_perolehan;
		document.getElementById('harga').innerHTML = ': ' + harga;
		document.getElementById('sumber_dana').innerHTML = ': ' + sumber_dana;
		document.getElementById('status').innerHTML = ': ' + status;
		document.getElementById('kondisi').innerHTML = ': ' + kondisi;
		if (count_foto > 0) {
			document.getElementById('ada').style.display = "block";
			document.getElementById('belum_ada').style.display = "none";
			document.getElementById('foto1').src = '<?php echo site_url('assets/upload/aset/');?>' + nomor_inventaris + '1.jpg';
			document.getElementById('foto2').src = '<?php echo site_url('assets/upload/aset/');?>' + nomor_inventaris + '2.jpg';
			document.getElementById('foto3').src = '<?php echo site_url('assets/upload/aset/');?>' + nomor_inventaris + '3.jpg';
		} else {
			document.getElementById('ada').style.display = "none";
			document.getElementById('belum_ada').style.display = "block";
		}
	};
</script>

</body>

</html>
