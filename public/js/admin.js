var phone_number_all = '';

$(function(){

    phone_number_all = $('.phone_number').val();

    // 添加电话
    $('.add_phone_number').click(function(){
        var phone_number = $('.phone_number').val();
        alert(1);
        if (phone_number != phone_number_all || (phone_number == '' && phone_number_all == '')) {
            alert(2);
            $.ajax({
                url: 'admin.php',
                data: {phone_number: phone_number, type: 'add_phone_number'},
                dataType: 'json',
                type: 'post',
                beforeSend: function (request) {

                },
                complete: function (request, status) {

                },
                success: function (result) {
                    console.log(result);
                }
            });
        }
    });
});