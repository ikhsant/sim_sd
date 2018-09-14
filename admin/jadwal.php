<?php 
$title = 'Data Jadwal'; 
include '../include/header.php';
?>

<?php
$xcrud->table('jadwal');
$xcrud->relation('kelas','kelas','id_kelas','nama_kelas');
$xcrud->relation('mata_pelajaran','mata_pelajaran','id_mata_pelajaran','nama_mata_pelajaran');
echo $xcrud->render();
?>

<?php  
include '../include/footer.php';
?>