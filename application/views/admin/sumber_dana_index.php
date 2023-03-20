<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		SUMBER DANA
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<?php if ($this->session->userdata('level') == "Admin") { ?>
		<a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview"
			class="button inline-block bg-theme-1 text-white">Tambah Sumber Dana</a>
		<?php } ?>
	</div>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
	<table class="table table-report table-report--bordered display datatable w-full">
		<thead>
			<tr>
				<th class="border-b-2 whitespace-no-wrap">SUMBER DANA</th>
				<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1; foreach ($data2 as $user) {?>
			<tr>
				<td class="text-left border-b"><?php echo $user['sumber_dana']; ?></td>
				<td class="border-b w-5">
					<div class="flex sm:justify-center items-center">
						<?php if ($this->session->userdata('level') == "Admin") { ?>
						<a href="javascript:;"
							onclick="edit(<?php echo $user['id_sumber_dana'] ?>,'<?php echo $user['sumber_dana'] ?>')"
							class="flex items-center mr-3" data-toggle="modal" data-target="#edit-data">
							<i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
						</a>
						<a href="javascript:;" 
							onclick="hapus(<?php echo $user['id_sumber_dana'] ?>)"
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
	<div class="modal__content">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base mr-auto">TAMBAH SUMBER DANA</h2>
		</div>
		<form action="<?php echo site_url('admin/sumber_dana/simpan');?>" method="POST">
			<div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
				<div class="col-span-12 sm:col-span-12"><input type="text" name="sumber_dana" required
						class="input w-full border mt-2 flex-1" placeholder="Masukan sumber dana..."> </div>
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
			<h2 class="font-medium text-base mr-auto">PERBARUI SUMBER DANA</h2>
		</div>
		<form action="<?php echo site_url('admin/sumber_dana/updatedata');?>" method="POST">
			<input type="hidden" name="id" id="id" class="input w-full border mt-2">
			<div class="col-span-12 sm:col-span-6">
				<input type="text" name="sumber_dana" class="input w-full border mt-2" id="sumber_dana">
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
	function edit(id, sumber_dana) {
		var input_id = document.getElementById('id');
		var input_sumber_dana = document.getElementById('sumber_dana');
		input_id.value = id;
		input_sumber_dana.value = sumber_dana;
	};
	function hapus(id) {
		var link = document.getElementById('link_hapus');
		console.log(id);
		link.href = "<?php echo site_url('admin/sumber_dana/delete_data/');?>"+id;
	};
</script>
