<?php 
$title = 'Data Siswa'; 
include '../include/header.php';
?>

<?php
$xcrud->table('siswa');
$xcrud->relation('kelas','kelas','id_kelas','nama_kelas');
echo $xcrud->render();
?>

<?php  
include '../include/footer.php';
?>