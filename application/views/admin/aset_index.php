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
				<th class="border-b-2 whitespace-no-wrap">STOK </th>
				<th class="border-b-2 whitespace-no-wrap">TEMPAT </th>
				<th class="border-b-2 whitespace-no-wrap">TGL. MASUK</th>
				<th class="border-b-2 text-center whitespace-no-wrap">STATUS</th>
				<th class="border-b-2 text-center whitespace-no-wrap">KONDISI</th>
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
					<?php if($user['aset']=="Tetap"){ echo "Aset Tetap"; } else { echo $user['stok']; } ?> </td>
				<td class="text-left border-b"><?= $user['ruang']; ?></td>
				<td class="text-left border-b"><?= mediumdate_indo($user['tanggal_masuk']); ?></td>
				<td class="text-left border-b text-center ">
					<label class="button w-24 rounded-full mr-1 mb-2 bg-theme-9 text-white"><?= $user['status']; ?></label>
				</td>
				<td class="text-left border-b text-center ">
					<label class="button w-24 rounded-full mr-1 mb-2 bg-theme-9 text-white"><?= $user['kondisi']; ?></label>
				</td>
				<td class="border-b w-5">
					<div class="flex sm:justify-center items-center">
						<a href="javascript:;"
							onclick="hapus(<?= $user['id_jenis'] ?>,'<?= $user['nomor_inventaris'] ?>')"
							class="flex items-center text-theme-6" data-toggle="modal" data-target="#hapus-data">
							<i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
							Foto </a>
						<a href="javascript:;"
							onclick="hapus(<?= $user['id_jenis'] ?>,'<?= $user['nomor_inventaris'] ?>')"
							class="flex items-center text-theme-6" data-toggle="modal" data-target="#hapus-data">
							<i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
							Edit </a>
						<a href="javascript:;"
							onclick="hapus(<?= $user['id_jenis'] ?>,'<?= $user['nomor_inventaris'] ?>')"
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
					<div class="sm:grid grid-cols-2 gap-2">
						<div class="relative mt-2">
							<input type="text" class="input pl-4 w-full border col-span-4" placeholder="nama aset.."
								name="nama" required>
						</div>
						<div class="relative mt-2">
							<select name="aset" id="select_aset" class="input pl-4 w-full border col-span-4">
								<option value="Tetap">Tetap</option>
								<option value="Tidak Tetap">Tidak Tetap</option>
							</select>
						</div>
					</div>
				</div>
				<div class="mt-3" id="stok" hidden>
					<label>Jumlah Stok (Qty)</label>
					<div class="relative mt-2">
						<input type="number" class="input pr-4 w-full border col-span-4" placeholder="jumlah stok aset"
							name="stok">
					</div>
				</div>
				<div class="mt-3">
					<label>Nomor Inventaris</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" placeholder="nomor inventaris"
							name="nomor_inventaris" required>
					</div>
				</div>
				<div class="mt-3">
					<label>Merk</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" placeholder="merk aset"
							name="merk" required>
					</div>
				</div>
				<div class="mt-3">
					<label>Jenis Aset</label>
					<div class="relative mt-2">
						<select name="id_jenis" class="input pr-4 w-full border col-span-4">
							<?php foreach ($this->Aset_model->jenis() as $jenis){ ?>
							<option value="<?= $jenis['id_jenis']; ?>"
								<?php if($id_jenis==$jenis['id_jenis']){ echo"selected"; } ?>>
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
							<?php foreach ($this->Aset_model->ruang() as $ruang){ ?>
							<option value="<?= $ruang['id_ruang']; ?>"><?= $ruang['ruang']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="mt-3">
					<label>Tanggal Masuk</label>
					<div class="relative mt-2">
						<input type="date" class="input w-full pl-4 border" name="tanggal_masuk" required>
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

	function hapus(id_jenis, id) {
		var link = document.getElementById('link_hapus');
		link.href = "<?php echo site_url('admin/aset/delete_data/');?>" + id_jenis + '/' + id;
	};

	const select = document.getElementById('select_aset');
	select.addEventListener('change', function () {
		console.log(select.value);
		if (select.value == "Tidak Tetap") {
			document.getElementById('stok').style.display = "block";
		} else {
			document.getElementById('stok').style.display = "none";
		}
		console.log(select.value);
	})

</script>
