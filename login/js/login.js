$(document).ready(function(){
  //lakukan validasi 
    $("#form").validate({
            rules: {
                username: {           //input name: fullName
                    required: true,   //required boolean: true/false  
                },
                  password: {           //input name: fullName
                    required: true,   //required boolean: true/false   
                },
            },
            messages: {
              username : {
                required: "Masukan username anda"
              },
              password: {
                required: "Masukan Password anda"
              }
            },
            
        errorClass: 'help-block',
        errorElement: 'span',
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
        },
            

        }); 




//ketika tombol close notif di click, lakukan hide saja jangan di hapus element
 $("[data-hide]").on("click", function(){
        $(this).closest("." + $(this).attr("data-hide")).hide();
    });

  //untuk mengganti secara dinamis tampilan background halaman login
  $.backstretch([
      "img/2.jpg",
      "img/1.jpg",
      "img/3.jpg"
  ], {duration: 3000, fade: 1000});
  })