<?php foreach ($kategori as $u) { ?>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		PERBARUI JENIS ASSET
	</h2>
</div>
<div class="intro-y col-span-12 lg:col-span-8">
	<!-- BEGIN: Vertical Form -->
	<div class="intro-y box">
		<div class="p-5">
			<div class="preview" style="">
				<form class="form-horizontal" action="<?php echo site_url('admin/kategori/updatedata');?>" method="POST">
					<div>
						<label>NAMA JENIS ASSET</label>
						<input type="hidden" name="id" class="input w-full border mt-2" value="<?php echo $u->id_kategori; ?>">
						<input type="text" name="kategori" class="input w-full border mt-2" value="<?php echo $u->kategori; ?>">
					</div>
					<button type="submit" class="button bg-theme-1 text-white mt-5">Simpan</button>
				</form>
			</div>
		</div>
	</div>
	<!-- END: Vertical Form -->
</div>
<?php } ?>