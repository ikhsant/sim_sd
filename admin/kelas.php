<?php 
$title = 'Data Kelas'; 
include '../include/header.php';
?>

<?php
$xcrud->table('kelas');
echo $xcrud->render();
?>

<?php  
include '../include/footer.php';
?>