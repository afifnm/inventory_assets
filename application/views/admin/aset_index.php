<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto"> <?= $namajenis; ?> </h2>
	<?php if($this->uri->segment('2')=='aset'){ ?>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<?php if ($this->session->userdata('level') == "Admin") { ?>
		<a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview"
			class="button inline-block bg-theme-1 text-white">Tambah Aset </a>
		<?php } ?>
	</div>
	<?php } else { ?>
	<div class="relative text-gray-700 ml-5">
		<input type="text" class="input input--lg w-full lg:w-54 box placeholder-theme-13"
			placeholder="Pencarian aset..." id="cari" name="cari">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
			stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
			class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0">
			<circle cx="11" cy="11" r="8"></circle>
			<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
		</svg>
	</div>
	<script>
			var cari = document.getElementById('cari');
	cari.addEventListener("keydown", function (event) {
		if (event.keyCode == 13) {
			window.location.href = '<?php echo site_url('admin/home/pencarian/') ?>' + cari.value;
		}
	})
	</script>
	<?php } ?>
</div>
<!-- BEGIN: Datatable -->
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
						<?php if($user['stok']>0 AND $user['aset']=="Tidak Tetap"){ ?>
						<a href="javascript:;" onclick="ambil(
								'<?php echo $user['nomor_inventaris'] ?>',
								'<?php echo $user['nama'] ?>',
								'<?php echo $user['aset'] ?>',
								'<?php echo $user['stok'] ?>',
								'<?php echo $user['merk'] ?>',
								'<?php echo $user['ruang'] ?>',
								'<?php echo $user['status'] ?>',
								'<?php echo $user['id_jenis'] ?>'
								)" class="flex items-center text-orange pr-1" data-toggle="modal" data-target="#ambil">
							<i data-feather="rewind" class="w-4 h-4 mr-1"></i>
							Ambil
						</a>
						<?php } ?>
						<a href="<?php echo site_url('admin/aset/foto/'.$user['id_jenis'].'/'.$user['nomor_inventaris']);?>"
							class="flex items-center text-theme-1 pr-1">
							<i data-feather="check-square" class="w-4 h-4 mr-1"></i>
							Edit </a>
							<?php if ($this->session->userdata('level') == "Admin") { ?>
						<a href="javascript:;"
							onclick="hapus(<?= $user['id_jenis'] ?>,'<?= $user['nomor_inventaris'] ?>')"
							class="flex items-center text-theme-6" data-toggle="modal" data-target="#hapus-data">
							<i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
							Delete </a>
							<?php } ?>
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
							name="stok" min="1">
					</div>
				</div>
				<div class="mt-3">
					<label>Nomor Inventaris</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" placeholder="nomor inventaris"
							name="nomor_inventaris" required id="cek_nomor">
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
					<label>Sumber Dana</label>
					<div class="relative mt-2">
						<select name="id_sumber_dana" class="input pr-4 w-full border col-span-4">
							<?php foreach ($this->Aset_model->sumber_dana() as $sumber_dana){ ?>
							<option value="<?= $sumber_dana['id_sumber_dana']; ?>"><?= $sumber_dana['sumber_dana']; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="mt-3">
					<label>Tahun Perolehan</label>
					<div class="relative mt-2">
						<input type="number" class="input w-full pl-4 border" name="tahun_perolehan" min="2000" required>
					</div>
				</div>
				<div class="mt-3">
					<label>Harga</label>
					<div class="relative mt-2">
						<input type="number" class="input w-full pl-4 border" name="harga" min="0" required>
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
<!-- BEGIN: AMBIL ASET Confirmation Modal -->
<div class="modal" id="ambil">
	<div class="modal__content modal__content--xl">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base ml-3">PENGAMBILAN ASET </h2>
		</div>
		<div class="intro-y box p-5">
			<table class="ml-3 mb-3">
				<tr>
					<td>Nama Aset </td>
					<td id="nama">: </td>
				</tr>
				<tr>
					<td>Nomor Inventaris </td>
					<td id="nomor_inventaris2">: </td>
				</tr>
				<tr>
					<td>Jumlah/Stok</td>
					<td id="qty2">: </td>
				</tr>
				<tr>
					<td>Merk</td>
					<td id="merk2">: </td>
				</tr>
				<tr>
					<td>Ruang</td>
					<td id="ruang2">: </td>
				</tr>
				<tr>
					<td>Status</td>
					<td id="status2">: </td>
				</tr>
			</table>
			<form action="<?php echo site_url('admin/aset/ambil');?>" method="POST">
				<input type="hidden" name="nomor_inventaris" id="v_nomor_inventaris">
				<input type="hidden" name="jenis" id="v_jenis">
				<input type="hidden" name="stok_lama" id="v_stok">
				<div class="grid grid-cols-12 gap-4 row-gap-3 ml-3 mr-5 mb-5">
					<div class="col-span-12 sm:col-span-12"><label>Nama</label><input type="text" name="nama"
						required class="input w-full border mt-2 flex-1" placeholder="masukan nama yang mengambil..."> </div>
					<div class="col-span-12 sm:col-span-12"><label>Stok</label><input type="number" name="stok" min="1"
						required class="input w-full border mt-2 flex-1" placeholder="masukan stok yang diambil..."> </div>
					<div class="col-span-12 sm:col-span-12"><label>Keterangan</label><input type="text" name="keterangan"
						class="input w-full border mt-2 flex-1" placeholder="keterangan keperluan pengambilan ..."> </div>
				</div>
				<div class="text-right mr-5">
					<button type="submit" class="w-30 button bg-theme-1 text-white" onclick='confirm("Apakah anda yakin data isian benar?");'>Ambil Aset</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END: AMBIL ASET Confirmation Modal -->
<script>
	function ambil(nomor_inventaris, nama, aset, stok, merk, ruang, status, jenis) {
		document.getElementById('nama').innerHTML = ': ' + nama;
		document.getElementById('nomor_inventaris2').innerHTML = ': ' + nomor_inventaris;
		document.getElementById('qty2').innerHTML = ': ' + stok + ' (Aset ' + aset + ')';
		document.getElementById('v_nomor_inventaris').value = nomor_inventaris;
		document.getElementById('v_stok').value = stok;
		document.getElementById('v_jenis').value = jenis;
		document.getElementById('merk2').innerHTML = ': ' + merk;
		document.getElementById('ruang2').innerHTML = ': ' + ruang;
		document.getElementById('status2').innerHTML = ': ' + status;
	};
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

	function hapus(id_jenis, id) {
		var link = document.getElementById('link_hapus');
		link.href = "<?php echo site_url('admin/aset/delete_data/');?>" + id_jenis + '/' + id;
	};

	var select = document.getElementById('select_aset');
	select.addEventListener('change', function () {
		if (select.value == "Tidak Tetap") {
			document.getElementById('stok').style.display = "block";
		} else {
			document.getElementById('stok').style.display = "none";
		}
		console.log(select.value);
	})
	$("#cek_nomor").on({
    keydown: function(e) {
		console.log(e.which);
    if ((e.which === 191) || (e.which === 32) || (e.which === 220))
        return false;
    },
    change: function() {
        this.value = this.value.replace(/\s/g, "");
    }
    });
</script>
