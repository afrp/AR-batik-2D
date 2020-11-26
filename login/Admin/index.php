<?php 
session_start();
if (empty($_SESSION['login'])){
    echo "<META HTTP-EQUIV='Refresh' Content='0; URL=../login.php'>";
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Batik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.3.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/style6.css" />
    
    <script src="js/modernizr-custom.js"></script>   
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
                    <li class="current"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="batik.php"><i class="glyphicon glyphicon-calendar"></i>Data Batik</a></li>
                    <li><a href="admin.php"><i class="glyphicon glyphicon-stats"></i> Admin</a></li>
                    
                </ul>
             </div>
          </div>
          <div class="col-md-10">
            <div class="row">
            
        <div class="col-md-12 panel-warning">
        <button align="center" class="btn btn-lg btn-block btn-default" id="addLink" onclick="javascript:$('#addForm').slideToggle();">Tambah Data</button>
        <div class="panel-body none formData" id="addForm">
                <h2 id="actionLabel">Tambah Gambar</h2>
                <form class="form" id="userForm">
                <div class="form-group">
                        <label>Caption</label>
                        <input type="text" class="form-control" name="capt" id="capt"/>
                    </div>
                    
                    <div class="form-group" id="masuk">
                        <label>Image Batik</label><br/>                        
                            <img id="uploadPreview" name="prev" style="width: 150px; height: 150px;" /><br>
                            <br/>
                            <input type="file" id="gmb_batik"  name="gmb_batik"  onchange="PreviewImage();" />
                        
                    </div>
                    <a href="javascript:void(0);" class="btn btn-warning" onclick="$('#addForm').slideUp();">Cancel</a>
                    <a href="javascript:void(0);" class="btn btn-success" onclick="gmbAction()">Add Gambar</a>
                </form>
            </div>

        <div class="content-box-header panel-heading">
            <div class="panel-title ">Gambar-Gambar Backsong</div>
        </div>
    <div class="content-box-large box-with-header">
        <div class="content">
            <div class="grid" id="grid">
            <?php
                        include 'DB.php';
                        $db = new DB();
                        $datas = $db->getRows('tb_gam',array('order_by'=>'id DESC'));
                        if(!empty($datas)): $count = 0; foreach($datas as $datak): $count++;
                         ?>
                <div class="grid__item" data-size="1280x961">
                    
                    
                    <a href="img/<?php echo $datak['gambar']; ?>" class="img-wrap"><img src="img/<?php echo $datak['gambar']; ?>" alt="" />
                        <div class="description description--grid">
                        <?php echo $datak['name']; ?> 
                        </div>
                    </a>
                    <a href="javascript:void(0);"  onclick="return confirm('Are you sure to delete data?')?hapus_gam('delGam','<?php echo $datak['id']; ?>'):false;">Hapus</a>
                </div>
                <?php endforeach; else: ?>
                    <tr><td colspan="5">Tidak Ada Gambar yang ditampilkan</td></tr>
                    <?php endif; ?>
                <!--<div class="grid__item" data-size="1280x1131">
                    <a href="img/original/5.jpg" class="img-wrap"><img src="img/thumbs/5.jpg" alt="img05" />
                        <div class="description description--grid">Ephemeral</div>
                    </a>
                </div>-->
                
            </div>
            <!-- /grid -->
            <div class="preview" id="preview">
                <button class="action action--close"><i class="fa fa-times"></i><span class="text-hidden">Close</span></button>
                <div class="description description--preview"></div>
            </div>
            <!-- /preview -->
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

    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="js/data.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/main.js"></script>
    <script>
        (function() {
            var support = { transitions: Modernizr.csstransitions },
                // transition end event name
                transEndEventNames = { 'WebkitTransition': 'webkitTransitionEnd', 'MozTransition': 'transitionend', 'OTransition': 'oTransitionEnd', 'msTransition': 'MSTransitionEnd', 'transition': 'transitionend' },
                transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
                onEndTransition = function( el, callback ) {
                    var onEndCallbackFn = function( ev ) {
                        if( support.transitions ) {
                            if( ev.target != this ) return;
                            this.removeEventListener( transEndEventName, onEndCallbackFn );
                        }
                        if( callback && typeof callback === 'function' ) { callback.call(this); }
                    };
                    if( support.transitions ) {
                        el.addEventListener( transEndEventName, onEndCallbackFn );
                    }
                    else {
                        onEndCallbackFn();
                    }
                };

            new GridFx(document.querySelector('.grid'), {
                imgPosition : {
                    x : 1,
                    y : -0.75
                },
                pagemargin : 50,
                onOpenItem : function(instance, item) {
                    var win = {width: window.innerWidth, height: window.innerHeight};
                    instance.items.forEach(function(el) {
                        if(item != el) {
                            var delay = Math.floor(Math.random() * 150);
                                el.style.WebkitTransition = 'opacity .6s ' + delay + 'ms cubic-bezier(.5,1,.2,1), -webkit-transform .6s ' + delay + 'ms cubic-bezier(.5,1,.2,1)';
                                el.style.transition = 'opacity .6s ' + delay + 'ms cubic-bezier(.5,1,.2,1), transform .6s ' + delay + 'ms cubic-bezier(.5,1,.2,1)';
                            
                                el.style.WebkitTransform = 'translate3d(-' + win.width + 'px,0,0)';
                                el.style.transform = 'translate3d(-' + win.width + 'px,0,0)';
                                el.style.opacity = 0;
                        }
                    });
                },
                onCloseItem : function(instance, item) {
                    instance.items.forEach(function(el) {
                        if(item != el) {
                            var delay = Math.floor(Math.random() * 150);
                            el.style.WebkitTransition = 'opacity .3s ' + delay + 'ms cubic-bezier(.5,1,.2,1), -webkit-transform .3s ' + delay + 'ms cubic-bezier(.5,1,.2,1)';
                            el.style.transition = 'opacity .3s ' + delay + 'ms cubic-bezier(.5,1,.2,1), transform .3s ' + delay + 'ms cubic-bezier(.5,1,.2,1)';


                            el.style.WebkitTransform = 'translate3d(0,0,0)';
                            el.style.transform = 'translate3d(0,0,0)';
                            el.style.opacity = 1;

                            onEndTransition(el, function() {
                                el.style.transition = 'none';
                                el.style.WebkitTransform = 'none';
                            });
                        }
                    });
                }
            });
        })();
    </script>
  </body>
</html>