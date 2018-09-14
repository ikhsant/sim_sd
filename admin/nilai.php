<?php 
$title = 'Data Guru'; 
include '../include/header.php';
?>

<?php  
$id_guru = $_SESSION['id_user'];
$siswa = mysqli_query($conn,"
                SELECT siswa.*, mata_pelajaran.nama_mata_pelajaran,mata_pelajaran.id_mata_pelajaran, kelas.nama_kelas, jadwal.jam, guru.nama_guru, nilai.nilai
				FROM siswa
				JOIN kelas
				ON siswa.kelas = kelas.id_kelas
				JOIN jadwal
				ON jadwal.kelas = kelas.id_kelas
				JOIN mata_pelajaran
				ON jadwal.mata_pelajaran = mata_pelajaran.id_mata_pelajaran
				JOIN guru
				ON guru.mata_pelajaran = mata_pelajaran.id_mata_pelajaran
				LEFT JOIN nilai
				ON nilai.siswa = siswa.id_siswa
				WHERE guru.id_guru = '$id_guru'
    ");
?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<b>Nilai Siswa</b>
	</div>
	<div class="table-responsive">
		<table class="table table-borderd">
			<tr>
				<th>Siswa</th>
				<th>Kelas</th>
				<th>Nilai</th>
				<th>#</th>
			</tr>
			<?php  
			foreach ($siswa as $siswa) {?>
			<tr>
				<td><?php echo $siswa['nama_siswa'] ?></td>		
				<td><?php echo $siswa['nama_kelas'] ?></td>		
				<td>
					<?php 
					if($siswa['nilai'] == 0 | $siswa['nilai'] == NULL){
						echo '<span class="label label-danger">Kosong</span>';
					}else{
						echo $siswa['nilai'] ;
					}
					?>
				</td>
				<td>
					<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal<?php echo $siswa['id_siswa'] ?>"><i class="fa fa-edit"></i> Ubah</button>
				</td>		
			</tr>

			<!-- Modal -->
            <div id="myModal<?php echo $siswa['id_siswa'] ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Beri Nilai Untuk: <b><?php echo $siswa['nama_siswa'] ?></b></h4>
                  </div>
                  	<form method="post">

                  <div class="modal-body">
                  	<div class="form-group">
                  		<label>Nilai</label>
                  		<input type="number" name="nilai" class="form-control" required>
                  		<input type="hidden" name="id_siswa" value="<?php echo $siswa['id_siswa'] ?>">
                  		<input type="hidden" name="id_mata_pelajaran" value="<?php echo $siswa['id_mata_pelajaran'] ?>">
                  	</div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="submit"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                  </div>
                  </form>

                </div>

              </div>
            </div>

			<?php } ?>
		</table>
	</div>
</div>


<?php  
// jika tombol di tekan
if (isset($_POST['submit'])) {
	$nilai = $_POST['nilai'];
	$id_siswa = $_POST['id_siswa'];
	$id_mata_pelajaran = $_POST['id_mata_pelajaran'];
	// cek jika nilai sudah ada
	$cek_nilai = mysqli_query($conn,"
                SELECT *
                FROM nilai
				WHERE siswa = '$id_siswa' AND mata_pelajaran = '$id_mata_pelajaran'
    ");
	if (mysqli_num_rows($cek_nilai) == 0 ) {
		mysqli_query($conn,"INSERT INTO nilai (siswa,mata_pelajaran,nilai) VALUES ('$id_siswa','$id_mata_pelajaran','$nilai')");
		echo '<meta http-equiv="refresh" content="0"; URL="nilai.php" />';
	}else{
		mysqli_query($conn,"UPDATE nilai SET mata_pelajaran='$id_mata_pelajaran',nilai='$nilai' WHERE siswa='$id_siswa' ");
		echo '<meta http-equiv="refresh" content="0"; URL="nilai.php" />';
	}
}
?>


<?php  
include '../include/footer.php';
?>
