<h3 class="text-xl font-medium mr-auto mt-5">
	SISTEM INFORMASI INVENTARIS ASET SMKN 1 KARANGANYAR
</h3>
<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-5">
	<div class="relative text-gray-700 mr-auto">
		<a href="javascript:;" data-toggle="modal" data-target="#pencarian"
			class="button mr-1 inline-block bg-theme-1 text-white">Pencarian Aset </a>
	</div>
	<div class="w-full sm:w-auto flex mt-4 ml-5 sm:mt-0">
		<?php if ($this->session->userdata('level') == "Admin") { ?>
		<a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview"
			class="button mr-1 inline-block bg-theme-1 text-white">Tambah Aset </a>
		<?php } ?>
		<a href="javascript:;" data-toggle="modal" data-target="#expor"
			class="button mr-1 inline-block bg-theme-1 text-white">Export </a>
		<a href="javascript:;" data-toggle="modal" data-target="#import"
			class="button mr-1 inline-block bg-theme-1 text-white">Import </a>
		<a href=" javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview"
			class="button mr-1 inline-block bg-theme-1 text-white">Logs Aktivitas</a>
	</div>
</div>
<div class="modal" id="import">
	<div class="modal__content modal__content--lg">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">IMPORT DATA </h2>
		</div>
		<form action="<?php echo site_url('admin/home/import_excel');?>" method="POST" enctype="multipart/form-data">
			<div class="intro-y box p-5">
				<div class="mt-3">
					<label>Pilih File</label>
					<div class="relative mt-2">
						<input  accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
						 type="file" name="file" id="file" class="input w-full border col-span-4" required>
					</div>
					<br>
					<a href="<?= base_url('assets/upload/import.xlsx') ?>">Download format import</a>
				</div>
			</div>
			<div class="px-5 py-3 text-right border-t border-gray-200">
				<button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
			</div>
		</form>
	</div>
</div>
<div class="grid grid-cols-3 gap-4">
	<div class="col-span-3 md:col-span-3">
		<div class="grid grid-cols-2 md:grid-cols-5 sm:grid-cols-1 gap-2 mt-5">
			<div class="box p-5 cursor-pointer zoom-in">
				<a href="<?php echo site_url('admin/aset/jenis/0');?>">
					<div class="font-medium text-base">Jenis belum dipilih</div>
					<div class="text-gray-600"><?= $this->Aset_model->count_jenis_aset(0); ?> aset</div>
				</a>
			</div>
			<?php foreach ($this->Aset_model->jenis() as $key) { ?>
			<div class="box p-5 cursor-pointer zoom-in">
				<a href="<?php echo site_url('admin/aset/jenis/'.$key['id_jenis']);?>">
					<div class="font-medium text-base"><?php echo $key['jenis']; ?> </div>
					<div class="text-gray-600"><?= $this->Aset_model->count_jenis_aset($key['id_jenis']); ?> aset</div>
				</a>
			</div>
			<?php } ?>
		</div>
		<hr class="mt-4 mb-2">
		<div class="grid grid-cols-2 md:grid-cols-5 sm:grid-cols-1 gap-2 mt-5">
			<div class="box p-5 cursor-pointer zoom-in">
				<a href="<?php echo site_url('admin/ruang/aset/0');?>">
					<div class="font-medium text-base">Belum ada ruang </div>
					<div class="text-gray-600"><?= $this->Aset_model->count_ruang_aset(0); ?> aset</div>
				</a>
			</div>
			<?php foreach ($this->Aset_model->ruang() as $key) { ?>
			<div class="box p-5 cursor-pointer zoom-in">
				<a href="<?php echo site_url('admin/ruang/aset/'.$key['id_ruang']);?>">
					<div class="font-medium text-base"><?php echo $key['ruang']; ?> </div>
					<div class="text-gray-600"><?= $this->Aset_model->count_ruang_aset($key['id_ruang']); ?> aset</div>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>
	<!-- <div class="col-span-3 md:col-span-1">
		<div class="col-span-12 md:col-span-4 mt-5">
			<div class="intro-y pr-1">
				<div class="box p-2">
					<div class="pos__tabs nav-tabs justify-center flex">
						<a data-toggle="tab" data-target="#ticket" href="javascript:;"
							class="flex-1 py-2 rounded-md text-center active">Pinjam Aset</a>
						<a data-toggle="tab" data-target="#details" href="javascript:;"
							class="flex-1 py-2 rounded-md text-center">Ambil Aset</a>
					</div>
				</div>
			</div>
			<div class="tab-content">
				<div class="tab-content__pane active" id="ticket">
					<div class="pos__ticket box p-2 mt-5">
						<?php  $no = 1; foreach ($pinjam as $data) {?>
						<a href="<?php echo site_url('admin/pinjam/detail/'.$data['kode_pinjam']);?>"
							class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
							<div class="pos__ticket__item-name truncate mr-1"><?= $data['peminjam']; ?></div>
							<div class="ml-auto">
								<?php 
								$cek= $this->db->where('kode_pinjam', $data['kode_pinjam'])->where('status',0)->count_all_results('detail_pinjam');   
								if($cek>0){
										echo'<span class="button rounded-full bg-theme-6 text-white">belum dikembalikan</span>';
									 } else { 
										echo'<span class="button rounded-full bg-theme-9 text-white">sudah dikembalikan</span>';
									}
								?>	
							</div>
						</a>
						<?php $no++; } ?>
					</div>
				</div>
				<div class="tab-content__pane" id="details">
					<div class="pos__ticket box p-2 mt-5">
						<?php  $no = 1; foreach ($ambil as $data) {?>
						<a onclick="ambil(
								'<?php echo $data['nama'] ?>',
								'<?php echo $this->Aset_model->get_nama_aset($data['nomor_inventaris']) ?>',
								'<?php echo $data['nomor_inventaris'] ?>',
								'<?php echo $data['jumlah'] ?>',
								'<?php echo mediumdate_indo($data['tanggal']) ?>',
								'<?php echo $data['keterangan'] ?>',
								'<?php echo $data['status'] ?>',
								'<?php echo $this->Aset_model->get_nama($data['operator']) ?>'
								)" data-toggle="modal" data-target="#ambil" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
							<div class="pos__ticket__item-name truncate mr-1"><?= $data['nama']; ?></div>
							<div class="ml-auto">
								<?php  
								if($data['status']==0){
										echo'<span class="button rounded-full bg-theme-6 text-white">dibatalkan</span>';
									 } else { 
										echo'<span class="button rounded-full bg-theme-9 text-white">berhasil</span>';
									}
								?>	
							</div>
						</a>
						<?php $no++; } ?>
					</div>
				</div>
			</div>
		</div>
	</div> -->
