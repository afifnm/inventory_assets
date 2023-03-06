<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto"> PENGAMBILAN ASET </h2>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
	<table class="table table-report table-report--bordered display datatable w-full">
		<thead>
			<tr>
				<th class="border-b-2 whitespace-no-wrap"># </th>
                <th class="border-b-2 whitespace-no-wrap">NAMA </th>
                <th class="border-b-2 whitespace-no-wrap">TANGGAL </th>
                <th class="border-b-2 whitespace-no-wrap">NAMA ASET </th>
                <th class="border-b-2 whitespace-no-wrap">JUMLAH  </th>
                <th class="border-b-2 whitespace-no-wrap">KETERANGAN </th>
				<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1; foreach ($ambil as $data) {?>
			<tr>
				<td class="text-left border-b"><?= $no; ?></td>
                <td class="text-left border-b"><?= $data['nama']; ?></td>
                <td class="text-left border-b"><?= mediumdate_indo($data['tanggal']); ?></td>
                <td class="text-left border-b"><?= $this->Aset_model->get_nama_aset($data['nomor_inventaris']); ?></td>
                <td class="text-left border-b"><?= $data['jumlah']; ?></td>
                <td class="text-left border-b"><?= $data['keterangan']; ?></td>
				<td class="border-b w-5">
					<div class="flex sm:justify-center items-center">
                        <?php if($data['status']==1){ ?>
						<a href="javascript:;"
							onclick="hapus(<?= $data['id_ambil'] ?>)"
							class="flex items-center text-theme-6" data-toggle="modal" data-target="#hapus-data">
							<i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
							Batal </a>
                        <?php } else { echo"dibatalkan"; } ?>
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
			<div class="text-gray-600 mt-2">Apakah Anda benar-benar ingin membatalkan pengambilan aset ini? Proses
				ini tidak bisa dibatalkan.</div>
		</div>
		<div class="px-5 pb-8 text-center">
			<a id="link_hapus" href="" class=" button w-24
				bg-theme-6 text-white">Batalkan Pengambilan</a>
		</div>
	</div>
</div>
<!-- END: Delete Confirmation Modal -->
<script>
	function hapus(id) {
		var link = document.getElementById('link_hapus');
		link.href = "<?php echo site_url('admin/ambil/batal/');?>" + id;
	};
</script>
