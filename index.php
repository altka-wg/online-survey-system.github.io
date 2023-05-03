<!DOCTYPE html>
<html lang="en">
<?php session_start();
	if(!isset($_SESSION['login_id'])) header('location:login.php');
	include 'header.php';
?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <?php include 'topbar.php';include 'sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	 <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
	    <div class="toast-body text-white">
	    </div>
	  </div>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?
            switch ($title) {
              case "Survey List": $header_title="Судалгааны жагсаалт"; break;
              case "New Survey": $header_title="Шинэ санал асуулга"; break;
              case "Edit Survey": $header_title="Судалгаа засах"; break;
              case "View Survey": $header_title="Судалгааг үзэх"; break;
              case "New User": $header_title="Шинэ хэрэглэгч нэмэх"; break;
              case "User List": $header_title="Хэрэглэгчийн жагсаалт"; break;
              case "Edit User": $header_title="Хэрэглэгчийг засах"; break;
              case "Home": $header_title="Нүүр"; break;
              case "Survey Report": $header_title="Санал асуулгын тайлан"; break;
              case "Survey Widget": $header_title="Санал асуулгын тайлан"; break;
              case "View Survey Report": $header_title="Судалгааны тайланг үзэх"; break;
              case "Answer Survey": $header_title="Судалгааны хариулт"; break;
              case "": $header_title=""; break;
            }
            ?>
            <h1 class="m-0"><?=$header_title?></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr class="border-primary">
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';include $page.'.php';?>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
    <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Баталгаажуулалт</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Үргэлжлүүлэх</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Хадгалах</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Цуцлах</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
        <img src="" alt="">
      </div>
    </div>
  </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <?if(date('Y')>2023) echo '- '.date('Y').'.'?> </strong>Бүх эрхийг <div class="float-right d-none d-sm-inline-block"><b>...</b> хуулиар хамгаалсан</div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<!-- Bootstrap -->
<?php include 'footer.php' ?>
</body>
</html>
