<!doctype html>
<html class="no-js" lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>QR Batik</title>
		<meta name="description" content="Ascensor is a jquery plugin which aims to train and adapt content according to an elevator system">
		<meta name="viewport" content="user-scalable=0,width=device-width,initial-scale=1,maximum-scale=1">
		<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/grid.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="login/admin/css/styles.css" />
        <style type="text/css">body{background-color: #EB5D45;}</style>
        
		</head>
    <body>
    <?php 
    	$link = mysqli_connect("localhost", "root", "", "batik_id");

		$datas = mysqli_query($link, "SELECT * FROM data_batik WHERE id_batik='". $_GET['id'] ."'");
		$datak= mysqli_fetch_assoc($datas)
		?>
		<div class="codrops-top">
                <a href="#">
                    <strong>BETA Version </strong>QR Batik Augmented
                </a>
                <span class="right">
                    <a href="#" target="_blank">Kontak</a>
                    <a href="#" target="_blank">Info</a>
                    
                </span>
                <div class="clr"></div>
            </div>
        <div class="contain" style="margin-top: 20px;">
        	<div class="row" style="margin-left: -90px;">
                <div class="col-xs-6 col-sm-6 col-md-4">
                <img class="img-thumbnail img-responsive" src="login/admin/files/<?php echo $datak['gmb_batik'];?>" alt=""></div>
                <div class="col-xs-12 col-md-8">
                <div class="content-box-large">
                <p><?php echo $datak['desc_batik'];?></p>
                </div>
                </div>                
            </div>
            <div class="row" style="margin-left: -90px; margin-top: 10px;">
                <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-3">
                    <div class="content-box-large">
                        <h1 >asal <strong><?php echo $datak['asal_batik'];?></strong></h1>
                    </div>
                </div>
                <div class="col-xs-16 col-sm-6 col-md-2 col-md-offset-1">
                    <img class="img-thumbnail img-responsive" src="login/admin/files/qrcode/<?php echo $datak['qr_batik'];?>" alt="">
                </div>
            </div>
            <div class="row" style="margin-left: -90px; margin-top: 10px;">
                <div class="col-xs-12 col-sm-6 col-md-9 col-md-offset-4">
                    <div class="content-box-large">
                    <p><?php echo $datak['pola_batik'];?></p>
                    </div>
                </div>
        </div>
        </div>
		

</body>


</html>