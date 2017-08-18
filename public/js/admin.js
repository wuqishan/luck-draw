$(function(){

});

/**
 * 添加用户
 */
function add_phone_number()
{
    var add_phone_number_input = $('.add_phone_number_input').val();
    if (add_phone_number_input != '') {
        $.ajax({
            url: 'admin.php',
            data: {phone_number: add_phone_number_input, type: 'add_phone_number'},
            dataType: 'json',
            type: 'post',
            beforeSend: function (request) {},
            complete: function (request, status) {
                if (status == 'success') {
                    $('.add_phone_number_input').val('');
                }
            },
            success: function (result) {
                var show_all = [];
                for (var i = 0; i < result.data.all_data.length; i++) {
                    show_all.push(result.data.all_data[i].phone_number);
                }
                $('.all_user').html(show_all.join(', '));

                if (result.data.sub_data.wrong.length > 0) {
                    alert('号码格式错误的用户有: ' + result.data.sub_data.wrong.join(', '));
                }
            }
        });
    }
}

/**
 * 删除用户
 *
 * @param del_type
 */
function delete_phone_number(del_type)
{
    if (del_type == 'init' && ! confirm('您确定初始化所有用户？[此操作将删除所有用户]')) {
        return;
    }

    var del_phone_number_input = $('.del_phone_number_input').val();
    if (del_phone_number_input != '' || del_type == 'init') {
        $.ajax({
            url: 'admin.php',
            data: {phone_number: del_phone_number_input, type: 'del_phone_number', del_type: del_type},
            dataType: 'json',
            type: 'post',
            beforeSend: function (request) {},
            complete: function (request, status) {
                if (status == 'success') {
                    $('.del_phone_number_input').val('');
                }
                if ($('.all_user').html() == '') {
                    $('.all_user').html('[暂无用户数据]');
                }
            },
            success: function (result) {
                var show_all = [];
                for (var i = 0; i < result.data.all_data.length; i++) {
                    show_all.push(result.data.all_data[i].phone_number);
                }
                $('.all_user').html(show_all.join(', '));

                if (result.data.sub_data.wrong != undefined && result.data.sub_data.wrong.length > 0) {
                    alert('号码格式错误的用户有: ' + result.data.sub_data.wrong.join(', '));
                }
            }
        });
    }
}

/**
 * 初始化抽奖信息
 */
function init_reward()
{
    var total_number = parseInt($('.total_number').val());
    var grade_number_1 = parseInt($('.grade_number_1').val());
    var grade_number_2 = parseInt($('.grade_number_2').val());
    var grade_number_3 = parseInt($('.grade_number_3').val());

    if (isNaN(total_number) || parseInt(total_number) == 0) {
        alert('待抽总数量需是大于零的整数');
        return;
    }

    $.ajax({
        url: 'admin.php',
        data: {total_number: total_number, grade_number_1: grade_number_1,
            grade_number_2: grade_number_2, grade_number_3: grade_number_3, type: 'init_reward'},
        dataType: 'json',
        type: 'post',
        beforeSend: function (request) {},
        complete: function (request, status) {},
        success: function (result) {
            $('.total_number').val(result.data.all_data.total_number);
            $('.grade_number_1').val(result.data.all_data.grade_number_1);
            $('.grade_number_2').val(result.data.all_data.grade_number_2);
            $('.grade_number_3').val(result.data.all_data.grade_number_3);
        }
    });
}