$(function(){
    var image = {
        init: function(){
            var self = this;

            $('.images').on('click', function(){
                path = $(this).data('path');
                $('#modal_image').attr('src', path);
                $('.image_modal').show();
            });

            $('.image_modal').on('click', function(){
                $('.image_modal').hide();
            });

            $('#name_asc').on('click', function(){
                window.location.href = window.location.pathname+'?name=ASC';
            });

            $('#name_desc').on('click', function(){
                window.location.href = window.location.pathname+'?name=DESC';
            });

            $('#date_asc').on('click', function(){
                window.location.href = window.location.pathname+'?date=ASC';
            });

            $('#date_desc').on('click', function(){
                window.location.href = window.location.pathname+'?date=DESC';
            });

            $('.search_images').on('click', function(){
                var search = $('#search').val();
                if (search != ''){
                    window.location.href = window.location.pathname+'?search='+search;
                }
            });

            $('.clear_search').on('click', function(){
                window.location.href = window.location.pathname;
            });

            $('.edit_name').on('click', function(){
                image = $(this).parent().find('img').data('imageid');
                $('#image_id').val(image);
                $('#edit_name').show();
            });

            $('.add_comment').on('click', function(){
                image = $(this).parent().find('img').data('imageid');
                $('#comment_image_id').val(image);
                $('#add_comment').show();
            });

            $('#save_name').on('click', function(){
                if ($('#name').val() != ''){
                    self.edit_name();
                    $('#edit_name').hide();
                } else {
                    $('#error_message').html('Please enter a name').removeClass('collapse');
                }
            });

            $('#cancel').on('click', function(){
                $("#edit_name_form")[0].reset();
                $('#edit_name').hide();
            });

            $('#save_comment').on('click', function(){
                if ($('#comment').val() != ''){
                    self.add_comment();
                    $('#add_comment').hide();
                } else {
                    $('#error_message').html('Please enter a name').removeClass('collapse');
                }
            });

            $('#cancel_comment').on('click', function(){
                $("#add_comment_form")[0].reset();
                $('#add_comment').hide();
            });
        },
        edit_name: function(){
            var data = $('#edit_name_form').serializeArray();
            $.ajax({
                url: 'edit_name',
                type: 'POST',
                data: data,
                success: function(res){
                    if (res.success == 1){
                        var name = '#' + res.id;
                        $(name).text(res.name);
                        $("#edit_name_form")[0].reset();
                    }
                }
            })
        },
        add_comment: function(){
            var data = $('#add_comment_form').serializeArray();
            $.ajax({
                url: 'add_comment',
                type: 'POST',
                data: data,
                success: function(res){
                    if (res.success == 1){
                        $('#success_message').show();
                        $("#add_comment_form")[0].reset();
                    }
                }
            });
        }
    }
    
    image.init();
});