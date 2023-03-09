<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto"> Data Pengguna</h2>
	<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		<a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview"
			class="button inline-block bg-theme-1 text-white">Tambah Pengguna </a>
	</div>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
	<table class="table table-report table-report--bordered display datatable w-full" style="font-size: 12px;">
		<thead>
			<tr>
				<th class="border-b-2 text-center whitespace-no-wrap">NO</th>
				<th class="border-b-2 whitespace-no-wrap">USERNAME </th>
				<th class="border-b-2 whitespace-no-wrap">NAMA </th>
				<th class="border-b-2 whitespace-no-wrap">LEVEL </th>
                <th class="border-b-2 whitespace-no-wrap">NO. HP </th>
				<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1; foreach ($data2 as $user) {?>
			<tr>
				<td class="text-center border-b"><?= $no; ?></td>
				<td class="text-left border-b"><?= $user['username']; ?></td>
				<td class="text-left border-b"><?= $user['nama']; ?></td>
				<td class="text-left border-b"><?= $user['level']; ?></td>
                <td class="text-left border-b"><?= $user['no_hp']; ?></td>
				<td class="border-b w-5">
					<div class="flex sm:justify-center items-center">
						<a href="javascript:;" onclick="edit(
								'<?php echo $user['username'] ?>',
								'<?php echo $user['nama'] ?>',
								'<?php echo $user['level'] ?>',
                                '<?php echo $user['alamat'] ?>',
                                '<?php echo $user['no_hp'] ?>'
								)" class="flex items-center pr-1" data-toggle="modal" data-target="#edit-data">
							<i data-feather="search" class="w-4 h-4 mr-1"></i>
							Detail
						</a>
						<a href="javascript:;" onclick="update(
								'<?php echo $user['username'] ?>',
								'<?php echo $user['nama'] ?>',
								'<?php echo $user['level'] ?>',
                                '<?php echo $user['alamat'] ?>',
                                '<?php echo $user['no_hp'] ?>',
								<?= $user['id'] ?>
								)"
								data-toggle="modal" data-target="#update-data"
							class="flex items-center text-theme-1 pr-1">
							<i data-feather="check-square" class="w-4 h-4 mr-1"></i>
							Edit </a>
						<a href="javascript:;"
							onclick="hapus('<?= $user['id'] ?>')"
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
			<h2 class="font-medium text-base mr-auto">TAMBAH PENGGUNA </h2>
		</div>
		<form action="<?php echo site_url('admin/pengguna/simpan');?>" method="POST">
			<div class="intro-y box p-5">
				<div class="mt-1">
					<label> Nama Pengguna</label>
					<div class="sm:grid grid-cols-2 gap-2">
						<div class="relative mt-2">
							<input type="text" class="input pl-4 w-full border col-span-4" placeholder="nama lengkap.."
								name="nama" required>
						</div>
						<div class="relative mt-2">
							<select name="level" class="input pl-4 w-full border col-span-4">
								<option value="Admin">Admin</option>
								<option value="Staff">Staff</option>
							</select>
						</div>
					</div>
				</div>
				<div class="mt-3">
					<label>Username</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" placeholder="Username"
							name="username" required>
					</div>
				</div>
				<div class="mt-3">
					<label>Password</label>
					<div class="relative mt-2">
						<input type="password" class="input pr-4 w-full border col-span-4" placeholder="Password"
							name="password" required>
					</div>
				</div>
				<div class="mt-3">
					<label>Alamat</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" placeholder="Alamat"
							name="alamat" required>
					</div>
				</div>
				<div class="mt-3">
					<label>No. HP</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" placeholder="No. whatsapp"
							name="no_hp" required>
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
			<h2 class="font-medium text-base ml-3" id="h2_nama">Profil  </h2>
		</div>
		<div class="intro-y box p-5">
			<table class="ml-3 mb-3">
				<tr>
					<td>Username </td>
					<td id="username">: </td>
				</tr>
				<tr>
					<td>Nama Lengkap </td>
					<td id="nama">:</td>
				</tr>
				<tr>
					<td>Level</td>
					<td id="level">: </td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td id="alamat">: </td>
				</tr>
				<tr>
					<td>No. HP</td>
					<td id="no_hp">: </td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div class="modal" id="update-data">
	<div class="modal__content modal__content--lg">
		<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
			<h2 class="font-medium text-base ml-3">Perbarui Data Pengguna  </h2>
		</div>
		<form action="<?php echo site_url('admin/pengguna/update');?>" method="POST">
			<div class="intro-y box p-5">
				<div class="mt-3">
					<label>Username</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" id="v_username"
							name="username" readonly>
					</div>
				</div>
				<div class="mt-3">
					<label>Nama</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" id="v_nama"
							name="nama" required>
					</div>
				</div>				
				<div class="mt-3">
					<label>Alamat</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" id="v_alamat"
							name="alamat" required>
					</div>
				</div>
				<div class="mt-3">
					<label>No. HP</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4" id="v_telp"
							name="no_hp" required>
					</div>
				</div>
			</div>
			<div class="px-5 py-3 text-right border-t border-gray-200">
				<a class="button bg-theme-1 text-white mr-3" id="link_reset"
				onClick="return confirm('Apakah anda yakin mereset password pada siswa?')">Reset Password</a>
				<button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
			</div>
		</form>
	</div>
</div>
<!-- END: EDIT Confirmation Modal -->
<script>
	function edit(username, nama, level, alamat, no_hp) {
		document.getElementById('username').innerHTML = ': '+username;
		document.getElementById('nama').innerHTML = ': ' + nama;
        document.getElementById('h2_nama').innerHTML = 'Profil ' + nama;
		document.getElementById('level').innerHTML = ': ' + level;
		document.getElementById('alamat').innerHTML = ': ' + alamat;
		document.getElementById('no_hp').innerHTML = ': ' + no_hp;
	};
	function update(username, nama, level, alamat, no_hp, id) {
		document.getElementById('v_username').value = username;
		document.getElementById('v_nama').value = nama;
		document.getElementById('v_alamat').value = alamat;
		document.getElementById('v_telp').value = no_hp;
		var link = document.getElementById('link_reset');
		link.href = "<?php echo site_url('admin/pengguna/reset_password/');?>" + id;
	}
	function hapus(id) {
		var link = document.getElementById('link_hapus');
		link.href = "<?php echo site_url('admin/pengguna/delete_data/');?>" + id;
	};
</script>
