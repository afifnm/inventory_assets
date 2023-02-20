<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto"> <?= $namajenis; ?> </h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview"
			class="button inline-block bg-theme-1 text-white">Tambah Aset </a>
	</div>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
	<table class="table table-report table-report--bordered display datatable w-full">
		<thead>
			<tr>
				<th class="border-b-2 text-center whitespace-no-wrap">NO</th>
				<th class="border-b-2 whitespace-no-wrap">NAMA ASET </th>
				<th class="border-b-2 whitespace-no-wrap">NOMOR INVENTARIS </th>
				<th class="border-b-2 whitespace-no-wrap">ASET TIDAK/TETAP </th>
				<th class="border-b-2 whitespace-no-wrap">TEMPAT </th>
				<th class="border-b-2 text-center whitespace-no-wrap">TGL. MASUK</th>
				<th class="border-b-2 text-center whitespace-no-wrap">STATUS</th>
				<th class="border-b-2 text-center whitespace-no-wrap">KONDISI</th>
				<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1; foreach ($data2 as $user) {?>
			<tr>
				<td class="text-center border-b"><?php echo $no; ?></td>
				<td class="text-left border-b"><?php echo $user['nama']; ?></td>
				<td class="text-left border-b"><?php echo $user['nomor_inventaris']; ?></td>
				<td class="text-left border-b"><?php echo $user['aset']; ?></td>
				<td class="text-left border-b"><?php echo $user['tempat']; ?></td>
				<td class="text-left border-b"><?php echo $user['tanggal_masuk']; ?></td>
				<td class="text-left border-b"><?php echo $user['status']; ?></td>
				<td class="text-left border-b"><?php echo $user['kondisi']; ?></td>
				<td class="border-b w-5">
					<div class="flex sm:justify-center items-center">
						<a href="javascript:;" class="flex items-center text-theme-1 mr-3">
							<i data-feather="search" class="w-4 h-4 mr-1"></i>
							Lihat Aset </a>
						<a href="javascript:;" onclick="edit(
                                <?php echo $user['id_ruang'] ?>,
                                '<?php echo $user['ruang'] ?>',
                                '<?php echo $user['keterangan'] ?>'
                                )" class="flex items-center mr-3" data-toggle="modal" data-target="#edit-data">
							<i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
						</a>
						<a href="javascript:;" onclick="hapus(<?php echo $user['id_ruang'] ?>)"
							class="flex items-center text-theme-6" data-toggle="modal" data-target="#hapus-data">
							<i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
							Delete </a>
					</div>
				</td>
			</tr>
			<?php $no++; } ?>
		</tbody>
	</table>
</div>
<div class="modal" id="header-footer-modal-preview">
	<div class="modal__content modal__content--lg">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">TAMBAH ASET </h2>
		</div>
		<form action="<?php echo site_url('admin/aset/simpan');?>" method="POST">
			<div class="intro-y box p-5">
        <div class="mt-1">
					<label> Nama Aset</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-12 w-full border col-span-4" placeholder="Nama aset..." name="nama" required>
					</div>
        </div>
				<div class="mt-3">
					<label>Quantity</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-12 w-full border col-span-4" placeholder="Price">
						<div
							class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">
							pcs</div>
					</div>
				</div>
				<div class="mt-3">
					<label>Weight</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-16 w-full border col-span-4" placeholder="Price">
						<div
							class="absolute top-0 right-0 rounded-r w-16 h-full flex items-center justify-center bg-gray-100 border text-gray-600">
							grams</div>
					</div>
				</div>
				<div class="mt-3">
					<label>Price</label>
					<div class="sm:grid grid-cols-3 gap-2">
						<div class="relative mt-2">
							<div
								class="absolute top-0 left-0 rounded-l w-12 h-full flex items-center justify-center bg-gray-100 border text-gray-600">
								Unit</div>
							<div class="pl-3">
								<input type="text" class="input pl-12 w-full border col-span-4" placeholder="Price">
							</div>
						</div>
						<div class="relative mt-2">
							<div
								class="absolute top-0 left-0 rounded-l w-20 h-full flex items-center justify-center bg-gray-100 border text-gray-600">
								Wholesale</div>
							<div class="pl-3">
								<input type="text" class="input pl-20 w-full border col-span-4" placeholder="Price">
							</div>
						</div>
						<div class="relative mt-2">
							<div
								class="absolute top-0 left-0 rounded-l w-12 h-full flex items-center justify-center bg-gray-100 border text-gray-600">
								Bulk</div>
							<div class="pl-3">
								<input type="text" class="input pl-12 w-full border col-span-4" placeholder="Price">
							</div>
						</div>
					</div>
				</div>
				<div class="mt-3">
					<label>Active Status</label>
					<div class="mt-2">
						<input type="checkbox" class="input input--switch border">
					</div>
				</div>
			</div>
			<div class="px-5 py-3 text-right border-t border-gray-200">
				<button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
			</div>
		</form>
	</div>
</div>
<!-- BEGIN: EDIT Confirmation Modal -->
<div class="modal" id="edit-data">
	<div class="modal__content p-10 text-center">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">PERBARUI NAMA RUANG </h2>
		</div>
		<form action="<?php echo site_url('admin/ruang/updatedata');?>" method="POST">
			<input type="hidden" name="id" id="id" class="input w-full border mt-2">
			<div class="col-span-12 sm:col-span-6">
				<input type="text" name="ruang" class="input w-full border mt-2" id="ruang">
			</div>
			<div class="col-span-12 sm:col-span-6">
				<input type="text" name="keterangan" class="input w-full border mt-2" id="keterangan">
			</div>
			<div class="px-5 py-3 text-right border-t border-gray-200">
				<button type="submit" class="button bg-theme-1 text-white mt-5">Simpan</button>
			</div>
		</form>
	</div>
</div>
<!-- END: EDIT Confirmation Modal -->
<!-- BEGIN: Delete Confirmation Modal -->
<div class="modal" id="hapus-data">
	<div class="modal__content">
		<div class="p-5 text-center">
			<i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
			<div class="text-3xl mt-5">Apakah kamu yakin?</div>
			<div class="text-gray-600 mt-2">Apakah Anda benar-benar ingin menghapus data ini? Proses
				ini tidak bisa dibatalkan.</div>
		</div>
		<div class="px-5 pb-8 text-center">
			<button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Batal</button>
			<a id="link_hapus" href="" class=" button w-24
				bg-theme-6 text-white">Hapus</a>
		</div>
	</div>
</div>
<!-- END: Delete Confirmation Modal -->
<script>
	function edit(id, ruang, keterangan) {
		document.getElementById('id').value = id;
		document.getElementById('ruang').value = ruang;
		document.getElementById('keterangan').value = keterangan;
	};

	function hapus(id) {
		var link = document.getElementById('link_hapus');
		link.href = "<?php echo site_url('admin/ruang/delete_data/');?>" + id;
	};

</script>
