<?php $this->db->select('*')->from('jenis');
$this->db->order_by('jenis', 'ASC');
$jenis_produk=$this->db->get()->result_array();
?>
<div class="mobile-menu md:hidden">
	<div class="mobile-menu-bar">
		<a href="<?php echo site_url('admin/home');?>" class="flex mr-auto">
			<img class="w-6" src="<?php echo base_url('assets');?>/midone/dist/images/logo.svg"></a>
		<a href="javascript:;" id="mobile-menu-toggler">
			<i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
		</a>
	</div>
	<ul class="border-t border-theme-24 py-5 hidden">
		<li>
			<a href="<?php echo site_url('admin/home');?>" class="menu">
				<div class="menu__icon"><i data-feather="home"></i></div>
				<div class="menu__title">Dashboard </div>
			</a>
		</li>
		<li>
			<a href="javascript:;" class="menu <?php echo activate_menu('aset');  ?>">
				<div class="menu__icon"> <i data-feather="layers"></i> </div>
				<div class="menu__title"> Daftar Asset <i data-feather="chevron-down" class="menu__sub-icon"></i>
				</div>
			</a>
			<ul class="<?php if($this->uri->segment('2')=='aset'){ echo "menu__sub-open"; } ?>">
				<?php foreach ($jenis_produk as $key) { ?>
				<li>
					<a href="<?php echo site_url('admin/aset/jenis/'.$key['id_jenis']);?>"
						class="menu <?php if($this->uri->segment('4')==$key['id_jenis']){ echo "menu--active"; } ?>">
						<div class="menu__icon"> <i data-feather="corner-down-right"></i> </div>
						<div class="menu__title"> <?php echo $key['jenis']; ?> </div>
					</a>
				</li>
				<?php } ?>
			</ul>
		</li>
		<li>
			<a href="<?php echo site_url('admin/ruang');?>" class="menu <?php echo activate_menu('ruang');  ?>">
				<div class="menu__icon"> <i data-feather="columns"></i> </div>
				<div class="menu__title"> Ruang </div>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url('admin/jenis');?>" class="menu <?php echo activate_menu('jenis');  ?>">
				<div class="menu__icon"> <i data-feather="box"></i> </div>
				<div class="menu__title"> Jenis Asset </div>
			</a>
		</li>
		<li>
			<a href="javascript:;" class="menu <?php echo activate_menu('pengguna');  ?>">
				<div class="menu__icon"> <i data-feather="user"></i> </div>
				<div class="menu__title"> Account <i data-feather="chevron-down" class="menu__sub-icon"></i>
				</div>
			</a>
			<ul class="<?php if($this->uri->segment('2')=='pengguna'){ echo "menu__sub-open"; } ?>">
				<li>
					<a href="<?php echo site_url('admin/pengguna/profile');?>"
						class="menu <?php if($this->uri->segment('3')=='profile'){ echo "menu--active"; } ?>">
						<div class="menu__icon"> <i data-feather="meh"></i> </div>
						<div class="menu__title"> My Profile </div>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('admin/pengguna/reset');?>"
						class="menu <?php if($this->uri->segment('3')=='reset'){ echo "menu--active"; } ?>">
						<div class="menu__icon"> <i data-feather="lock"></i> </div>
						<div class="menu__title"> Reset Password </div>
					</a>
				</li>
				<li>
					<a href="<?php echo site_url('admin/pengguna');?>"
						class="menu <?php if($this->uri->segment('3')==NULL){ echo "menu--active"; } ?>">
						<div class="menu__icon"> <i data-feather="user-plus"></i> </div>
						<div class="menu__title"> Data Pengguna </div>
					</a>
				</li>	
			</ul>
		</li>
		<li>
			<a href="<?php echo site_url('auth/logout');?>" class="menu">
				<div class="menu__icon"> <i data-feather="log-out"></i> </div>
				<div class="menu__title"> Logout</div>
			</a>
		</li>
	</ul>
</div>
