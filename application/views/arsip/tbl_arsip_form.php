<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA ARSIP</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $this->session->userdata('id_users'); ?>" />
			
				<table class='table table-bordered'>
	    
					<tr>
						<td width='200'>Judul <?php echo form_error('judul') ?></td>
						<td> <input type="text" class="form-control" name="judul" id="judul" placeholder="judul" value="<?php echo $judul; ?>" /></td>
					</tr>
					<?php
                    for ($i=1;$i<=5;$i++) {
                        ?>
					<tr>
						<td width='200'>File Ke - <?php echo $i; ?><?php echo form_error('file') ?></td>
						<td>
							<input type="file" name="files[]">
						</td>
					</tr>

					<?php
                    } ?>
					<tr>
						<td width='200'>Tanggal <?php echo form_error('tanggal') ?></td>
						<td><input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" /></td>
					</tr>
					<tr>
                    <td width='200'>
                    Kategori Arsip 
                    </td>
                    <td>
                    <?php echo cmb_dinamis('kategori_id', 'tbl_kategori_arsip', 'nama_kategori', 'id', $kategori_id, 'DESC') ?>
                    </td>
                    </tr>

					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id" value="<?php echo $id; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('arsip') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>