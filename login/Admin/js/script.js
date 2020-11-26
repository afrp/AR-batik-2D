// Add Record
function addRecord() {
    
    
    var kd_bt = $("#kd_bt").val();
    var name_bt = $("#name_bt").val();
    var asal_bt = $("#asal_bt").val();
    var dsc_bt = $("#dsc_bt").val();
    var pola_bt = $("#pola_bt").val();
    var image_bt = $('#image_bt').prop('files')[0];;

    var form_data = new FormData();
    
    form_data.append('kd_bt', kd_bt);
    form_data.append('name_bt', name_bt);
    form_data.append('asal_bt', asal_bt);
    form_data.append('dsc_bt', dsc_bt);
    form_data.append('pola_bt', pola_bt);
    form_data.append('image_bt',image_bt);
    $.ajax({
            url: 'ajax/addRecord.php', // point to server-side PHP script
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data){
                // get server responce here
                alert("Berhasil");
                // clear file field
                $("#add_new_record_modal").modal("hide");

        // read records again
        window.location.reload();

                $("#file_to_upload").val("");
                $("#kd_bt").val("");
        $("#name_bt").val("");
        $("#asal_bt").val("");
        $("#dsc_bt").val("");
        $("#pola_bt").val("");
        $("#image_bt").val("");
            }
        });
    /*var kd_bt = $("#kd_bt").val();
    var name_bt = $("#name_bt").val();
    var asal_bt = $("#asal_bt").val();
    var dsc_bt = $("#dsc_bt").val();
    var pola_bt = $("#pola_bt").val();
    var image_bt = $('#image_bt').val();

    // Add record
    $.post("ajax/addRecord.php", {
        kd_bt: kd_bt,
        name_bt: name_bt,
        asal_bt: asal_bt,
        dsc_bt: dsc_bt,
        pola_bt: pola_bt,
        image_bt: image_bt
    },  function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        window.location.reload();

        // clear fields from the popup
        $("#kd_bt").val("");
        $("#name_bt").val("");
        $("#asal_bt").val("");
        $("#dsc_bt").val("");
        $("#pola_bt").val("");
        $("#image_bt").val("");
    });
    */
}

// READ records



function DeleteBatik() {
    var kamu = this.id;
    var conf = confirm("Are you sure, do you really want to delete Batik?");
    var form_data = new FormData();
    
    form_data.append('kamu', kamu);

    if (conf == true) {
        $.ajax({
            url: 'ajax/deleteBatik.php', // point to server-side PHP script
            dataType: 'text',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data){
                
        window.location.reload();

                
            }




            }
        );
    }
}

function GetBatikDetails(value) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(value);
    $.post("ajax/readBatikDetails.php", {
            value: value
        },
        function (data, status) {
            // PARSE json data
            var batik = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#kd_bt").val(batik.id_batik);
            $("#name_bt").val(batik.nama_batik);
            $("#asal_bt").val(batik.asal_batik);
            $("#dsc_bt").val(batik.desc_batik);
            $("#pola_bt").val(batik.pola_batik);
        }
    );
    // Open modal popup
    $("#update_batik_modal").modal("show");
}

function UpdateUserDetails() {
    // get values
    var first_name = $("#update_first_name").val();
    var last_name = $("#update_last_name").val();
    var email = $("#update_email").val();

    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/updateUserDetails.php", {
            id: id,
            first_name: first_name,
            last_name: last_name,
            email: email
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}

$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
});