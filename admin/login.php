<?php
session_start();
require '../include/database.php';
// query setting
$setting = mysqli_fetch_assoc(mysqli_query($conn,'SELECT * FROM setting LIMIT 1'));
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login <?php echo $setting['nama_website']; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../assets/css/united-bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.css">
</head>
<body style="background: lightgrey">
	<form method="post"  style="max-width: 350px; margin-top: 150px;margin: auto; margin-top: 50px; background: white; padding: 10px; border-radius: 10px">
    <p class="text-center"><img class="w3-padding" src="../uploads/logo/<?php echo $setting['logo']; ?>" style="width: 100px"></p>
    <h3 class="text-center"><?php echo $setting['nama_website']; ?></h3>
    <?php
    if(isset($_POST['submit'])){
      $user = mysqli_real_escape_string($conn,$_POST["user"]);
      $pass = mysqli_real_escape_string($conn,sha1($_POST['pass']));
      $result = mysqli_query($conn,"SELECT * FROM user WHERE username = '$user' AND password = '$pass' ");
      $row = mysqli_fetch_assoc($result);
      // guru
      $pass_guru = mysqli_real_escape_string($conn,$_POST['pass']);
      $result_guru = mysqli_query($conn,"SELECT * FROM guru WHERE nip = '$user' AND password = '$pass_guru' ");
      $row_guru = mysqli_fetch_assoc($result_guru);


      // cek di db admin
      if(mysqli_num_rows($result) > 0){
        $_SESSION['username'] = $user;
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['foto'] = $row['foto'];
        $_SESSION['nama'] = $row['nama_user'];
        $_SESSION['akses_level'] = $row['akses_level'];
        $_SESSION['pesan'] = 'Selamat Datang '.$row['nama'].' !';
        // Redirect user to index.php
        header("Location: index.php");
      }elseif(mysqli_num_rows($result_guru) > 0){
        $_SESSION['foto'] = $row_guru['foto'];
        $_SESSION['id_user'] = $row_guru['id_guru'];
        $_SESSION['nama'] = $row_guru['nama_guru'];
        $_SESSION['akses_level'] = 'guru';
        $_SESSION['pesan'] = 'Selamat Datang '.$row_guru['nama_guru'].' !';
        // Redirect user to index.php
        header("Location: index.php");
      }else{
        echo '
        <div class="alert alert-danger"><i class="fa fa-warning"></i> Username atau Password Salah</div>
        ';
        mysqli_close($conn);
      }
    }
    ?>
    <div class="form-group">
     <label>Username</label>
     <input class="form-control" type="text" name="user" placeholder="Masukan Username" required>
   </div>
   <div class="form-group">
     <label>Password</label>
     <input class="form-control" type="password" name="pass" placeholder="Masukan Password" required>
   </div>
     <button class="btn btn-primary" type="submit" name="submit" ><i class="fa fa-sign-in"></i> Login</button>
 </form>
</body>
</html>