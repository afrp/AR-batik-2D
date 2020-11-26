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
	                 <h1><a href="index.html">Admin Batik</a></h1>
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
                    <li class="current"><a href="batik.html"><i class="glyphicon glyphicon-calendar"></i>Data Batik</a></li>
                    <li><a href="admin.php"><i class="glyphicon glyphicon-stats"></i> Admin</a></li>            
                </ul>
             </div>
		  </div>

		  <div class="col-md-10">
	       <div class="panel panel-default users-content">
            
           <button align="center" class="btn btn-lg btn-block btn-default" id="addLink" onclick="tombol()">Tambah Data</button>
  			
        <div class="panel-body none formData" id="addForm">
                <h2 id="actionLabel">Tambah Batik</h2>
                <form class="form" id="userForm">
                    <div class="form-group">
                        <label>Kode Batik</label>
                        <input type="text" class="form-control" name="id_batik" id="id_batik" readonly="readonly" />
                    </div>
                    <div class="form-group">
                        <label>Nama Batik</label>
                        <input type="text" class="form-control" name="nama_batik" id="nama_batik"/>
                    </div>
                    <div class="form-group">
                        <label>Asal Batik</label>
                        <input type="text" class="form-control" name="asal_batik" id="asal_batik"/>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Batik</label>
                        <textarea class="form-control" name="desc_batik" id="desc_batik"></textarea> 
                    </div>
                    <div class="form-group">
                        <label>Pola Batik</label>
                        <textarea class="form-control" name="pola_batik" id="pola_batik"></textarea> 
                    </div>
                    <div class="form-group" id="masuk">
                        <label>Image Batik</label><br/>                        
                            <img id="uploadPreview" name="prev" style="width: 150px; height: 150px;" /><br>
                            <br/>
                            <input type="file" id="gmb_batik"  name="gmb_batik"  onchange="PreviewImage();" />
                        
                    </div>
                    <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
                    <a href="javascript:void(0);" class="btn btn-success" onclick="userAction('add')">Add Batik</a>
                </form>
            </div>
            <div class="panel-body none formData" id="editForm">
                <h2 id="actionLabel">Edit User</h2>
                <form class="form" id="userForm">
                    <div class="form-group">
                        <label>Kode Batik</label>
                        <input type="text" class="form-control" name="id_edit" id="id_edit" readonly="readonly"/>
                    </div>
                    <div class="form-group">
                        <label>Nama Batik</label>
                        <input type="text" class="form-control" name="nama_edit" id="nama_edit"/>
                    </div>
                    <div class="form-group">
                        <label>Asal Batik</label>
                        <input type="text" class="form-control" name="asal_edit" id="asal_edit"/>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Batik</label>
                        <textarea class="form-control" name="desc_edit" id="desc_edit"></textarea> 
                    </div>
                    <div class="form-group">
                        <label>Pola Batik</label>
                        <textarea class="form-control" name="pola_edit" id="pola_edit"></textarea> 
                    </div>
                    <div class="form-group" id="masuk">
                        <label>Image Batik</label><br/>                        
                            <img id="uploadreview" name="prev" style="width: 150px; height: 150px;" /><br>
                            <br/>
                            <input type="file" id="gmb_edit"  name="gmb_edit"  onchange="reviewImage();" />
                        
                    </div>
                     <input type="hidden" class="form-control" name="id_ed" id="id_ed"/>
                    <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#editForm').slideUp();">Cancel</a>
                    <a href="javascript:void(0);" class="btn btn-success" onclick="userAction('edit')">Update Batik</a>
                </form> 
            </div>
            <div class="content-box-large">
            <div class="panel-heading">
                    <div class="panel-title" align="left"><h3>Data Batik</h3> 
                    </div>
                </div>
  				<div class="panel-body">
  					<div class="table-responsive">
  						<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
			              <thead>
			                <tr>
                        <th>No</th>
			                  <th>Kode</th>
			                  <th>Nama Batik</th>
			                  <th>Asal Daerah</th>
			                  <th>Deskripsi</th>
			                  <th>Pola Batik</th>
			                  <th>Gambar Batik</th>
                        <th>QR Code</th>
                        <th></th>
                        <th></th>
			                </tr>
			              </thead>
			              <tbody id="userData">
			              <?php
                        include 'DB.php';
                        $db = new DB();
                        $datas = $db->getRows('data_batik',array('order_by'=>'id DESC'));
                        if(!empty($datas)): $count = 0; foreach($datas as $datak): $count++;
                         ?>
			                <tr>
                        <td><?php echo $count;?></td>  			         
                        <td><?php echo $datak['id_batik'];?></td>
			                  <td><?php echo $datak['nama_batik'];?></td>
			                  <td><?php echo $datak['asal_batik'];?></td>
			                  
                              <td><a data-toggle="modal" data-id="<?php echo $datak['desc_batik'];?>" title="Add this item" class="open-AddBookDialog" href="#addBookDialog">Lihat</a></td>
                              <td><a data-toggle="modal" data-id="<?php echo $datak['pola_batik'];?>" title="Add this item" class="open-AddBookDialog" href="#addBookDialog">Lihat</a></td>
			                  <td><div id="me"><a href="files/<?php echo $datak['gmb_batik']; ?>">Lihat Foto</a></div></td>
                        <td><div id="men"><a href="files/qrcode/<?php echo $datak['qr_batik']; ?>">Lihat QR</a></div></td>
			                  <td><a href="javascript:void(0);" class="btn btn-info" onclick="editUser('<?php echo $datak['id']; ?>')" ><i class="glyphicon glyphicon-pencil"></i> Edit</a></td>
			                  <td><a href="javascript:void(0);"  class="btn btn-danger" onclick="return confirm('Are you sure to delete data?')?hapus('delete','<?php echo $datak['id']; ?>'):false;"><i class="glyphicon glyphicon-remove hapus"></i> Delete</a></td>
			                </tr>
			                <?php endforeach; else: ?>
                    <tr><td colspan="5">Data Batik Masih Kosong</td></tr>
                    <?php endif; ?>		  
			              </tbody>
			            </table>
  					</div>
  				</div>
  			</div>
        </div>
            <div class="modal fade" id="addBookDialog" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                         <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id="myModalLabel">Isi data</h3>
                         </div>
                         <div class="modal-body">
                             <p id="panjang"></p>

                         </div>
                    </div>
               </div>
            </div>

            <div class="modal fade" id="addBookGam" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                         <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title" id="myModalLabel">Isi data</h3>
                         </div>
                         <div class="modal-body">
                             <img id="pan" src="files/">

                         </div>
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

    <link href="vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">
    
    <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>

    <script src="vendors/datatables/dataTables.bootstrap.js"></script>

    <script src="js/custom.js"></script>
    <script src="js/tables.js"></script>

  </body>
</html>