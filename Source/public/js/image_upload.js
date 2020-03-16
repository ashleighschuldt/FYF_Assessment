$(function(){
    var image_upload = {
        init: function(){
            $('#image_upload').on('submit', function(e){
                e.preventDefault();
                $('#error_message').addClass('collapse');
                $('#success_message').addClass('collapse');

                var formData = new FormData($('#image_upload')[0]);
                $.ajax({
                    url: 'upload',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res){
                        if (res.success == 1){
                            $("#image_upload")[0].reset();
                            $('#success_message').removeClass('collapse');
                        } else {
                            if (res.error){
                                $('#error_message').text(res.error);
                            } else {
                                $('#error_message').text(res);
                            }
                            $('#error_message').removeClass('collapse');
                        }
                    }
                });
            });
        }
    };
    
    image_upload.init();
});