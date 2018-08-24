<?php 
$title = 'Data Siswa'; 
include '../include/header.php';
?>

<?php
$xcrud->table('siswa');
echo $xcrud->render();
?>

<?php  
include '../include/footer.php';
?>