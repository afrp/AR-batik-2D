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
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
        <link rel="stylesheet" type="text/css" href="login/admin/css/styles.css" />
        <link rel="stylesheet" type="text/css" href="css/galleri.css" />
        <link rel="stylesheet" type="text/css" href="css/ns-default.css" />
        <link rel="stylesheet" type="text/css" href="css/ns-style-other.css" />
        <link rel="stylesheet" type="text/css" href="css/ns-style-growl.css" />
        <script src="login/admin/js/data.js"></script>
		<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>        
		</head>
<body>
<nav id="navigationMap">
<ul>
<li><a class="ascensorLink ascensorLink1"></a></li>
<li><a class="ascensorLink ascensorLink2"></a></li>
<li><a class="ascensorLink ascensorLink3"></a></li>
<li><a class="ascensorLink ascensorLink4"></a></li>

<li><a class="ascensorLink ascensorLink5"></a></li><!--
<li><a class="ascensorLink ascensorLink6"></a></li>
<li><a class="ascensorLink ascensorLink7"></a></li>-->
</ul>
</nav>
<main>
<div id="ascensorBuilding">
		<section>
		
		<ul class="cb-slideshow">
            <li><span>Image 01</span><div><h3>Sty.lish</h3></div></li>
            <li><span>Image 02</span><div><h3>Se.ja.rah Bu.da.ya</h3></div></li>
            <li><span>Image 03</span><div><h3>Ke.te.li.ti.an</h3></div></li>
            <li><span>Image 04</span><div><h3>Ke.be.ra.ga.man</h3></div></li>
            <li><span>Image 05</span><div><h3>Ke.ang.gun.an</h3></div></li>
            <li><span>Image 06</span><div><h3>Wi.sa.ta be.la.jar</h3></div></li>
        </ul>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
                <a href="#">
                    <strong>BETA Version </strong>QR Batik Augmented
                </a>
                <span class="right">
                    <a href="#" target="_blank">Kontak</a>
                    <a href="" target="_blank">Info</a>
                    
                </span>
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
            <header>
                <h1>QR Code<span> Batik Nusantara</span></h1>
                <h2>Mengenalkan Batik dengan gaya berbeda</h2>
            </header>

        </div>
        <div id="login-button" class="ascensorLink ascensorLink2">
					<h1 class="kata-masuk">INFO<br>BATIK</h1>  
				</div>
			<div id="login-but" class="ascensorLink ascensorLink3">
					<h1 class="kata-masuk">SNAP<br>KAMERA</h1>

			</div>
		</section>

		<section>
		<div class="codrops-top">
                <a href="#">
                    <strong><< </strong>Back on Menu | 
                </a>
                <a href="#">
                    <strong>BETA Version </strong>QR Batik Augmented
                </a>
                <span class="right">
                    <a href="#" target="_blank">Kontak</a>
                    <a href="" target="_blank">Info</a>
                    
                </span>
                <div class="clr"></div>
            </div>
            <div class="col-lg-12">
                <h1 class="page-header">Gallery Batik</h1>
                
            </div>
            
		<div class="contain" id="users"> 

        <div class="row" >
            <div class="row" style="margin: 20px 0 10px;">
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="input-group">
                        
                        <input type="text" class="form-control" placeholder="Masukan Nama Batik Atau Asal Kotanya"/>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" >Go!</button>
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-4 -->
            </div>

            <ul class="list" id="list-data">
            <?php
                        include 'login/admin/DB.php';
                        $db = new DB();
                        $datas = $db->getRows('data_batik',array('order_by'=>'id DESC'));
                        if(!empty($datas)): $count = 0; foreach($datas as $datak): $count++;
                         ?>
            <li>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <div class="thumbnail" style="cursor: pointer;">
                    <img class="img-thumbnail img-responsive"  style="height: 150px;width: 200px;" src="login/admin/files/<?php echo $datak['gmb_batik']; ?>" alt="" >
                    <h4 class="no"><?php echo $datak['nama_batik'];?></h4>
                    <h2 class="rig-text" >Klik untuk Detail</h2>
                    <h3 class="kota"><?php echo $datak['asal_batik'];?></h3>
                    <center><a class="btn btn-default" href="hasil.php?id=<?php echo $datak['id_batik']; ?>" target="_blank">Lihat</a></center>
                    <!--<button align="center" class="btn btn-lg btn-block btn-default" id="addLink" onclick="tampilDepan('<?php echo $datak['id']; ?>')">Lihat</button>-->
                </div>
            </div>
            </li>
            <?php endforeach; else: ?>
                    <tr><td colspan="5">Data Batik Masih Kosong</td></tr>
                    <?php endif; ?>
            </ul>
        </div>
         <div class="row">
                <div class="col-lg-4 col-lg-offset-4" style="margin: -50px 0 0px;">
                    <ul class="pagination"></ul>
                </div><!-- /.col-lg-4 -->
            </div>
            
    </div>
		
		</section>
		<section>
		<div class="codrops-top">
                <a href="#">
                    <strong>BETA Version </strong>QR Batik Augmented
                </a>
                <span class="right">
                    <a href="#" target="_blank">Kontak</a>
                    <a href="" target="_blank">Info</a>
                    
                </span>
                <div class="clr"></div>
        </div>
        <div class="col-lg-12">
                <h1 class="page-header">Scan QR Code Batik By Camera Device</h1>
            </div>
		<center>
          <div class="kamera" style="width:550px; height:350px;border-style: solid;border-width: medium;border-color: white;">
          <video autoplay style="width:465px; height:350px;border-style: solid;border-width: medium;border-color: white;"></video>
          <select id="cameraSelect"></select>
          </div>
          </center>
        <h3 id="ade" style="display:none;"></h3>
        <div id="ajk" style="display:none;" > sembarang</div>
        <input type="text" class="form-control" name="id_bat" id="id_bat" style="display:none;" />
        <input type="text" class="form-control" name="nama_bat" id="nama_bat" style="display:none;" />
        <input type="text" class="form-control" name="gmb_bat" id="gmb_bat" style="display:none;" />
        <input type="text" class="form-control" name="asal_bat" id="asal_bat" style="display:none;" />
        <div id="asal_bat" style="display:none;" ></div>
        </section>

		<section>
		<div class="codrops-top">
                <a href="#">
                    <strong>BETA Version </strong>QR Batik Augmented
                </a>
                <span class="right">
                    <a href="#" target="_blank">Kontak</a>
                    <a href="" target="_blank">Info</a>
                    
                </span>
                <div class="clr"></div>
            </div>
        <div class="contain" id="konten_data" style="margin-top: 20px;">
            
        </div>
		</section>

		<section>
		<article class="container_12">
		<h1>CSS naming</h1>	
		</article>
		</section>
