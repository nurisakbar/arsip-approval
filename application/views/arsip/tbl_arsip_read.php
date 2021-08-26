
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA ARSIP : <?php echo $judul; ?></h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Judul</td>
				<td><?php echo $judul; ?></td>
			</tr>
	
			<tr>
				<td>File</td>
				<td><?php
                foreach (unserialize($file) as $file) {
                    echo "<a target='new' href='".base_url()."/uploads/$file'>$file</a>";
                    echo "<br>";
                }
                ?></td>
			</tr>
	
			<tr>
				<td>Pemilik File</td>
				<td><?php echo $full_name; ?></td>
			</tr>
			<tr>
				<td>Kategori</td>
				<td><?php echo $nama_kategori; ?></td>
			</tr>
	
			<tr>
				<td>Tanggal</td>
				<td><?php echo $tanggal; ?></td>
			</tr>

			<tr>
				<td>Status Review</td>
				<td><?php echo $status==null?'Menunggu Ditandai Siap Untuk Di Review':$status; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td>
				<a href="<?php echo site_url('arsip') ?>" class="btn btn-default">Kembali</a> 

				<?php
                if ($this->session->userdata('id_user_level')==5) {
                    if ($status==null) {
                        echo "<a class='btn btn-danger btn-sm' href='".base_url()."index.php/arsip/approval/".$id."/ok'>Tandai Siap Untuk Direview</a>";
                    }
                } else {
                    echo "<a class='btn btn-danger' href='".base_url()."index.php/arsip/approval/".$id."/y'>Terima</a>";
                    echo " <a class='btn btn-danger' href='".base_url()."index.php/arsip/approval/".$id."/n'>Tolak</a>";
                }
                ?>
				</td>
			</tr>
	
		</table>
		</div>
	</section>
</div>