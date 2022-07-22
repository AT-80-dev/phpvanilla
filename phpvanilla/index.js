//Create New Record
$(document).ready(function() {

    fetch();

    $(".show-modal").on("click", function () {
        $("#modalFrm").css("display", "block");
    });

    $(".close, .cancel").on("click", function () {
        $("#modalFrm").css("display", "none");
        $("#title").removeClass("has-error");
        $("#file_upload").removeClass("has-error");
        $("#title").parent().children().find('.text-danger').addClass("d-none");
        $("#file_upload").parent().children().find('.text-danger').addClass("d-none");

    });

    $(".btn-edit").on("click", function () {
        $("#modalFrm").css("display", "block");
    });


    $('.btn-add').on('click', function(e) {
        if ($("#title").val() == '') {
            $("#title").parent().children().find('.text-danger').removeClass("d-none");
            $("#title").addClass("has-error");
        }else if ($("#file_upload").val() == '') {
            $("#file_upload").parent().children().find('.text-danger').removeClass("d-none");
            $("#file_upload").addClass("has-error");
        } else {
            
            e.preventDefault();
            var id      =   $('#id').val();
            var file_data = $('#file_upload').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
            form_data.append('title', $("#title").val());
    
            var url = "";
            if( id.length > 0 ) {
                url = '/php/update.php?id=' + id; 
            } else {
                url = '/php/create.php'; 
            }
            console.log(url);
            $.ajax({
                url: url,  
                dataType: 'json',  
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                    $("#modalFrm").css("display", "none");
                    fetch();
                }
             });
                    
            $('#insert_form')[0].reset();
        }

    });

    $(document).on('click', '.btn-delete', function(e) {

        e.preventDefault();

        $.ajax({
            url: '/php/delete.php?id=' + $(this).attr("data-id"),
            type: 'post',
            success: function(response){
                fetch();
            }
        });

    });

    $(document).on('click', '.btn-edit', function(e) {


        e.preventDefault();

        $('#id').val($(this).attr("data-id"));
        
        $('#title').val( $(this).parent().parent().find("td").eq(0).html() );
        
        $("#modalFrm").css("display", "block");

    });

    $('.btn-cancel').on('click', function() {
        $('#insert_form')[0].reset();
    });

});

//Fetch All Records
function fetch(){
			
	$.ajax({
		url: '/php/read.php',
		type: 'post',
		success: function(response){
            var data = JSON.parse(response)
            populate(data.response);
		}
	});
}

function populate(data) {
    var html = '';

    if( data.length > 0 ) {

        for (let index = 0; index < data.length; index++) {

            var data_filename = data[index].filename;
            var filename = data_filename.split(".")

           
            html += '<tr>';
            html +=     '<td class="text-uppercase">'+ data[index].title +'</td>';

            if( $.inArray("pdf", filename ) !== -1 ) {
    
                html +=     '<td class="text-uppercase"><img style="border-radius: 50%;height: 35px;width: 35px;" src="/uploaded_files/pdf-icon.png"></td>';
            } else {
                html +=     '<td class="text-uppercase"><img style="border-radius:50%;" src="/uploaded_files/'+data[index].filename+'" width="50" height="50"></td>';
            }
            

            html +=     '<td class="text-uppercase">'+ data[index].filename +'</td>';
            html +=     '<td class="text-uppercase">'+ data[index].date +'</td>';
            html +=     '<td><button type="button" class="btn btn-secondary btn-edit" data-id="'+data[index].id+'">EDIT</button> <button type="button" class="btn btn-secondary btn-delete" data-id="'+data[index].id+'">DEL</button></td>';
            html += '</tr>';
        }

    } else {
        html = `<tr>
                    <td colspan="7">No data present</td>
                </tr>`;
    }
    
    $("#dv-catalog").html(html)



}
