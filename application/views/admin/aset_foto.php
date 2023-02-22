<div id="myalert">
	<?php echo $this->session->flashdata('alert', true)?>
</div>

<?php foreach ($aset as $u) { ?>
<div class="grid gap-5 mt-10 md:grid-cols-5">
	<div class="col-span-3">
		<form action="<?php echo site_url('admin/aset/updatedata');?>" method="POST">
			<div class="intro-y box p-5">
				<div class="mt-2">
					<label>Nomor Inventaris</label>
					<div class="relative mt-1">
						<input type="text" class="input pr-4 w-full border" name="nomor_inventaris"
							value="<?= $u->nomor_inventaris; ?>" readonly>
					</div>
				</div>
				<div class="mt-3">
					<label>Nama Aset</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border" name="nama" value="<?= $u->nama; ?>">
					</div>
				</div>
				<input type="hidden" name="aset" value="<?= $u->aset; ?>">
				<?php if($u->aset=="Tidak Tetap"){ ?>
				<div class="mt-2">
					<label>Stok/Jumlah</label>
					<div class="relative mt-1">
						<input type="number" class="input pr-4 w-full border" name="stok" value="<?= $u->stok; ?>">
					</div>
				</div>
				<?php } ?>
				<div class="mt-2">
					<label>Merk</label>
					<div class="relative mt-1">
						<input type="text" class="input pr-4 w-full border" name="merk" value="<?= $u->merk; ?>">
					</div>
				</div>
				<div class="mt-2">
					<label>Jenis Aset</label>
					<div class="relative mt-1">
						<select name="id_jenis" class="input pr-4 w-full border col-span-4">
							<?php foreach ($this->Aset_model->jenis() as $jenis){ ?>
							<option value="<?= $jenis['id_jenis']; ?>"
								<?php if($u->id_jenis==$jenis['id_jenis']){ echo"selected"; } ?>>
								<?= $jenis['jenis']; ?>
							</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="mt-2">
					<label>Ruang/Tempat</label>
					<div class="relative mt-1">
						<select name="id_ruang" class="input pr-4 w-full border col-span-4">
							<?php foreach ($this->Aset_model->ruang() as $ruang){ ?>
							<option value="<?= $ruang['id_ruang']; ?>"
								<?php if($u->id_ruang==$ruang['id_ruang']){ echo"selected"; } ?>><?= $ruang['ruang']; ?>
							</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="mt-3">
					<label>Tanggal Masuk</label>
					<div class="relative mt-1">
						<input type="date" class="input w-full pl-4 border" name="tanggal_masuk"
							value="<?= $u->tanggal_masuk; ?>">
					</div>
				</div>
				<div class="mt-2">
					<label>Kondisi</label>
					<div class="relative mt-1">
						<select name="kondisi" class="input pr-4 w-full border">
							<option value="Baik" <?php if($u->kondisi=="Baik"){ echo"selected"; } ?>>Baik</option>
							<option value="Rusak" <?php if($u->kondisi=="Rusak"){ echo"selected"; } ?>>Rusak</option>
							<option value="Perbaikan" <?php if($u->kondisi=="Perbaikan"){ echo"selected"; } ?>>Perbaikan
							</option>
							<option value="Hilang" <?php if($u->kondisi=="Hilang"){ echo"selected"; } ?>>Hilang</option>
						</select>
					</div>
				</div>
				<div class="flex items-center text-gray-700 mt-5">
					<input type="checkbox" class="input border mr-2" id="confirm">
					<label>Apakah anda yakin ingin mengubah data aset ini?</label>
				</div>
				<div class="px-5 py-3 text-right border-t border-gray-200" id="simpan" hidden>
					<button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-span-2 dropzone border-gray-200 border-dashed">
		<label>Pilih foto yang akan diupload</label>
		<form method='post' action='<?php echo site_url('admin/aset/uploadfoto');?>' enctype='multipart/form-data'>
			<input type="hidden" name="nomor_inventaris" value="<?php echo $u->nomor_inventaris; ?>">
			<input type="hidden" name="id_jenis" value="<?php echo $u->id_jenis; ?>">
			<input name="foto" type="file" accept="image/jpeg" class="input w-full pl-4 border" required>
			<div class="px-5 py-3 text-right border-t border-gray-200">
				<button type="submit" class="button w-40 bg-theme-1 text-white">Upload Foto</button>
			</div>
		</form>
		<?php foreach ($this->Aset_model->foto_aset($u->nomor_inventaris) as $foto) { ?>
		<div class="box rounded-md p-3">
			<div class="flex-none pos-image relative block">
				<img class="rounded-md" src="<?php echo site_url('assets/upload/aset/'.$foto['namafile']);?>">
			</div>
			<a href="<?php echo site_url('admin/aset/delete_foto/'.$u->id_jenis.'/'.$foto['namafile'].'/'.$u->nomor_inventaris);?>"
			class="button button--sm mr-1 mb-2 bg-theme-6 text-white"
			 onClick="return confirm('Apakah anda yakin menghapus foto ini?')">Hapus Foto</a>
		</div>
		<?php } ?>
	</div>
</div>
<div class="intro-y datatable-wrapper box p-5 mt-5">
	<table class="table table-report table-report--bordered display datatable w-full" style="font-size: 12px;">
		<thead>
			<tr>
				<th class="border-b-2 text-center whitespace-no-wrap">NO</th>
				<th class="border-b-2 whitespace-no-wrap">Waktu </th>
				<th class="border-b-2 whitespace-no-wrap">Keterangan </th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1; foreach ($this->Aset_model->logs_aset($u->nomor_inventaris) as $user) {?>
			<tr>
				<td class="text-center border-b"><?= $no; ?></td>
				<td class="text-left whitespace-no-wrap"><?= $user['datetime']; ?></td>
				<td class="text-left border-b"><?= $user['keterangan']; ?></td>
			</tr>
			<?php $no++; } ?>
		</tbody>
	</table>
</div>
<?php } ?>
<div class="modal" id="hapus-data">
	<div class="modal__content">
		<div class="p-5 text-center">
			<i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
			<div class="text-3xl mt-5">Apakah kamu yakin?</div>
			<div class="text-gray-600 mt-2">Apakah Anda benar-benar ingin menghapus foto ini? Proses
				ini tidak bisa dibatalkan.</div>
		</div>
		<div class="px-5 pb-8 text-center">
			<button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Batal</button>
			<a id="link_hapus" href="" class=" button w-24
				bg-theme-6 text-white">Hapus</a>
		</div>
	</div>
</div>
<script>
	var konfirrmasi = document.getElementById('confirm');
	konfirrmasi.addEventListener('change', function () {
		console.log(konfirrmasi.checked);
		if (konfirrmasi.checked == true) {
			document.getElementById('simpan').style.display = "block";
		} else {
			document.getElementById('simpan').style.display = "none";
		}
		console.log(select.value);
	})

	function hapus(id_jenis, namafile, id) {
		var link = document.getElementById('link_hapus');
		link.href = "<?php echo site_url('admin/aset/delete_foto/');?>" + id_jenis + '/' + id;
	};

</script>
