<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-6">
	<h2 class="text-lg font-medium mr-auto"> BUAT PEMINJAMAN </h2>
</div>
<!-- BEGIN: Datatable -->
<div class="grid grid-cols-7 md:grid-cols-7 sm:grid-cols-1 gap-2 mt-5">
	<div class="col-span-4 intro-y datatable-wrapper box p-5">
		<table class="table table-report table-report--bordered display datatable w-full" style="font-size: 12px;">
			<thead>
				<tr>
					<th class="border-b-2 whitespace-no-wrap">NAMA ASET </th>
					<th class="border-b-2 whitespace-no-wrap">NOMOR INVENTARIS </th>
					<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
				</tr>
			</thead>
			<tbody>
				<?php  $no = 1; foreach ($this->Aset_model->getPinjamAset() as $user) {?>
				<tr>
					<td class="text-left border-b"><?= $user['nama']; ?></td>
					<td class="text-left border-b"><?= $user['nomor_inventaris']; ?></td>
					<td class="border-b w-5">
						<div class="flex sm:justify-center items-center">
							<a href="<?php echo site_url('admin/pinjam/add/'.$user['nomor_inventaris']);?>"
								class="button bg-theme-1 text-white">
								<i data-feather="plus" class="w-6 h-4"></i>
							</a>
							<a href="javascript:;" onclick="edit(
								'<?php echo $user['id_aset'] ?>',
								'<?php echo $user['nama'] ?>',
								'<?php echo $user['aset'] ?>',
								'<?php echo $user['stok'] ?>',
								'<?php echo $user['nomor_inventaris'] ?>',
								'<?php echo $user['merk'] ?>',
								'<?php echo $user['jenis'] ?>',
								'<?php echo mediumdate_indo($user['tanggal_masuk']) ?>',
								'<?php echo $user['ruang'] ?>',
								'<?php echo $user['status'] ?>',
								'<?php echo $user['kondisi'] ?>',
								<?php echo $this->Aset_model->count_foto_aset($user['nomor_inventaris']) ?>
								)" data-toggle="modal" data-target="#edit-data" class="button bg-theme-9 text-white ml-2">
								<i data-feather="search" class="w-6 h-4"></i>
							</a>
						</div>
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
	<div class="col-span-3 intro-y box p-5">
		<h2 class="text-lg font-small text-center"> DAFTAR ASET YANG AKAN DIPINJAM</h2>
		<table class="table" style="font-size: 12px;">
			<thead>
				<tr>
					<th class="border-b-2 whitespace-no-wrap">NAMA ASET </th>
					<th class="border-b-2 whitespace-no-wrap">NOMOR INVENTARIS </th>
					<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
				</tr>
			</thead>
			<tbody>
				<?php  $no = 1; foreach ($this->Aset_model->getTempAset() as $user) {?>
				<tr>
					<td class="text-left border-b"><?= $user['nama']; ?></td>
					<td class="text-left border-b"><?= $user['nomor_inventaris']; ?></td>
					<td class="border-b w-5">
						<div class="flex sm:justify-center items-center">
							<a href="<?php echo site_url('admin/pinjam/delete/'.$user['nomor_inventaris']);?>"
								class="button bg-theme-6 text-white">
								<i data-feather="trash" class="w-6 h-4"></i>
							</a>
							<a href="javascript:;" onclick="edit(
								'<?php echo $user['id_aset'] ?>',
								'<?php echo $user['nama'] ?>',
								'<?php echo $user['aset'] ?>',
								'<?php echo $user['stok'] ?>',
								'<?php echo $user['nomor_inventaris'] ?>',
								'<?php echo $user['merk'] ?>',
								'<?php echo $user['jenis'] ?>',
								'<?php echo mediumdate_indo($user['tanggal_masuk']) ?>',
								'<?php echo $user['ruang'] ?>',
								'<?php echo $user['status'] ?>',
								'<?php echo $user['kondisi'] ?>',
								<?php echo $this->Aset_model->count_foto_aset($user['nomor_inventaris']) ?>
								)" data-toggle="modal" data-target="#edit-data" class="button bg-theme-9 text-white ml-2">
								<i data-feather="search" class="w-6 h-4"></i>
							</a>
						</div>
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
		<form action="<?php echo site_url('admin/pinjam/simpan');?>" method="POST">
			<div class="relative mt-2">
				<input type="text" class="input pr-4 w-full border col-span-4" placeholder="Nama peminjam"
					name="peminjam" required>
			</div>
			<div class="relative mt-2">
				<textarea  rows="2" name="keterangan" class="input pr-4 w-full border col-span-4"
					placeholder="Keterangan peminjaman" required></textarea>
			</div>
			<div class="px-5 py-3 text-right border-t border-gray-200">
				<button type="submit" class="button w-30 bg-theme-1 text-white">Pinjam</button>
			</div>
		</form>
	</div>
</div>
<!-- BEGIN: Delete Confirmation Modal -->
<div class="modal" id="hapus-data">
	<div class="modal__content">
		<div class="p-5 text-center">
			<i data-feather="plus-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
			<div class="text-3xl mt-5">Apakah kamu yakin?</div>
			<div class="text-gray-600 mt-2">Apakah Anda benar-benar ingin menambahkan aset ini kedaftar pinjaman?</div>
		</div>
		<div class="px-5 pb-8 text-center">
			<a id="link_hapus" href="" class="button w-24 border bg-theme-1 text-white">Tambahkan kedaftar pinjaman</a>
		</div>
	</div>
</div>
<!-- END: Delete Confirmation Modal -->
<!-- BEGIN: EDIT Confirmation Modal -->
<div class="modal" id="edit-data">
	<div class="modal__content modal__content--lg">
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
					<td>Jenis Aset </td>
					<td id="jenis">: </td>
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
<script>
	function edit(id_aset, nama, aset, stok, nomor_inventaris, merk, jenis, tanggal_masuk, ruang, status, kondisi,
		count_foto) {
		document.getElementById('h2_nama').innerHTML = nama;
		document.getElementById('nomor_inventaris').innerHTML = ': ' + nomor_inventaris;
		document.getElementById('jenis').innerHTML = ': ' + jenis;
		document.getElementById('qty').innerHTML = ': ' + stok + ' (Aset ' + aset + ')';
		document.getElementById('merk').innerHTML = ': ' + merk;
		document.getElementById('tanggal_masuk').innerHTML = ': ' + tanggal_masuk;
		document.getElementById('ruang').innerHTML = ': ' + ruang;
		document.getElementById('kondisi').innerHTML = ': ' + kondisi;
		if (count_foto > 0) {
			document.getElementById('ada').style.display = "block";
			document.getElementById('belum_ada').style.display = "none";
			document.getElementById('foto1').src = '<?php echo site_url('
			assets / upload / aset / ');?>' + nomor_inventaris + '1.jpg';
			document.getElementById('foto2').src = '<?php echo site_url('
			assets / upload / aset / ');?>' + nomor_inventaris + '2.jpg';
			document.getElementById('foto3').src = '<?php echo site_url('
			assets / upload / aset / ');?>' + nomor_inventaris + '3.jpg';
		} else {
			document.getElementById('ada').style.display = "none";
			document.getElementById('belum_ada').style.display = "block";
		}
	};

	function hapus(id) {
		var link = document.getElementById('link_hapus');
		link.href = "<?php echo site_url('admin/ruang/delete_data/');?>" + id;
	};

</script>
