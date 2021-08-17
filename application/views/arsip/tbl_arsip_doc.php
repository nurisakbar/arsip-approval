<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Tbl_arsip List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Judul</th>
		<th>File</th>
		<th>User Id</th>
		<th>Tanggal</th>
		
            </tr><?php
            foreach ($arsip_data as $arsip)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $arsip->judul ?></td>
		      <td><?php echo $arsip->file ?></td>
		      <td><?php echo $arsip->user_id ?></td>
		      <td><?php echo $arsip->tanggal ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>