<!--
		<section>
		<article class="container_12">
		<h1>Smartphone</h1>
		<p>for smartphone, i recommend the use of the next meta:</p>
		</article>
		</section>

		<section>
		<article class="container_12">
		<h1>Credits</h1>
		<p>This plugin is free and need no license</p>
		</article>
		</section>-->
</div>
</main>
<script src="js/jquery.1.7.2.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.1.7.2.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/jquery.ascensor.js"></script>
<script src="js/script.js"></script>
<script src="dist/list.js"></script>
<script src="js/list.pagination.js"></script>
<script src="js/classie.js"></script>
<script src="js/notificationFx.js"></script>
<script src="build/qcode-decoder.min.js"></script>
<script>

var monkeyList = new List('users', {
  valueNames: [ 'no', 'kota' ],
  page: 8,
  plugins: [ ListPagination({}) ] 
});

var qr = new QCodeDecoder();
    var xx = document.getElementById("ajk").innerHTML;
    var kode = document.getElementById("id_bat").value;
    var nama = document.getElementById("nama_bat").value;
    var asal = document.getElementById("asal_bat").value;
    var gmb = document.getElementById("gmb_bat").value;
    var elems = {
      selector : document.querySelector('select'),
      video: document.querySelector('video'),
      ade: document.getElementById('ade')
    };

    if (!(qr.isCanvasSupported() && qr.hasGetUserMedia())) {
      alert('Your browser doesn\'t match the required specs.');
      throw new Error('Canvas and getUserMedia are required');
    }

    function resultHandler (err, ade) {
        if (err)return console.log(err.message);
        //alert("ade="+ade);
        $.ajax({
                type: "POST",
                dataType: 'JSON',
                url: "control.php",
                data: "ade="+ade,
                success:function(data){
                    $('#nama_bat').val(data.nama_batik);
                    $('#asal_bat').val(data.asal_batik);
                    $('#gmb_bat').val(data.gmb_batik);
                    //alert(data.nama_batik);
                },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                } 
            });
        
        var notification = new NotificationFx({
             message : '<div><img src="login/admin/files/'+gmb+'" style="width:60px; height:40px;"/> </br><p> ini adalah batik '+nama+', Berasal dari '+asal+', <a href="hasil.php?id='+ade+'" target="_blank">Klik Untuk lebih lanjut</a>. </p></div',
              layout : 'growl',
              effect : 'jelly',
              type : 'notice' // notice, warning, error or success
            });
      //alert(ade);

      notification.show();
    }

    qr.getVideoSources(function (err, sources) {
      if (err || (sources && !sources.length)) {
        elems.selector.remove();
        qr.decodeFromCamera(elems.video, resultHandler);

        return;
      }

      sources.forEach(function (source) {
        var option = document.createElement('option');
        option.value = source.id;
        option.text = source.facing || 'default';

        elems.selector.add(option);
      });

      elems.selector.onchange = function () {
        qr.setSourceId(elems.selector.selectedOptions[0].value);
      };

      elems.result.innerHTML = 'Your browser is currently exposing ' +
                                sources.length + ' cameras - use the ' +
                                'dropdown above to select which you want ' +
                                'to use';

      elems.selector.onchange();

      qr.decodeFromCamera(elems.video, resultHandler);
    });

</script>
 
</body>


</html>