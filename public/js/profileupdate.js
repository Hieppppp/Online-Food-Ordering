$(document).ready(function(){
    // Xem trước hình ảnh
    $("#profile_image").change(function(){
        let reader = new FileReader();

        reader.onload = function(e) {
            $("#customerProfilePicture").attr('src', e.target.result);
        };
        
        reader.readAsDataURL(this.files[0]);
    });

    $("#profile_setup_frm").submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btn").attr("disabled", true).html("Updating...");

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.code === 400) {
                    let error = '<div class="alert alert-danger">' + response.msg + '</div>';
                    $("#res").html(error);
                } else if (response.code === 200) {
                    let success = '<div class="alert alert-success">' + response.msg + '</div>';
                    $("#res").html(success);
                    
                    // Cập nhật lại hình ảnh người dùng
                    $("#customerProfilePicture").attr('src', response.image_url);
                }
                $("#btn").attr("disabled", false).html("Update");
            }
        });
    });
});
