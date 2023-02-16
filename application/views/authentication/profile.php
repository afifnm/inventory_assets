<div id="myalert">
	<?php echo $this->session->flashdata('alert', true)?>
</div>

<div class="intro-y col-span-12 lg:col-span-8">
	<!-- BEGIN: Vertical Form -->
	<div class="intro-y box">
		<div class="p-5">
			<div class="preview" style="">
				<form class="form-horizontal" action="<?php echo base_url('auth/updateProfile') ?>" method="POST"
					enctype="multipart/form-data">
					<div>
						<label>Username</label>
						<input type="username" class="input w-full border mt-2" placeholder="username"
							value="<?php echo $this->session->userdata('username'); ?>">
					</div>
					<div>
						<label>Nama Lengkap</label>
						<input type="nama" class="input w-full border mt-2" placeholder="Nama Lengkap"
							value="<?php echo $this->session->userdata('nama'); ?>">
					</div>
          
          <label>Tempat, Tanggal Lahir</label>
					<div class="grid grid-cols-12 gap-2">
            
						<input type="text" class="input w-full border col-span-6" placeholder="Input inline 1">
						<input type="text" class="input w-full border col-span-6" placeholder="Input inline 2">
					</div>
					<button type="button" class="button bg-theme-1 text-white mt-5">Simpan</button>
				</form>
			</div>
		</div>
	</div>
	<!-- END: Vertical Form -->
</div>
