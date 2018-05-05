<?php include 'conn.php'; ?>

<?php 

  if(isset($_GET['f'])){
        $filename = $_GET['f'].".csv";
        $count = 0;

        if(($handle = fopen("csv/".$filename, 'r')) !== false)
        {
            // get the first row, which contains the column-titles (if necessary)
            $header = fgetcsv($handle);
            $all_string = "";

            echo "Please wait... Loading data... <br>";

            //Truncate existing data inside table
            $conn->query("TRUNCATE TABLE `loan`");

            // loop through the file line-by-line
            while(!feof($handle) && $count < 10000)
            {
                $data = fgetcsv($handle);
                for($i=0; $i<sizeof($data); $i++)
                {
                    if($i != 0)
                        $all_string .= ',';
                    $data_str = $conn -> real_escape_string($data[$i]);
                    $all_string .= '"'.$data_str.'"';
                }

                $sql = 'INSERT INTO `loan`(`id`, `member_id`, `loan_amnt`, `funded_amnt`, `funded_amnt_inv`, `term`, `int_rate`, `installment`, `grade`, `sub_grade`, `emp_title`, `emp_length`, `home_ownership`, `annual_inc`, `verification_status`, `issue_d`, `loan_status`, `pymnt_plan`, `url`, `desc`, `purpose`, `title`, `zip_code`, `addr_state`, `dti`, `delinq_2yrs`, `earliest_cr_line`, `inq_last_6mths`, `mths_since_last_delinq`, `mths_since_last_record`, `open_acc`, `pub_rec`, `revol_bal`, `revol_util`, `total_acc`, `initial_list_status`, `out_prncp`, `out_prncp_inv`, `total_pymnt`, `total_pymnt_inv`, `total_rec_prncp`, `total_rec_int`, `total_rec_late_fee`, `recoveries`, `collection_recovery_fee`, `last_pymnt_d`, `last_pymnt_amnt`, `next_pymnt_d`, `last_credit_pull_d`, `collections_12_mths_ex_med`, `mths_since_last_major_derog`, `policy_code`, `application_type`, `annual_inc_joint`, `dti_joint`, `verification_status_joint`, `acc_now_delinq`, `tot_coll_amt`, `tot_cur_bal`, `open_acc_6m`, `open_il_6m`, `open_il_12m`, `open_il_24m`, `mths_since_rcnt_il`, `total_bal_il`, `il_util`, `open_rv_12m`, `open_rv_24m`, `max_bal_bc`, `all_util`, `total_rev_hi_lim`, `inq_fi`, `total_cu_tl`, `inq_last_12m`) VALUES ('.$all_string.')';


                if ($conn->query($sql) === FALSE) {
                    echo "Error: " . $conn->error ."<br>";
                    $error = true;
                } else {
                    $status = "success";
                }

                unset($data);
                $count++;
                $all_string = "";
            }
            fclose($handle);
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
      <!-- search form -->
     
      <!-- /.search form -->
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
        <li class="active">Loading</li>
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

              <b> <?php if(@$error == false) { echo "Loading data completed..."; } ?> </b>
              <hr>
              <h3>
                  Processing data in <span id="countdown">5</span> seconds... Please wait...
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
                              // Chnage your redirection link here
                              window.location = "dataprocess.php?load=true";
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
