<?php 
session_start();
if (isset($_SESSION['login'])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Admin Batik</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

     <link href="css/login.css" rel="stylesheet" type="text/css" />


  </head>
  <body class="login-page">
    <div class="login-box">
  
      <div class="login-logo">
        <a href="#">Selamat Datang Admin <b>BATIK</b></a>
      </div><!-- /.login-logo -->    
      <div class="login-box-body">
<div class="img-div">
<img src="img/login.png" />
</div>


<div class="load" style="display: none;"><img src="img/load.gif"><span class="txt">Please Wait</span></div>

<div class="alert alert-danger alert-dismissable" hidden="hidden">
<button type="button" class="close" data-hide="alert" aria-hidden="true">×</button>
<i class="icon fa fa-warning"></i> Username Or Password Incorrect</div>
        <form id="form" action="inc/proses_login.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" id="username" class="form-control" placeholder="Username"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
       
            <div class="col-xs-12">
              <input type="submit" id="login" class=" btn btn-primary btn-block" value="Login" onclick="">
            </div><!-- /.col -->
          </div>
        </form>

   
      </div><!-- /.login-box-body -->
       <div class="bawah">&nbsp;</div>
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="js/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
  <script type="text/javascript" src="js/jquery.backstretch.min.js"></script> 
  <script src="js/jqueryform.js"></script>
  <script src="js/validate.js"></script>
  <script src="js/login.js"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>