<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		JENIS ASSET
	</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<button class="button text-white bg-theme-1 shadow-md mr-2">Tambah Jenis Asset</button>
	</div>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
	<table class="table table-report table-report--bordered display datatable w-full">
		<thead>
			<tr>
				<th class="border-b-2 whitespace-no-wrap">NAMA JENIS ASSET</th>
				<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1; foreach ($data2 as $user) {?>
			<tr>
				<td class="text-left border-b"><?php echo $user['kategori']; ?></td>
				<td class="border-b w-5">
					<div class="flex sm:justify-center items-center">
						<a class="flex items-center mr-3"
							href="<?php echo site_url('admin/kategori/editdata/'.$user['id_kategori']);?>"> <i
								data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
						</a>
						<a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal"
							data-target="#delete-confirmation-modal<?=$user['id_kategori'];?>"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
							Delete </a>
					</div>
					<!-- BEGIN: Delete Confirmation Modal -->
					<div class="modal" id="delete-confirmation-modal<?=$user['id_kategori'];?>">
						<div class="modal__content">
							<div class="p-5 text-center">
								<i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
								<div class="text-3xl mt-5">Apakah kamu yakin?</div>
								<div class="text-gray-600 mt-2">Apakah Anda benar-benar ingin menghapus data ini? Proses ini tidak bisa dibatalkan.</div>
							</div>
							<div class="px-5 pb-8 text-center">
								<button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Batal</button>
								<a href="<?php echo site_url('admin/kategori/delete_data/'.$user['id_kategori']);?>"" class="button w-24 bg-theme-6 text-white">Hapus</a>
							</div>
						</div>
					</div>
					<!-- END: Delete Confirmation Modal -->
				</td>
			</tr>
			<?php $no++; } ?>
		</tbody>
	</table>
</div>
