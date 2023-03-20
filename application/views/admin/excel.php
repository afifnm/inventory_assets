<!DOCTYPE html>
<html>
<head>
	<title>Data Asets</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	</style>
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=".date('YmdHis').".xls");
	?>
	<table border="1">
		<tr>
			<th>No</th>
			<th>Nama Aset</th>
			<th>Nomor Inventaris</th>
			<th>Merk</th>
            <th>Jenis Aset</th>
            <th>Tanggal Masuk</th>
            <th>Tahun Perolehan</th>
            <th>Harga</th>
            <th>Sumber Dana</th>
            <th>Stok</th>
            <th>Ruang</th>
            <th>Status</th>
            <th>Kondisi</th>
		</tr>
        <?php $no=1; foreach ($asets as $aset) { ?>
		<tr>
			<td><?= $no; ?></td>
			<td><?= $aset['nama'] ?></td>
            <td><?= $aset['nomor_inventaris'] ?></td>
            <td><?= $aset['merk'] ?></td>
            <td><?= $aset['jenis'] ?></td>
            <td><?= mediumdate_indo($aset['tanggal_masuk']); ?></td>
            <td><?= $aset['tahun_perolehan'] ?></td>
            <td><?php echo 'Rp. '.number_format($aset['harga'],0,',','.') ?></td>
            <td><?= $aset['sumber_dana'] ?></td>
            <td><?= $aset['stok'] ?></td>
            <td><?= $aset['ruang'] ?></td>
            <td><?= $aset['status'] ?></td>
            <td><?= $aset['kondisi'] ?></td>
		</tr>
        <?php $no++; } ?>
	</table>
</body>
</html>