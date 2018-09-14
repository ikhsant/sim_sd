<?php  
include '../include/header.php';
?>

<?php 
// notif pesan
if (!empty($_SESSION['pesan'])) { ?>
	<div class="alert alert-success">
		<i class="fa fa-check"></i> <?php echo $_SESSION['pesan']; ?>
	</div>
	<br>
	<?php 
	$_SESSION['pesan'] = '';
} 

// notif pesan ewrror
if (!empty($_SESSION['error'])) { ?>
	<div class="alert alert-danger">
		<i class="fa fa-check"></i> <?php echo $_SESSION['error']; ?>
	</div>
	<br>
	<?php 
	$_SESSION['error'] = '';
} 
?>

<?php 
if($_SESSION['akses_level'] == "admin"){

$siswa = mysqli_query($conn,"SELECT * FROM siswa");
$guru = mysqli_query($conn,"SELECT * FROM user WHERE akses_level = 'guru' ");
$mata_pelajaran = mysqli_query($conn,"SELECT * FROM mata_pelajaran");



?>

<script type="text/javascript" src="../assets/js/Chart.min.js"></script>

<div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-graduation-cap fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span style="font-size: 50px"><?php echo mysqli_num_rows($siswa) ?></span>
                    <div>Siswa</div>
                </div>
            </div>
        </div>
        <a href="siswa.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>

<div class="col-lg-3 col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span style="font-size: 50px"><?php echo mysqli_num_rows($guru) ?></span>
                    <div>Guru</div>
                </div>
            </div>
        </div>
        <a href="guru.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>

<div class="col-lg-3 col-md-6">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-book fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span style="font-size: 50px"><?php echo mysqli_num_rows($mata_pelajaran) ?></span>
                    <div>Mata Pelajaran</div>
                </div>
            </div>
        </div>
        <a href="mata_pelajaran.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>


<div class="col-md-6">

    <div class="panel panel-default">
        <div class="panel-heading">
            Chart STOK
        </div>
        <div class="panel-body">
            <canvas id="myChart" height="200px"></canvas>
        </div>
    </div>
</div>

<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Bertahan", "Indikasi Bertahan", "Indikasi Dropout","Dropout"],
            datasets: [{
                label: '# Stok',
                data: [<?php echo mysqli_num_rows($mahasiswa_bertahan) ?>, <?php echo mysqli_num_rows($mahasiswa_indikasi_bertahan) ?>, <?php echo mysqli_num_rows($mahasiswa_indikasi_dropout) ?>, <?php echo mysqli_num_rows($mahasiswa_dropout) ?>],
                backgroundColor: [
                'rgba(0, 255, 0)',
                'rgba(255, 255, 0)',
                'rgba(255, 128, 0)',
                'rgba(255, 0, 0)'
                ],
                borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255,54,80,1)',
                'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },

    });
</script>

<?php  } ?>

<?php 
if($_SESSION['akses_level'] == "guru"){
    $no = 1;
    $id_user = $_SESSION['id_user'];
    $jadwal = mysqli_query($conn,"
                SELECT * 
                FROM jadwal 
                JOIN mata_pelajaran
                ON jadwal.mata_pelajaran=mata_pelajaran.id_mata_pelajaran
                JOIN kelas
                ON jadwal.kelas=kelas.id_kelas
                JOIN guru
                ON guru.id_guru=mata_pelajaran.id_mata_pelajaran
                WHERE guru.id_guru = '$id_user'
    ");
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        Jadwal Kelas
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>NO</th>
                <th>Matpel</th>
                <th>Kelas</th>
                <th>Jadwal</th>
                <th>Jumlah Siswa</th>
                <th>#</th>
            </tr>
            <?php foreach($jadwal as $jadwal){ ?>
            <?php  
            $kelas = $jadwal['id_kelas'];
            $siswa = mysqli_query($conn,"SELECT * from siswa WHERE kelas = '$kelas' ");
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $jadwal['nama_mata_pelajaran'] ?></td>
                <td><?php echo $jadwal['nama_kelas'] ?></td>
                <td><?php echo $jadwal['jam'] ?></td>
                <td>
                   <?php echo mysqli_num_rows($siswa); ?>
                </td>
                <td><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal<?php echo $jadwal['id_jadwal'] ?>"><i class="fa fa-user"></i> Siswa</button></td>
            </tr>

            
            <!-- Modal -->
            <div id="myModal<?php echo $jadwal['id_jadwal'] ?>" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Absen Hadir Kelas <?php echo $jadwal['nama_kelas'] ?></h4>
                  </div>
                    <form method="post">

                  <div class="modal-body">
<ol>
                            <?php  
                            foreach ($siswa as $siswa) {
                            ?>
                                <li><?php echo $siswa['nama_siswa'] ?></li><input type="checkbox" name="hadir[]" value="1" required />
                            <?php
                            }
                            ?>
                        </ol>
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
  if(isset($_POST['submit'])) 
  {
    $hadir = $_POST['hadir'];
    $N = count($hadir);

    echo("You selected $N hadir(s): ");
    for($i=0; $i < $N; $i++)
    {
      echo($hadir[$i] . " ");
    }
  } 

?>


<?php } ?>


<?php  
include '../include/footer.php';
?>