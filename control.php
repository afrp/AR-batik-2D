<?php
//$ade = $_POST['ade'];
$ade = "BT002";
$link = mysqli_connect("localhost", "root", "", "batik_id");

$datas = mysqli_query($link, "SELECT * FROM data_batik WHERE id_batik='$ade'");
$datak= mysqli_fetch_assoc($datas);
echo json_encode($datak);
/*             echo  '<div class="row" style="margin-left: -90px;">
                <div class="col-xs-6 col-sm-6 col-md-4">
                <img class="img-thumbnail img-responsive" src="login/admin/files/'.$datak['gmb_batik'].'" alt=""></div>
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
        </div>';*/
?>   