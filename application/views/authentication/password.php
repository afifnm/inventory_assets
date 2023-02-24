<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('alert', true)?>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto"> Reset Password</h2>
</div>
<div class="grid gap-5 mt-3 md:grid-cols-5">
	<div class="col-span-3">
		<form action="<?php echo base_url('auth/updatePassword') ?>" method="POST">
			<div class="intro-y box p-5">
				<div class="mt-3">
					<label>Password Lama</label>
					<div class="relative mt-2">
						<input type="password" class="input pr-4 w-full border col-span-4" name="passLama" required>
					</div>
				</div>
        <div class="mt-3">
					<label>Password Baru</label>
					<div class="relative mt-2">
						<input type="password" class="input pr-4 w-full border col-span-4" name="passBaru" required>
					</div>
				</div>
        <div class="mt-3">
					<label>Konfirmasi Password Baru</label>
					<div class="relative mt-2">
						<input type="password" class="input pr-4 w-full border col-span-4" name="passKonf" required>
					</div>
				</div>

				<div class="mt-2 text-right border-t border-gray-200">
					<button type="submit" class="button w-20 bg-theme-1 text-white">Simpan</button>
				</div>
			</div>

		</form>
	</div>
</div>
