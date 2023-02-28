<h3 class="text-md font-medium mr-auto mt-5">
	Selamat Datang <?= $this->session->userdata('nama') ?> (<?= $this->session->userdata('level') ?>)
</h3>
<div class="intro-y flex flex-col sm:flex-row items-center mt-5">
	<div class="relative text-gray-700 mr-auto">
		<input type="text" class="input input--lg w-full lg:w-54 box placeholder-theme-13"
			placeholder="Pencarian aset..." id="cari" name="cari">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
			stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
			class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0">
			<circle cx="11" cy="11" r="8"></circle>
			<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
		</svg>
	</div>
	<div class="w-full sm:w-auto flex mt-4 ml-5 sm:mt-0">
		<a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview"
			class="button mr-1 inline-block bg-theme-1 text-white">Tambah Aset </a>
		<a href=" javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview"
			class="button mr-1 inline-block bg-theme-1 text-white">Logs Aktivitas</a>
	</div>
</div>
<div class="grid grid-cols-3 gap-4">
	<div class="col-span-3 md:col-span-2">
		<div class="grid grid-cols-2 md:grid-cols-4 sm:grid-cols-1 gap-2 mt-5">
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
		<div class="grid grid-cols-2 md:grid-cols-4 sm:grid-cols-1 gap-2 mt-5">
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
	<div class="col-span-3 md:col-span-1">
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
						<a href="javascript:;"
							class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
							<div class="pos__ticket__item-name truncate mr-1">Afif </div>
							<div class="ml-auto">Belum Dikembalikan</div>
						</a>
						<a href="javascript:;"
							class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
							<div class="pos__ticket__item-name truncate mr-1">Maisaroh</div>
							<div class="ml-auto">Sudah Dikembalikan</div>
						</a>
					</div>
				</div>
				<div class="tab-content__pane" id="details">
					<div class="pos__ticket box p-2 mt-5">
						<a href="javascript:;"
							class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
							<div class="pos__ticket__item-name truncate mr-1">Afif</div>
							<div class="ml-auto">Pending</div>
						</a>
						<a href="javascript:;"
							class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
							<div class="pos__ticket__item-name truncate mr-1">Maisa</div>
							<div class="ml-auto">Pending</div>
						</a>
					</div>
				</div>
			</div>
		</div>
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
<script>
	var cari = document.getElementById('cari');
	cari.addEventListener("keydown", function (event) {
		if (event.keyCode == 13) {
			window.location.href = '<?php echo site_url('admin/home/pencarian/') ?>' + cari.value;
		}
	})
</script>