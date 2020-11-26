<?php
include 'DB.php';
include '../inc/PasswordHash.php';
$db = new DB();
$qr = new barcodeQR();
$tblName = 'data_batik';
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'data'){
        $conditions['where'] = array('id'=>$_POST['id']);
        $conditions['return_type'] = 'single';
        $user = $db->getRows($tblName,$conditions);
        echo json_encode($user);
    }elseif($_POST['action_type'] == 'view'){
        
        $datas = $db->getRows($tblName,array('order_by'=>'id DESC'));
        if(!empty($datas)){
            $count = 0;
            foreach($datas as $datak): $count++;
                echo '<tr>';
                echo '<td>'.$count.'</td>';
                echo '<td>'.$datak['id_batik'].'</td>';
                echo '<td>'.$datak['nama_batik'].'</td>';
                echo '<td>'.$datak['asal_batik'].'</td>';
                echo '<td><a data-toggle="modal" data-id="'.$datak['desc_batik'].'" title="Add this item" class="open-AddBookDialog" href="#addBookDialog">Lihat</a></td>';
                echo '<td><a data-toggle="modal" data-id="'.$datak['pola_batik'].'" title="Add this item" class="open-AddBookDialog" href="#addBookDialog">Lihat</a></td>';
                echo '<td><p id="me"><a href="files/'.$datak['gmb_batik'].'">Lihat Foto</a></p></td>';
                echo '<td><p id="men"><a href="files/qrcode/'.$datak['qr_batik'].'">Lihat QR</a></p></td>';
                echo '<td><a href="javascript:void(0);" class="btn btn-info" onclick="editUser(\''.$datak['id'].'\')"><i class="glyphicon glyphicon-pencil"></i> Edit</a></td>';
                 echo '<td><a href="javascript:void(0);" class="btn btn-danger" onclick="return confirm(\'Are you sure to delete data?\')?hapus(\'delete\',\''.$datak['id'].'\'):false;"><i class="glyphicon glyphicon-remove hapus"></i>Hapus</a></td>';
                echo '</tr>';
            endforeach;
        }else{
            echo '<tr><td colspan="5">No user(s) found......</td></tr>';
        }
        echo "<script type=\"text/javascript\" src=\"js/data.js\"></script>";
    }elseif($_POST['action_type'] == 'tdepan'){
        $conditions['where'] = array('id'=>$_POST['id']);
        $conditions['return_type'] = 'single';
        $datas = $db->getRows($tblName,$conditions);
        
            while ($datak= mysqli_fetch_assoc($datas)){
                echo  '<div class="row" style="margin-left: -90px;">
                <div class="col-xs-6 col-sm-6 col-md-4">
                <img class="img-thumbnail img-responsive" src="images/test/'.$datak['gmb_batik'].'" alt=""></div>
                <div class="col-xs-12 col-md-8">
                <div class="content-box-large">
                <p>'.$datak['desc_batik'].'</p>
                </div>
                </div>                
            </div>
            <div class="row" style="margin-left: -90px; margin-top: 10px;">
                <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-3">
                    <div class="content-box-large">
                        <h1 >asal <strong>'.$datak['asal_batik'].'</strong></h1>
                    </div>
                </div>
                <div class="col-xs-16 col-sm-6 col-md-2 col-md-offset-1">
                    <img class="img-thumbnail img-responsive" src="login/admin/files/qrcode/'.$datak['qr_batik'].'" alt="">
                </div>
            </div>
            <div class="row" style="margin-left: -90px; margin-top: 10px;">
                <div class="col-xs-12 col-sm-6 col-md-9 col-md-offset-4">
                    <div class="content-box-large">
                    <p>'.$datak['pola_batik'].' </p>
                    </div>
                </div>
        </div>';
            }
        
    }elseif($_POST['action_type'] == 'add'){
        $qrkata = $_POST['id_batik'];
        $qrnama = $_POST['nama_batik'];
        $qrfull= $qrkata.'-'.$qrnama.'.png';
        $fold= "files/qrcode/";
        $poto=rand(1000,100000)."-".$_FILES['gmb_batik']['name'];
        $poto_lok=$_FILES['gmb_batik']['tmp_name'];
        $folder="files/";
        $poto_baru=strtolower($poto);
        $image_bt=str_replace('','-', $poto_baru);
        
        $userData = array(
            'id_batik' => $_POST['id_batik'],
            'nama_batik' => $_POST['nama_batik'],
            'asal_batik' => $_POST['asal_batik'],
            'desc_batik' => $_POST['desc_batik'],
            'pola_batik' => $_POST['pola_batik'],
            'gmb_batik' => $image_bt,
            'qr_batik'=>$qrfull
        );
       
        
        if (move_uploaded_file($poto_lok, $folder.$image_bt)) {
        $bunga= $qr->text($qrkata);
        $bunga1 = $qr->draw(300, $fold.$qrfull);
        $insert = $db->insert($tblName,$userData);
        echo $insert?'ok':'err';
    }
    }elseif($_POST['action_type'] == 'edit'){
        $gbt = $_FILES['gmb_batik']['name'];

        if(!empty($_POST['id'])){
            if (empty($gbt)){
                $conditions['where'] = array('id'=>$_POST['id']);
                $conditions['return_type'] = 'single';
                $asyik = $db->getRows($tblName,$conditions);
                $coba = $asyik['gmb_batik'];
                $userData = array(
                'id_batik' => $_POST['id_batik'],
                'nama_batik' => $_POST['nama_batik'],
                'asal_batik' => $_POST['asal_batik'],
                'desc_batik' => $_POST['desc_batik'],
                'pola_batik' => $_POST['pola_batik'],
                'gmb_batik' => $coba
                );
                $condition = array('id' => $_POST['id']);
                $update = $db->update($tblName,$userData,$condition);
                echo $update?'ok':'err';;
            }
            else if (!empty($gbt)){
                $poto=rand(1000,100000)."-".$_FILES['gmb_batik']['name'];
                $poto_lok=$_FILES['gmb_batik']['tmp_name'];
                $folder="files/";
                $poto_baru=strtolower($poto);
                $image_bt=str_replace('','-', $poto_baru);

                $conditions['where'] = array('id'=>$_POST['id']);
                $conditions['return_type'] = 'single';
                $asyik = $db->getRows($tblName,$conditions);
                unlink("files/".$asyik['gmb_batik']);

                
                $userData = array(
                'id_batik' => $_POST['id_batik'],
                'nama_batik' => $_POST['nama_batik'],
                'asal_batik' => $_POST['asal_batik'],
                'desc_batik' => $_POST['desc_batik'],
                'pola_batik' => $_POST['pola_batik'],
                'gmb_batik' => $image_bt
                );
                $condition = array('id' => $_POST['id']);
                 if (move_uploaded_file($poto_lok, $folder.$image_bt)) {
                
                $update = $db->update($tblName,$userData,$condition);
                echo $update?'ok':'err';}

            } 
            
        }
    }elseif($_POST['action_type'] == 'delete'){
        
        $conditio['where'] = array('id'=>$_POST['id']);
        $conditio['return_type'] = 'single';
        $purge = $db->getRows($tblName,$conditio);
        
        if(!empty($_POST['id'])){
            unlink("files/".$purge['gmb_batik']);
            unlink("files/qrcode/".$purge['qr_batik']);
            $condition = array('id' => $_POST['id']);
            $delete = $db->delete($tblName,$condition);
            echo $delete?'ok':'err';
        }
    }elseif($_POST['action_type'] == 'delGam'){
        $tblAran='tb_gam';
        $conditio['where'] = array('id'=>$_POST['id']);
        $conditio['return_type'] = 'single';
        $purge = $db->getRows($tblAran,$conditio);
        
        if(!empty($_POST['id'])){
            unlink("img/".$purge['gambar']);
            $condition = array('id' => $_POST['id']);
            $delete = $db->delete($tblAran,$condition);
            echo $delete?'ok':'err';
        }
    }
    elseif($_POST['action_type'] == 'ring'){
        $angka = $db->take($tblName);

        $kode = substr($angka['kode'], 2,5);
        $tambah=$kode+1;
        if ($tambah<10) {
            $id="BT00".$tambah;
        }elseif ($tambah<100) {
            $id="BT0".$tambah;
        }else{
            $id="BT".$tambah;
        }

        echo json_encode($id);
    }elseif($_POST['action_type'] == 'adm'){
        $tblAran='tb_admin';
        $conditions['where'] = array('id'=>$_POST['id']);
        $conditions['return_type'] = 'single';
        $user = $db->getRows($tblAran,$conditions);
        echo json_encode($user);
    }elseif($_POST['action_type'] == 'ubahadm'){
        $hash_cost_log2 = 8;
        $hash_portable = FALSE;
        $username = $_POST['username'];
        $pass_lama= $_POST['pass_lama'];
        $pass_new=$_POST['pass_new'];
        $tblAran='tb_admin';
        $hasher = new PasswordHash($hash_cost_log2,$hash_portable);
        if(!empty($_POST['id'])){

                $cek = $db->cekPass($tblAran,$username);
                $balik = $cek['password'];

                if ($hasher->CheckPassword($pass_lama,$balik)){
                    $hash = $hasher->HashPassword($pass_new);

                    $ganti = $db->gantiadm($tblAran,$hash,$username);
                    echo $ganti?'ok':'err';                    
                }else{
                echo 'err';
                }
            } 
            
        
    } elseif($_POST['action_type'] == 'viewAdm'){
        $tblAran='tb_admin';
        $datas = $db->getRows($tblAran,array('order_by'=>'id DESC'));
        if(!empty($datas)){
            $count = 0;
            foreach($datas as $datak): $count++;
                echo '<tr>';
                echo '<td>'.$count.'</td>';
                echo '<td>'.$datak['username'].'</td>';
                echo '<td>'.$datak['password'].'</td>';
                echo '<td><a href="javascript:void(0);" class="btn btn-info" onclick="editAdm(\''.$datak['id'].'\')"><i class="glyphicon glyphicon-pencil"></i> Edit</a></td>';
                 echo '<td><a href="javascript:void(0);" class="btn btn-danger" onclick="return confirm(\'Are you sure to delete data?\')?hapus(\'delete\',\''.$datak['id'].'\'):false;"><i class="glyphicon glyphicon-remove hapus"></i>Hapus</a></td>';
                echo '</tr>';
            endforeach;
        }else{
            echo '<tr><td colspan="5">No user(s) found......</td></tr>';
        }
        echo "<script type=\"text/javascript\" src=\"js/data.js\"></script>";
    } elseif ($_POST['action_type']=='gmb_ac') {
        $tblAran = 'tb_gam';
        $poto=rand(1000,100000)."-".$_FILES['gmb_back']['name'];
        $poto_lok=$_FILES['gmb_back']['tmp_name'];
        $folder="img/";
        $poto_baru=strtolower($poto);
        $image_cap=str_replace('','-', $poto_baru);
        
        $gamData = array(
            'name' => $_POST['capt'],
            'gambar' => $image_cap
        );

     if (move_uploaded_file($poto_lok, $folder.$image_cap)) {
        $gam = $db->insert($tblAran,$gamData);
        echo $insert?'ok':'err';
    }   
    }elseif($_POST['action_type'] == 'viewGam'){
    echo '<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.3.0/css/font-awesome.min.css" />';
    echo '<link rel="stylesheet" type="text/css" href="css/demo.css" />';
    echo '<link rel="stylesheet" type="text/css" href="css/style6.css" />';
    echo '<script src="js/modernizr-custom.js"></script>';
    echo '<script type="text/javascript" src="js/data.js"></script>';
    echo '<script src="js/jquery.min.js"></script>';
    echo '<script src="bootstrap/js/bootstrap.js"></script>';
    echo '<script type="text/javascript" src="js/data.js"></script>';
    echo '<script src="js/imagesloaded.pkgd.min.js"></script>';
    echo '<script src="js/masonry.pkgd.min.js"></script>';
    echo '<script src="js/classie.js"></script>';
    echo '<script src="js/main.js"></script>';
    echo "<script>
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
    </script>";
        $tblAran='tb_gam';
        $datas = $db->getRows($tblAran,array('order_by'=>'id DESC'));
        if(!empty($datas)){
            $count = 0;
            foreach($datas as $datak): $count++;
                echo '<div class="grid__item" data-size="1280x961">
                <a href="img/'.$datak['gambar'].'" class="img-wrap"><img src="img/'.$datak['gambar'].'" alt="" />
                <div class="description description--grid">'.$datak['name'].' </div>
                </a>
                <a href="javascript:void(0);"  onclick="return confirm(\'Are you sure to delete data?\')?hapus_gam(\'delGam\',\''.$datak['id'].'\'):false;">Hapus</a>
                </div>';
                

            endforeach;
        }else{
            echo '<tr><td colspan="5">Tak Ada Gambar yang Masuk</td></tr>';
        }
    

    
}
    exit;
}
?>