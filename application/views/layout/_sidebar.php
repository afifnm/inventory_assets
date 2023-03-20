<!-- BEGIN: Side Menu -->
<nav class="side-nav">
	<a href="" class="intro-x flex items-center pl-5 pt-4">
		<img class="w-12" src="<?php echo base_url('assets');?>/upload/logo.png">
		<span class="hidden xl:block text-white text-lg ml-3"> Inventaris<span class="font-medium"> Aset</span> </span>
	</a>
	<div class="side-nav__devider my-6"></div>
	<ul>
		<li>
			<a href="<?php echo site_url('admin/home');?>" class="side-menu <?php echo activate_menu('home');  ?>">
				<div class="side-menu__icon"> <i data-feather="home"></i> </div>
				<div class="side-menu__title"> Dashboard </div>
			</a>
		</li>
		<li>
			<a href="javascript:;" class="side-menu <?php echo activate_menu('aset');  ?>">
				<div class="side-menu__icon"> <i data-feather="layers"></i> </div>
				<div class="side-menu__title"> Daftar Asset <i data-feather="chevron-down"
						class="side-menu__sub-icon"></i>
				</div>
			</a>
			<ul class="<?php if($this->uri->segment('2')=='aset'){ echo "side-menu__sub-open"; } ?>">
				<?php foreach ($jenis_produk as $key) { ?>
				<li>
					<a href="<?php echo site_url('admin/aset/jenis/'.$key['id_jenis']);?>"
						class="side-menu <?php if($this->uri->segment('4')==$key['id_jenis']){ echo "side-menu--active"; } ?>">
						<div class="side-menu__icon"> <i data-feather="corner-down-right"></i> </div>
						<div class="side-menu__title"> <?php echo $key['jenis']; ?> </div>
					</a>
				</li>
				<?php } ?>
			</ul>
		</li>
		<li>
			<a href="<?php echo site_url('admin/pinjam');?>" class="side-menu <?php echo activate_menu('pinjam');  ?>">
				<div class="side-menu__icon"> <i data-feather="framer"></i> </div>
				<div class="side-menu__title"> Peminjaman </div>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url('admin/ambil');?>" class="side-menu <?php echo activate_menu('ambil');  ?>">
				<div class="side-menu__icon"> <i data-feather="rewind"></i> </div>
				<div class="side-menu__title"> Ambil Aset </div>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url('admin/ruang');?>" class="side-menu <?php echo activate_menu('ruang');  ?>">
				<div class="side-menu__icon"> <i data-feather="columns"></i> </div>
				<div class="side-menu__title"> Ruang </div>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url('admin/jenis');?>" class="side-menu <?php echo activate_menu('jenis');  ?>">
				<div class="side-menu__icon"> <i data-feather="box"></i> </div>
				<div class="side-menu__title"> Jenis Asset </div>
			</a>
		</li>
		<li>
			<a href="javascript:;" class="side-menu <?php echo activate_menu('pengguna');  ?>">
				<div class="side-menu__icon"> <i data-feather="user"></i> </div>
				<div class="side-menu__title"> Account <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
				</div>
			</a>
			<ul class="<?php if($this->uri->segment('2')=='pengguna'){ echo "side-menu__sub-open"; } ?>">
				<li>
					<a href="<?php echo site_url('admin/pengguna/profile');?>"
						class="side-menu <?php if($this->uri->segment('3')=='profile'){ echo "side-menu--active"; } ?>">
						<div class="side-menu__icon"> <i data-feather="meh"></i> </div>
						<div class="side-menu__title"> My Profile </div>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('admin/pengguna/reset');?>"
						class="side-menu <?php if($this->uri->segment('3')=='reset'){ echo "side-menu--active"; } ?>">
						<div class="side-menu__icon"> <i data-feather="lock"></i> </div>
						<div class="side-menu__title"> Reset Password </div>
					</a>
				</li>
				<?php if ($this->session->userdata('level') == "Admin") { ?>
				<li>
					<a href="<?php echo site_url('admin/pengguna');?>"
						class="side-menu <?php if($this->uri->segment('3')==NULL){ echo "side-menu--active"; } ?>">
						<div class="side-menu__icon"> <i data-feather="user-plus"></i> </div>
						<div class="side-menu__title"> Data Pengguna </div>
					</a>
				</li>	
				<?php } ?>
			</ul>
		</li>
		<li>
			<a href="<?php echo site_url('auth/logout');?>" class="side-menu">
				<div class="side-menu__icon"> <i data-feather="log-out"></i> </div>
				<div class="side-menu__title"> Logout</div>
			</a>
		</li>
	</ul>
</nav>
<!-- END: Side Menu -->
