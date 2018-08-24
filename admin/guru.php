<?php 
$title = 'Data Guru'; 
include '../include/header.php';
?>

<?php
$xcrud->table('guru');
$xcrud->relation('mata_pelajaran','mata_pelajaran','id_mata_pelajaran','nama_mata_pelajaran');
echo $xcrud->render();
?>

<?php  
include '../include/footer.php';
?>