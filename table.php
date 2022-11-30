<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php
			if(!empty($_SESSION['perpus'])){
        ?>
			<table class="table table-dark table-striped table-bordered border-secondary table-hover table-responsive mt-3 ">
			  <thead>
					<tr style="text-align:center";>
						<th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Stok</th>
						<th>Edit dan Hapus</th>	
                    </tr>
			 </thead>
			 <tbody>
				<?php
					$no = 1;
			        foreach($_SESSION['perpus'] as $key => $real){
				?>
				<tr>
                            					
				<td><?= $real ['judul']; ?></td>
                <td><?= $real['penulis'];?></td>
                <td><?= $real['penerbit'];?></td>
				<td><?= $real['stok'];?></td>
                <td>
                     <a href="?edit&output=<?= $key ?>"><i class="fa-solid fa-pen" style="font-size:20px;"></i></a>
                     <a href="?delete&output=<?= $key ?>"
                     onclick="return confirm(`Hapus data nilai peserta didik <?= $real['judul'] ?> ?`)"><i class="fa-solid fa-trash" style="font-size:20px;"></i> </a>
                </td>                				
                 </tr>
							<?php
						      }
						    }
					        ?>
			</tbody>
		</table>
	 
    </body>
</html>
		