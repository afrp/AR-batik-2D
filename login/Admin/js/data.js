$(function() {
        $('#me a').lightBox();
        $('#men a').lightBox();
    });

    $(document).on("click", ".open-AddBookDialog", function () {
     var kata = $(this).data('id');
     document.getElementById("panjang").innerHTML=kata;
     //$(".modal-body #panjang").val( myBookId );
});
		function PreviewImage() {
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("gmb_batik").files[0]);
		oFReader.onload = function (oFREvent) {
		document.getElementById("uploadPreview").src = oFREvent.target.result;
    	};
		};

        function reviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("gmb_edit").files[0]);
        oFReader.onload = function (oFREvent) {
        document.getElementById("uploadreview").src = oFREvent.target.result;
        };
        };

    function getUsers(){
    $.ajax({
        type: 'POST',
        url: 'userAction.php',
        data: 'action_type=view',
        success:function(html){
            $('#userData').html(html);
        }
    });
}

 
    function getGam(){
    $.ajax({
        type: 'POST',
        url: 'userAction.php',
        data: 'action_type=viewGam&'+$("#userForm").serialize(),
        success:function(html){
            $('#grid').html(html);
            //$('.preview').toggle();
        }
    });
} 

    function getAdmin(){
    $.ajax({
        type: 'POST',
        url: 'userAction.php',
        data: 'action_type=viewAdm&'+$("#userForm").serialize(),
        success:function(html){
            $('#userData').html(html);
        }
    });
}   
    
        function userAction(type,id){
            id = (typeof id == "undefined")?'':id;
            var statusArr = {add:"added",edit:"updated",ubah:"diubah"};
            var userData = '';
            
            if (type == 'add') {
                var id_batik = $("#id_batik").val();
                var nama_batik = $("#nama_batik").val();
                var asal_batik = $("#asal_batik").val();
                var desc_batik = $("#desc_batik").val();
                var pola_batik = $("#pola_batik").val();
                var gmb_batik = $("#gmb_batik").prop('files')[0];
                var action_type = "add";
                var userData = new FormData();

                userData.append('action_type', action_type);
                userData.append('id_batik', id_batik);
                userData.append('nama_batik', nama_batik);
                userData.append('asal_batik', asal_batik);
                userData.append('desc_batik', desc_batik);
                userData.append('pola_batik', pola_batik);
                userData.append('gmb_batik', gmb_batik);
                
            }else if (type == 'edit'){
                var id = $("#id_ed").val();
                var id_batik = $("#id_edit").val();
                var nama_batik = $("#nama_edit").val();
                var asal_batik = $("#asal_edit").val();
                var desc_batik = $("#desc_edit").val();
                var pola_batik = $("#pola_edit").val();
                var gmb_batik = $("#gmb_edit").prop('files')[0];
                var action_type = "edit";
                var userData = new FormData();

                userData.append('id', id);
                userData.append('action_type', action_type);
                userData.append('id_batik', id_batik);
                userData.append('nama_batik', nama_batik);
                userData.append('asal_batik', asal_batik);
                userData.append('desc_batik', desc_batik);
                userData.append('pola_batik', pola_batik);
                userData.append('gmb_batik', gmb_batik);
            }
            $.ajax({
                url: 'userAction.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: userData,
                type: 'post',
                success:function(msg){
                    if(msg == 'err'){
                        alert('Ada beberapa Kesalahan, Silakan Coba Lagi.');
                    }else{
                        alert('Batik data has been '+statusArr[type]+' successfully.');
                        getUsers();
                        $('.form')[0].reset();                    
                        $('.formData').slideUp();
                        document.getElementById("uploadreview").src = none;
                    }
                }
            });
        }

        function admUbah(){
            var id = $("#id_pass").val();
            var username = $("#user_edit").val();
            var pass_lama = $("#pass_edit").val();
            var pass_new = $("#pass_new").val();
            var action_type = "ubahadm";
            var userData = new FormData();
            userData.append('id',id);
            userData.append('username', username);
            userData.append('action_type', action_type);
            userData.append('pass_lama',pass_lama);
            userData.append('pass_new',pass_new);
            $.ajax({
                url: 'userAction.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: userData,
                type: 'post',
                success:function(msg){
                    if(msg == 'err'){
                        alert('Ada beberapa Kesalahan, Silakan Coba Lagi.');
                    }else{
                        alert('User data has been changed successfully.');
                        getAdmin();
                        $('.form')[0].reset();                    
                        $('.formData').slideUp();
                        
                    }
                }

            });

        }
        function hapus (type,id){
            id = (typeof id == "undefined")?'':id;
            var userData = 'action_type='+type+'&id='+id;
            $.ajax({
                    type: 'POST',
                    url: 'userAction.php',
                    data: userData,
                    success:function(msg){
                        if(msg == 'err'){
                            alert('Ada beberapa Kesalahan, Silakan Coba Lagi.');
                        }else{
                            alert('Data has been delete successfully.');
                            getUsers();
                            $('.form')[0].reset();

                            $('.formData').slideUp();
                        }
                    }
                });

        }
        function hapus_gam (type,id){
            id = (typeof id == "undefined")?'':id;
            var userData = 'action_type='+type+'&id='+id;
            $.ajax({
                    type: 'POST',
                    url: 'userAction.php',
                    data: userData,
                    success:function(msg){
                        if(msg == 'err'){
                            alert('Ada beberapa Kesalahan, Silakan Coba Lagi.');
                        }else{                            
                            //$('.preview').val('hide');
                            alert('Image has been delete successfully.');
                            
                            getGam();
                            
                        }
                    }
                });

        }
        function editUser(id){
            $.ajax({
                type: 'POST',
                dataType:'JSON',
                url: 'userAction.php',
                data: 'action_type=data&id='+id,
                success:function(data){
                    $('#id_ed').val(data.id);
                    $('#id_edit').val(data.id_batik);
                    $('#nama_edit').val(data.nama_batik);
                    $('#asal_edit').val(data.asal_batik);
                    $('#desc_edit').val(data.desc_batik);
                    $('#pola_edit').val(data.pola_batik);

                    $('#editForm').slideDown();
                }
            });
        }

        function editAdm(id){
            $.ajax({
                type: 'POST',
                dataType:'JSON',
                url: 'userAction.php',
                data: 'action_type=adm&id='+id,
                success:function(data){
                    $('#id_pass').val(data.id);
                    $('#user_edit').val(data.username);
                    //$('#pass_edit').val(data.password);
                    $('#editFormAdm').slideDown();
                }
            });
        }        

        function gmbAction(){
            var gmb_back = $("#gmb_batik").prop('files')[0];
            var action_type = "gmb_ac";
            var capt= $("#capt").val();
            var userData = new FormData();

            userData.append('capt', capt);
            userData.append('gmb_back', gmb_back);
            userData.append('action_type', action_type);
            $.ajax({
                url: 'userAction.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: userData,
                type: 'post',
                success:function(msg){
                    if(msg == 'err'){
                        alert('Ada beberapa Kesalahan, Silakan Coba Lagi.');
                    }else{
                        alert('Gambar telah berhasil di upload');
                        getGam();
                        $('.form')[0].reset();                    
                        $('.formData').slideUp();
                        
                        
                    }
                }
            });
        }

        function tombol(){
            $.ajax({
                type: 'POST',
                dataType:'JSON',
                url: 'userAction.php',
                data: 'action_type=ring',
                success:function(data){
                    $('#id_batik').val(data);

                    $('#addForm').slideToggle();
                }
            });
        }