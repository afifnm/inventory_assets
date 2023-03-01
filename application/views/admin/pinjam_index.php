<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto"> Peminjaman Aset </h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="<?php echo site_url('admin/pinjam/buat/');?>" class="button inline-block bg-theme-1 text-white">Buat Peminjaman </a>
	</div>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
	<table class="table table-report table-report--bordered display datatable w-full">
		<thead>
			<tr>
				<th class="border-b-2 whitespace-no-wrap"># </th>
                <th class="border-b-2 whitespace-no-wrap">TANGGAL PEMINJAMAN </th>
                <th class="border-b-2 whitespace-no-wrap">PEMINJAMAN </th>
                <th class="border-b-2 whitespace-no-wrap">STATUS </th>
				<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1; foreach ($pinjam as $data) {?>
			<tr>
				<td class="text-left border-b"><?= $no; ?></td>
                <td class="text-left border-b"><?= mediumdate_indo($data['tanggal_peminjaman']); ?></td>
                <td class="text-left border-b"><?= $data['peminjam']; ?></td>
                <td class="text-left border-b"><?= $data['status']; ?></td>
				<td class="border-b w-5">
					<div class="flex sm:justify-center items-center">
						<a href="<?php echo site_url('admin/ruang/aset/'.$user['id_ruang']);?>" class="flex items-center text-theme-1 mr-3">
							<i data-feather="search" class="w-4 h-4 mr-1"></i>
							Detail </a>
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