</div>
<div class="modal" id="expor">
	<div class="modal__content modal__content--lg">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">EXPORT TO EXCEL </h2>
		</div>
		<form action="<?php echo site_url('admin/home/excel');?>" method="POST">
						<div class="intro-y box p-5">
				<div class="mt-3">
					<label>Nama Aset</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" placeholder="nomor inventaris" name="nama">
					</div>
				</div>
				<div class="mt-3">
					<label>Nomor Inventaris</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" placeholder="nomor inventaris" name="nomor_inventaris">
					</div>
				</div>
				<div class="mt-3">
					<label>Merk</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" placeholder="merk aset"
							name="merk" >
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
							<option value="<?= $sumber_dana['id_sumber_dana']; ?>"><?= $sumber_dana['sumber_dana']; ?></option>
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
				<button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
			</div>
		</form>
	</div>
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
<div class="modal" id="pencarian">
	<div class="modal__content modal__content--lg">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">PENCARIAN ASET </h2>
		</div>
		<form action="<?php echo site_url('admin/home/pencarian');?>" method="POST">
			<div class="intro-y box p-5">
				<div class="mt-3">
					<label>Nama Aset</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" placeholder="nomor inventaris" name="nama">
					</div>
				</div>
				<div class="mt-3">
					<label>Nomor Inventaris</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" placeholder="nomor inventaris" name="nomor_inventaris">
					</div>
				</div>
				<div class="mt-3">
					<label>Merk</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" placeholder="merk aset"
							name="merk" >
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
							<option value="<?= $sumber_dana['id_sumber_dana']; ?>"><?= $sumber_dana['sumber_dana']; ?></option>
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
<div class="modal" id="superlarge-modal-size-preview">
	<div class="modal__content modal__content--xl text-center">
		<div class="intro-y datatable-wrapper box p-5 mt-5">
			<h2 class="text-lg font-medium mb-3"> LOGS AKTIVITAS </h2>
			<table class="table table-report table-report--bordered display datatable w-full" style="font-size: 12px;">
				<thead>
					<tr>
						<th class="border-b-2 text-center whitespace-no-wrap">NO</th>
						<th class="border-b-2 whitespace-no-wrap">Waktu </th>
						<th class="border-b-2 whitespace-no-wrap">Keterangan </th>
					</tr>
				</thead>
				<tbody>
					<?php  $no = 1; foreach ($this->Aset_model->logs() as $user) {?>
					<tr>
						<td class="text-center border-b"><?= $no; ?></td>
						<td class="text-left whitespace-no-wrap"><?= $user['datetime']; ?></td>
						<td class="text-left border-b"><?= $user['keterangan']; ?></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- BEGIN: AMBIL ASET Confirmation Modal -->
<div class="modal" id="ambil">
	<div class="modal__content modal__content--lg">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base ml-3">PENGAMBILAN ASET </h2>
		</div>
		<div class="intro-y box p-5">
			<table class="ml-3 mb-3">
				<tr>
					<td>Nama </td>
					<td id="nama">: </td>
				</tr>
				<tr>
					<td>Aset Yang Diambil </td>
					<td id="aset">: </td>
				</tr>
				<tr>
					<td>Nomor Inventaris </td>
					<td id="nomor_inventaris">:</td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td id="jumlah">: </td>
				</tr>
				<tr>
					<td>Tanggal</td>
					<td id="tanggal">: </td>
				</tr>
				<tr>
					<td>Keterangan</td>
					<td id="keterangan">: </td>
				</tr>
				<tr>
					<td>Status</td>
					<td id="status">: </td>
				</tr>
				<tr>
					<td>Operator</td>
					<td id="operator">: </td>
				</tr>
			</table>
		</div>
	</div>
</div>
<!-- END: AMBIL ASET Confirmation Modal -->
<script>
	function ambil(nama, aset, nomor_inventaris, jumlah, tanggal, keterangan, status, operator) {
		document.getElementById('nama').innerHTML = ': ' + nama;
		document.getElementById('aset').innerHTML = ': ' + aset;
		document.getElementById('nomor_inventaris').innerHTML = ': ' + nomor_inventaris;
		document.getElementById('jumlah').innerHTML = ': ' + jumlah;
		document.getElementById('tanggal').innerHTML = ': ' + tanggal;
		document.getElementById('keterangan').innerHTML = ': ' + keterangan;
		if (status==1) {
			document.getElementById('status').innerHTML = ': ' + status;
		} else {
			document.getElementById('status').innerHTML = ': dibatalkan';
		}
		document.getElementById('operator').innerHTML = ': ' + operator;
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