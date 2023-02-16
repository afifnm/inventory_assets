<?php 
$this->db->select('*')->from('kategori');
$this->db->order_by('kategori','ASC');
$kategori_produk = $this->db->get()->result_array();
?>
<!-- BEGIN: Side Menu -->
<nav class="side-nav">
	<a href="" class="intro-x flex items-center pl-5 pt-4">
		<img alt="Midone Tailwind HTML Admin Template" class="w-6"
			src="<?php echo base_url('assets');?>/vendor/midone/dist/images/logo.svg">
		<span class="hidden xl:block text-white text-lg ml-3"> Inventory<span class="font-medium"> Asset</span> </span>
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
			<a href="<?php echo site_url('admin/pengguna');?>" class="side-menu <?php echo activate_menu('pengguna');  ?>">
				<div class="side-menu__icon"> <i data-feather="user"></i> </div>
				<div class="side-menu__title"> Pengguna </div>
			</a>
		</li>
		<li>
			<a href="javascript:;" class="side-menu <?php echo activate_menu('produk');  ?>">
				<div class="side-menu__icon"> <i data-feather="box"></i> </div>
				<div class="side-menu__title"> Daftar Asset <i data-feather="chevron-down" class="side-menu__sub-icon"></i>
				</div>
			</a>
			<ul class="<?php if($this->uri->segment('2')=='produk'){ echo "side-menu__sub-open"; } ?>">
				<?php foreach ($kategori_produk as $key) { ?>
				<li>
					<a href="<?php echo site_url('admin/produk/kategori/'.$key['id_kategori']);?>"
						class="side-menu <?php if($this->uri->segment('4')==$key['id_kategori']){ echo "side-menu--active"; } ?>">
						<div class="side-menu__icon"> <i data-feather="activity"></i> </div>
						<div class="side-menu__title"> <?php echo $key['kategori']; ?> </div>
					</a>
				</li>
				<?php } ?>
			</ul>
		</li>
    <li>
			<a href="<?php echo site_url('admin/kategori');?>" class="side-menu <?php echo activate_menu('kategori');  ?>">
				<div class="side-menu__icon"> <i data-feather="credit-card"></i> </div>
				<div class="side-menu__title"> Jenis Asset </div>
			</a>
		</li>
	</ul>
</nav>
<!-- END: Side Menu -->