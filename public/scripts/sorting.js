/*
$(document).ready(function () {
    $(document).on('click', '.column_sort', function () {
        let column_name = $(this).attr('id');
        let order = $(this).data('order');
        let arrow = '';

        if(order = 'desc') {
            arrow = '<i class="fa fa-arrow-down"></i>';
        } else {
            arrow = '<i class="fa fa-arrow-up"></i>';
        }
        $.ajax({
            url:"/show",
            method:"POST",
            data:{column_name:column_name, order:order},
            success:function (data) {
                $('#users_table').html(data);
                $('#'+column_name+'').append(arrow);
            }
        })
    });
});
*/
