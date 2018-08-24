<?php 
$title = 'Data Mata Pelajaran'; 
include '../include/header.php';
?>

<?php
$xcrud->table('mata_pelajaran');
echo $xcrud->render();
?>

<?php  
include '../include/footer.php';
?>