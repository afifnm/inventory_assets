<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-6">
	<h2 class="text-lg font-medium mr-auto"> Buat Peminjaman </h2>
</div>
<!-- BEGIN: Datatable -->
<div class="grid grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-2 mt-5">
	<div class="col-span-2 md:col-span-2">
		<div class="col-span-2 sm:col-span-6">
			<div class="intro-y box p-5">
				<div>
					<label>Nama Peminjam</label>
					<input type="text" class="input w-full border" placeholder="Nama Peminjam" name="peminjam">
				</div>
				<div class="mt-3">
					<label>Keterangan</label>
					<textarea rows="2" class="input w-full border" placeholder="Tuliskan keterangan..."
						required></textarea>
				</div>
			</div>
		</div>
		<div class="intro-y box p-5 mt-5">
			<div>
				<label>Nama Peminjam</label>
				<input type="text" class="input w-full border" placeholder="Nama Peminjam" name="peminjam">
			</div>
			<div class="mt-3">
				<label>Keterangan</label>
				<textarea rows="2" class="input w-full border" placeholder="Tuliskan keterangan..." required></textarea>
			</div>
		</div>
		<div>
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
	<script>
		function hapus(id) {
			var link = document.getElementById('link_hapus');
			link.href = "<?php echo site_url('admin/ruang/delete_data/');?>" + id;
		};

	</script>
