<?include 'db_connect.php';
$id=$_SESSION['login_id'];
$qry = $conn->query("SELECT total_point FROM users WHERE id=$id");
while($row= $qry->fetch_assoc()) $p=$row['total_point'];?>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
    <!-- Left navbar links -->
    <ul class="navbar-nav w-100">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="w-100">
        <a class="nav-link text-white"  href="./" role="button"> <large><b>Онлайн судалгааны систем</b></large></a>
      </li>
      <li class="w-100 text-right">
        <span class="nav-link text-white"><i class="fas fa-coins text-warning"></i> <?=$p?></span>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item"><a class="nav-link" data-widget="fullscreen" href="#" role="button"><i class="fas fa-expand-arrows-alt"></i></a></li>
    </ul>
  </nav>
  <!-- /.navbar -->
