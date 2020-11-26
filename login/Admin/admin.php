<!DOCTYPE html>
<?php 
session_start();
if (empty($_SESSION['login'])){
  echo "<META HTTP-EQUIV='Refresh' Content='0; URL=../login.php'>";
}
$_SESSION['username'];
?>
<html>
  <head>
    <title>Admin Batik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="js/data.js"></script>
    <script type="text/javascript" src="js/jquery.lightbox-0.5.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
    <link href="css/styles.css" rel="stylesheet">
    
    
	    
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.php">Admin Batik</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
	                  
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="#">Profile</a></li>
	                          <li><a href="logout.php">Logout</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="batik.php"><i class="glyphicon glyphicon-calendar"></i>Data Batik</a></li>
                    <li class="current"><a href="admin.php"><i class="glyphicon glyphicon-stats"></i> Admin</a></li>
                </ul>
             </div>
		  </div>

      
            

		  <div class="col-md-10">
	       <div class="panel panel-default users-content">
  			
            <div class="panel-body none formData" id="editFormAdm">
                <h2 id="actionLabel">Edit User</h2>
                <form class="form" id="userForm">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="user_edit" id="user_edit" readonly="readonly"/>
                    </div>
                    <div class="form-group">
                        <label>Password lama</label>
                        <input type="password" class="form-control" name="pass_edit" id="pass_edit"/>
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control" name="pass_new" id="pass_new"/>
                    </div>
                    <input type="hidden" class="form-control" name="id_pass" id="id_pass"/>
                    <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editFormAdm').slideUp();">Cancel</a>
                    <a href="javascript:void(0);" class="btn btn-success" onclick="admUbah()">Ganti Password</a>
                </form> 
            </div>
            <div class="panel-heading">
                    <div class="panel-title" align="left"><h3>Administrator</h3> 
                    </div>
                </div>
  				<div class="panel-body">
  					<div class="table-responsive">
  						<table class="table">
			              <thead>
			                <tr>
                        <th>No</th>
			                  <th>UserName</th>
			                  <th>Password</th>
                        <th></th>
                        <th></th>
			                </tr>
			              </thead>
			              <tbody id="userData">
			              <?php
                        include 'DB.php';
                        $db = new DB();
                        $datas = $db->getRows('tb_admin',array('order_by'=>'id DESC'));
                        if(!empty($datas)): $count = 0; foreach($datas as $datak): $count++;
                         ?>
			                <tr>
                        <td><?php echo $count;?></td>  			         
                        <td><?php echo $datak['username'];?></td>
			                  <td><?php echo $datak['password'];?></td>
			                  
			                  <td><a href="javascript:void(0);" class="btn btn-info" onclick="editAdm('<?php echo $datak['id']; ?>')" ><i class="glyphicon glyphicon-pencil"></i> Edit</a></td>
			                  <!--<td><a href="javascript:void(0);"  class="btn btn-danger" onclick="return confirm('Are you sure to delete data?')?hapus('delete','<?php echo $datak['id']; ?>'):false;"><i class="glyphicon glyphicon-remove hapus"></i> Delete</a></td>
			                </tr>-->
			                <?php endforeach; else: ?>
                    <tr><td colspan="5">Data Batik Masih Kosong</td></tr>
                    <?php endif; ?>		  
			              </tbody>
			            </table>
  					</div>
  				</div>
  			</div>
            
		  </div>
		</div>
</div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2014 <a href='#'>Website</a>
            </div>
            
         </div>
      </footer>

  </body>
</html>