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
$mahasiswa_indikasi_dropout = mysqli_query($conn,"SELECT * FROM quisioner WHERE status = 'Indikasi Dropout' ");
$mahasiswa_dropout = mysqli_query($conn,"SELECT * FROM quisioner WHERE status = 'Dropout' ");

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

<div class="col-lg-3 col-md-6">
    <div class="panel panel-warning">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span style="font-size: 50px"><?php echo mysqli_num_rows($mahasiswa_indikasi_dropout) ?></span>
                    <div>Indikasi Dropout</div>
                </div>
            </div>
        </div>
        <a href="quisioner.php">
            <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>

<div class="col-lg-3 col-md-6">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <span style="font-size: 50px"><?php echo mysqli_num_rows($mahasiswa_dropout) ?></span>
                    <div>Dropout</div>
                </div>
            </div>
        </div>
        <a href="quisioner.php">
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
include '../include/footer.php';
?>