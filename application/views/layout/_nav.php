<!-- BEGIN: Top Bar -->
<div class="top-bar">
	<!-- BEGIN: Breadcrumb -->
	<div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Application</a> <i
			data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Dashboard</a>
	</div>
	<!-- END: Breadcrumb -->
	<!-- BEGIN: Account Menu -->
	<div class="intro-x dropdown w-8 h-8 relative">
		<div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
			<?php $filename=FCPATH.'/assets/upload/images/profil/'.$this->session->userdata('foto');
                      if (file_exists($filename) || $this->session->userdata('foto')==''){ ?>
			<img class="user-image"
				src="<?php echo base_url('assets/upload/images/profil/'.$this->session->userdata('foto')); ?>" alt
				class="w-px-40 h-auto rounded-circle">
			<?php }  else {?>
			<img class="user-image" src="<?php echo base_url('assets/upload/images/no_image.jpg'); ?>" alt
				class="w-px-40 h-auto rounded-circle">
			<?php }?>
		</div>
		<div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
			<div class="dropdown-box__content box bg-theme-38 text-white">
				<div class="p-4 border-b border-theme-40">
					<div class="font-medium"><?php echo $this->session->userdata('nama'); ?></div>
					<div class="text-xs text-theme-41"><?php echo $this->session->userdata('level'); ?></div>
				</div>
				<div class="p-2">
					<a href="<?php echo site_url('auth/profile');?>"
						class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
						<i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
					<a href="<?php echo site_url('auth/password');?>"
						class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
						<i data-feather="lock" class="w-4 h-4 mr-2"></i> Ganti Password </a>
					<a href=""
						class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
						<i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
				</div>
				<div class="p-2 border-t border-theme-40">
					<a href="<?php echo site_url('auth/logout');?>"
						class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
						<i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
				</div>
			</div>
		</div>
	</div>
	<!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->
