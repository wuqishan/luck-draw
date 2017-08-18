<?php

include '../vendor/autoload.php';

use Controller\AdminController;

$admin = new AdminController();


if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
    $result = [];
    switch (trim($_POST['type'])) {
        case 'add_phone_number':

            $result = $admin->addPhoneNumber($_POST['phone_number']);

            break;

        case '':
            break;
        default:

    }
    // ajax 请求的处理方式
    echo "<pre>";print_r($result);
    exit;
}

//print_r( $index->test());

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="抽奖活动后台">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

    <title>抽奖活动</title>

</head>
<body>
<div class="container">
    <h1>抽奖活动后台设置</h1>
    <table border="1" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th colspan="8">初始化参与者</th>
        </tr>
        <tr>
            <td>所有参与用户</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td><input type="button" class="init_phone_number button fr" value="清空所有的用户"></td>
        </tr>
        <tr>
            <td>添加参与者电话号码(一次填写多个以英文逗号‘,’分隔)</td>
        </tr>
        <tr>
            <td><input type="text" class="phone_number" style="width: 100%"></td>
        </tr>
        <tr>
            <td>
                <input type="button" class="add_phone_number button fr" value="添加参与者电话">
            </td>
        </tr>
        <tr>
            <td>删除参与者电话号码(一次填写多个以英文逗号‘,’分隔)</td>
        </tr>
        <tr>
            <td><input type="text" class="phone_number" style="width: 100%"></td>
        </tr>
        <tr>
            <td>
                <input type="button" class="del_phone_number button fr" value="删除参与者电话">
            </td>
        </tr>
    </table>
    <table border="1" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th colspan="8">抽奖初始化</th>
        </tr>
        <tr>
            <td>待抽总数量</td>
            <td><input type="text" name="total_number"></td>
            <td>一等奖总数量</td>
            <td><input type="text" name="grade_1_number"></td>
            <td>二等奖总数量</td>
            <td><input type="text" name="grade_2_number"></td>
            <td>三等奖总数量</td>
            <td><input type="text" name="grade_3_number"></td>
        </tr>
        <tr>
            <td colspan="8"><input type="button" class="init_reward button fr" value="初始化抽奖总数及奖品数量"></td>
        </tr>
    </table>

    <table border="1" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th colspan="8">抽奖报表</th>
        </tr>
        <tr>
            <td>待抽总数量</td>
            <td><input type="text" disabled></td>
            <td>一等奖剩余数量</td>
            <td><input type="text" disabled></td>
            <td>二等奖剩余数量</td>
            <td><input type="text" disabled></td>
            <td>三等奖剩余数量</td>
            <td><input type="text" disabled></td>
        </tr>
    </table>

</div>
</body>
<script type="text/javascript" src="js/admin.js"></script>
</html>