<?php foreach($pinjam as $u) { 
$cek= $this->db->where('kode_pinjam', $u->kode_pinjam)->where('status',0)->count_all_results('detail_pinjam');   
?>
<div id="myalert" style="margin-top: 10px;">
	<?php echo $this->session->flashdata('alert', true)?>
</div>
<!-- BEGIN: Datatable -->
<div class="grid grid-cols-7 md:grid-cols-7 sm:grid-cols-7 gap-2 mt-5">
	<div class="md:col-span-7 sm:col-span-7 intro-y box p-4">
		<table>
			<tr>
				<td>Nama Peminjam</td>
				<td> : </td>
				<td><?= $u->peminjam; ?></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td> : </td>
				<td><?= $u->keterangan; ?></td>
			</tr>
			<tr>
				<td>Tanggal Peminjaman</td>
				<td> : </td>
				<td><?= mediumdate_indo($u->tanggal_pinjam); ?></td>
			</tr>
			<tr>
				<td>Operator</td>
				<td> : </td>
				<td><?= $this->Aset_model->get_nama($u->username); ?></td>
			</tr>
		</table>
	</div>
    <?php if($cek>0){  ?>
	<div class="md:col-span-4 sm:col-span-7 intro-y datatable-wrapper box p-5">
		<table class="table" style="font-size: 12px;">
			<thead>
				<tr>
					<th class="border-b-2 whitespace-no-wrap">NAMA ASET </th>
					<th class="border-b-2 whitespace-no-wrap">NOMOR INVENTARIS </th>
					<th class="border-b-2 whitespace-no-wrap">STATUS </th>
					<th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
				</tr>
			</thead>
			<tbody>
				<?php  $no = 1; foreach ($this->Aset_model->getDipinjamAset($u->kode_pinjam) as $user) {?>
				<tr>
					<td class="text-left border-b"><?= $user['nama']; ?></td>
					<td class="text-left border-b"><?= $user['nomor_inventaris']; ?></td>
					<td class="text-left border-b">
						<?php if($user['status']==0){
						echo "belum dikembalikan";
					} else {
						echo "sudah dikembalikan"; 
					} ?>
					</td>
					<td class="border-b w-5">
                    <?php if($user['status']==0){ ?>
						<div class="flex sm:justify-center items-center">
							<a href="<?php echo site_url('admin/pinjam/add2/'.$user['nomor_inventaris'].'/'.$u->kode_pinjam);?>"
								class="button bg-theme-1 text-white">
								<i data-feather="plus" class="w-6 h-4"></i>
							</a>
						</div>
					</td>
                    <?php } ?>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
	<div class="col-span-3 md:col-span-3 sm:col-span-7 intro-y box p-5">
        <form action="<?php echo site_url('admin/pinjam/kembalikan');?>" method="POST">
            <table class="table" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th class="border-b-2 whitespace-no-wrap">NAMA ASET </th>
                        <th class="border-b-2 whitespace-no-wrap">NOMOR INVENTARIS </th>
                        <th class="border-b-2 whitespace-no-wrap">KONDISI </th>
                        <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  $no = 0; foreach ($this->Aset_model->getTempAsetKembali() as $uu) {?>
                    <tr>
                        <td class="text-left border-b"><?= $uu['nama']; ?></td>
                        <td class="text-left border-b"><?= $uu['nomor_inventaris']; ?></td>
                        <td class="text-left border-b">
                            <input type="hidden" name="nomor_inventaris[<?= $no;?>]" value="<?= $uu['nomor_inventaris']; ?>">
                            <select data-hide-search="true" class="input input--sm border mr-2" name="kondisi[<?= $no;?>]">
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                            </select> 
                        </td>
                        <td class="border-b w-5">
                            <div class="flex sm:justify-center items-center">
                                <a href="<?php echo site_url('admin/pinjam/delete2/'.$uu['nomor_inventaris'].'/'.$kode_pinjam) ?>"
                                    class="button bg-theme-6 text-white">
                                    <i data-feather="trash" class="w-6 h-4"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                    <input type="hidden" name="jumlah" value="<?= $no;?>">
                    <input type="hidden" name="kode_pinjam" value="<?= $kode_pinjam;?>">
                    <input type="hidden" name="peminjam" value="<?= $u->peminjam;?>">
                </tbody>
            </table>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <button type="submit" class="button w-30 bg-theme-1 text-white">Kemnbalikan</button>
            </div>
		</form>
	</div>
    <?php } else { ?>
    <div class="md:col-span-7 sm:col-span-7 intro-y datatable-wrapper box p-5">
		<table class="table" style="font-size: 12px;">
			<thead>
				<tr>
					<th class="border-b-2 whitespace-no-wrap">NAMA ASET </th>
					<th class="border-b-2 whitespace-no-wrap">NOMOR INVENTARIS </th>
					<th class="border-b-2 whitespace-no-wrap">STATUS </th>
					<th class="border-b-2 text-center whitespace-no-wrap">KONDISI PENGEMBALIAN</th>
					<th class="border-b-2 text-center whitespace-no-wrap">TANGGAL PENGEMBALIAN</th>
				</tr>
			</thead>
			<tbody>
				<?php  $no = 1; foreach ($this->Aset_model->getDipinjamAset($u->kode_pinjam) as $user) {?>
				<tr>
					<td class="text-left border-b"><?= $user['nama']; ?></td>
					<td class="text-left border-b"><?= $user['nomor_inventaris']; ?></td>
					<td class="text-left border-b">
						<?php if($user['status']==0){
						echo "belum dikembalikan";
					} else {
						echo "sudah dikembalikan"; 
					} ?>
					</td>
                    <td class="text-left border-b text-center"><?= $user['kondisi']; ?></td>
                    <td class="text-left border-b text-center"><?= mediumdate_indo($user['tanggal_kembali']); ?></td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
    <?php } ?>
</div>

<?php } ?>
