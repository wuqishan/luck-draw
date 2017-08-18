/**
 * 弹框的标题显示内容
 *
 * @type {{lang_1: string, lang_2: string, lang_3: string, lang_10000: string}}
 */
var detail_popup_lang = {
    lang_1: '抽取一等奖用户如下',
    lang_2: '抽取二等奖用户如下',
    lang_3: '抽取三等奖用户如下',
    lang_10000: '抽取普照奖用户如下'
};


$(function(){

    // 头部时钟显示
    setInterval(function() {
        $('.time').html(getCurrentTime());
    }, 1000);

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
            beforeSend: function (request) {
                $('.box').show();
            },
            complete: function (request, status) {
                if (status == 'success') {
                    $('.add_phone_number_input').val('');
                }
                $('.box').hide();
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
            beforeSend: function (request) {
                $('.box').show();
            },
            complete: function (request, status) {
                if (status == 'success') {
                    $('.del_phone_number_input').val('');
                }
                if ($('.all_user').html() == '') {
                    $('.all_user').html('[暂无用户数据]');
                }
                $('.box').hide();
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

    if (! confirm('您确定对抽奖进行初始化吗？[此操作将删除之前所有的抽奖记录]')) {
        return;
    }

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
        beforeSend: function (request) {
            $('.box').show();
        },
        complete: function (request, status) {
            $('.box').hide();
        },
        success: function (result) {
            $('.total_number, .current_total_number').val(result.data.all_data.total_number);
            $('.grade_number_1, .current_grade_number_1').val(result.data.all_data.grade_number_1);
            $('.grade_number_2, .current_grade_number_2').val(result.data.all_data.grade_number_2);
            $('.grade_number_3, .current_grade_number_3').val(result.data.all_data.grade_number_3);
        }
    });
}

/**
 * 获取当前某个奖项的详细信息
 *
 * @param grade
 */
function reward_away_detail(grade) {
    $.ajax({
        url: 'admin.php',
        data: {grade: grade, type: 'reward_detail'},
        dataType: 'json',
        type: 'post',
        beforeSend: function (request) {
            $('.box').show();
        },
        complete: function (request, status) {
            $('.box').hide();
        },
        success: function (result) {
            console.log(result);
            var detail = [];
            if (result.data.length > 0) {
                for (var i = 0; i < result.data.length; i++) {
                    detail.push('<span title="'+result.data[i].away_time+'">'+result.data[i].phone_number+'; </span>');
                }
            }

            layer.open({
                title: eval('detail_popup_lang.lang_' + grade),
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['420px', '240px'], //宽高
                content: '<div style="margin-top: 10px">'+detail.join('')+'</div>'
            });
        }
    });
}

/**
 * 简单时间的获取
 *
 * @returns {string}
 */
function getCurrentTime()
{
    var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var day = now.getDate();

    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    month = month < 10 ? '0' + month : month;
    day = day < 10 ? '0' + day : day;
    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
}