
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_ARSIP</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Judul</td>
				<td><?php echo $judul; ?></td>
			</tr>
	
			<tr>
				<td>File</td>
				<td><?php echo $file; ?></td>
			</tr>
	
			<tr>
				<td>User Id</td>
				<td><?php echo $user_id; ?></td>
			</tr>
	
			<tr>
				<td>Tanggal</td>
				<td><?php echo $tanggal; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('arsip') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>