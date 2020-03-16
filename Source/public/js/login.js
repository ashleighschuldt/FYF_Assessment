$(function(){
    var login = {
        init: function(){
            $('#login_form').on('submit', function(e){
                e.preventDefault();
                $('#error_message').addClass('collapse');
                var data = $('#login_form').serializeArray();

                $.ajax({
                    url: 'login',
                    type: 'POST',
                    data: data,
                    success: function(res){
                        if (res.success == 1){
                            window.location.href = '/dashboard';
                        } else {
                            $('#error_message').removeClass('collapse');
                        }
                    }
                });
            });
        }
    };
    
    login.init();
});