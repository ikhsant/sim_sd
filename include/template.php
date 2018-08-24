<?php  
  $url = $_SERVER['REQUEST_URI'];
  $parts = parse_url($url);
  $page_name = basename($parts['path']);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIIRO</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../assets/css/w3.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.css">
</head>
<body>

<nav class="w3-sidebar w3-bar-block w3-card" style="width: 200px">
  <div class="w3-container w3-dark-grey">
    <h3>Dashboard</h3>
  </div>
  <a href="index.php" class="w3-bar-item w3-button <?php if($page_name == 'index.php'){echo 'w3-red';} ?>"><i class="fa fa-star"></i> Dashboard</a>
  <a href="intern.php" class="w3-bar-item w3-button <?php if($page_name == 'intern.php'){echo 'w3-red';} ?>"><i class="fa fa-user"></i> Intern</a>
  <a href="mou.php" class="w3-bar-item w3-button <?php if($page_name == 'mou.php'){echo 'w3-red';} ?>"><i class="fa fa-book"></i> Mou</a>
</nav>

<div class="w3-padding w3-red w3-card w3-large" style="margin-left: 200px">
  dashbaord
</div>

<div class="w3-container">
  
</div>

</body>
</html>