<?php

  include 'conn.php';

?>

<?php

  // Check if file is an actual file
  if(isset($_POST["upload"])) {

      $target_dir = "csv/";
      // $target_file = $target_dir . basename($_FILES["csvfile"]["name"]);
      $temp = explode(".", $_FILES["csvfile"]["name"]);
      $newfilenamenoext = round(microtime(true));
      $newfilename =  $newfilenamenoext . '.' . end($temp);
      $target_file = $target_dir . basename($newfilename);
      $uploadOk = 1;

      $file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Check if file already exists
      if (file_exists($target_file)) {
          $msg = "Sorry, file already exists.";
          $uploadOk = 0;
      }

      // Allow certain file formats
      if($file_type != "csv") {
          $msg = "Sorry, only CSV files are allowed. ";
          $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          $msg = "Your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["csvfile"]["tmp_name"], $target_file)) {
              $msg = "The file ". basename($newfilename). " has been uploaded.<hr>";
              $status = "success";
          } else {
              $msg = "Sorry, there was an error uploading your file.";
          }
      }

  }


?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Analytic</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Experian</b> Analytic</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/Experian_logo.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>ADMINISTRATOR</p>
          
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            
          </a>
        </li>

        <li>
          <a href="dataprocess.php?load=true">
            <i class="fa fa-table"></i> <span>Customer Data</span>
            
          </a>
        </li>
       
        
      
       
        
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Import CSV</a></li>
        <li class="active">Uploading</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">




      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Home</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

              <!-- VIEW ALERT -->
              <?php if(isset($msg)){ ?> 
                <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h3><?php echo $msg; ?></h3>
                </div> 
              <?php } ?>

              <h3>
                Loading data in <span id="countdown">5</span> seconds... Please wait...
              </h3>
              
              <!-- JavaScript Section | Countdown and Redirect -->
              <script type="text/javascript">
                  var status = <?php echo @json_encode($status); ?>
                  
                  if(status == "success") {
                      // Total seconds to wait
                      var seconds = 5;

                      function countdown() {

                          seconds = seconds - 1;
                          if (seconds < 0) {
                              var filename = <?php echo json_encode($newfilenamenoext); ?>
                              // Chnage your redirection link here
                              window.location.href = "csvparser.php?f="+filename;
                          } else {
                              // Update remaining seconds
                              document.getElementById("countdown").innerHTML = seconds;
                              // Count down using javascript
                              window.setTimeout("countdown()", 500);
                          }
                      }
                      
                      // Run countdown function
                      countdown();
                  }
                  
              </script>


        </div>
        <!-- /.box-body -->
        
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2018 <a href="https://adminlte.io">Experian Analytic</a>.</strong> All rights
    reserved.
  </footer>

 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- JQuery BlockUI -->
<script src="plugins/jquery.blockUI.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
