<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto"> My Profile</h2>
</div>
<div class="grid gap-5 mt-3 md:grid-cols-5">
	<div class="col-span-3">
		<form action="<?php echo site_url('auth/updateProfile');?>" method="POST">
			<div class="intro-y box p-5">
				<div class="mt-3">
					<label>Username</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4"
							value="<?= $this->session->userdata('username') ?>" name="username" readonly>
					</div>
				</div>
				<div class="mt-3">
					<label>Nama Lengkap</label>
					<input type="hidden" name="id" value="<?= $this->session->userdata('id') ?>">
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4"
							value="<?= $this->session->userdata('nama') ?>" name="nama" required>
					</div>
				</div>
				<div class="mt-3">
					<label>Alamat</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4"
							value="<?= $this->session->userdata('alamat') ?>" name="alamat" required>
					</div>
				</div>
				<div class="mt-3">
					<label>No. HP</label>
					<div class="relative mt-2">
						<input type="text" class="input pr-4 w-full border col-span-4"
							value="<?= $this->session->userdata('no_hp') ?>" name="no_hp" required>
					</div>
				</div>
				<div class="mt-2 text-right border-t border-gray-200">
					<button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
				</div>
			</div>

		</form>
	</div>
</div>
