<?php

include '../vendor/autoload.php';

use Controller\AdminController;


$admin = new AdminController();

if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"])=="xmlhttprequest"){
    $result = [];
    switch (trim($_POST['type'])) {
        case 'add_phone_number':
            echo json_encode($admin->addPhoneNumber($_POST));
            break;

        case 'del_phone_number':
            echo json_encode($admin->delPhoneNumber($_POST));
            break;

        case 'init_reward':
            echo json_encode($admin->initReward($_POST));
            break;

        case 'reward_detail':
            echo json_encode($admin->rewardDetail($_POST));
            break;

        default:
    }
    exit;
} else {
    // 获取所有用户
    $allUser = $admin->getAllUser();
    // 获取抽奖初始化信息
    $rewardInfo = $admin->getRewardInfo();
    // 获取各个奖项剩余数量
    $currentRewardInfo = $admin->getRewardInfo(true);
}

//print_r( $rewardInfo);

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="抽奖活动后台">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/layer/layer.js"></script>
    <title>抽奖活动</title>
</head>
<body>
<div class="container">
    <h1>抽奖活动后台设置<span class="time">2015-08-12 12:09:06</span></h1>
    <table border="1" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th colspan="8">初始化参与者</th>
        </tr>
        <tr>
            <td>所有参与用户</td>
        </tr>
        <tr>
            <td><span class="all_user"><?php if(isset($allUser) && is_array($allUser)) {echo implode(', ', $allUser);} ?></span></td>
        </tr>
        <tr>
            <td><input type="button" class="init_phone_number button fr" onclick="delete_phone_number('init');" value="清空所有的用户"></td>
        </tr>
        <tr>
            <td>添加参与者电话号码(一次填写多个以英文逗号‘,’分隔)</td>
        </tr>
        <tr>
            <td><input type="text" placeholder="请输入需要添加的参与者号码" class="add_phone_number_input" style="width: 100%"></td>
        </tr>
        <tr>
            <td>
                <input type="button" class="add_phone_number button fr" onclick="add_phone_number();" value="添加参与者电话">
            </td>
        </tr>
        <tr>
            <td>删除参与者电话号码(一次填写多个以英文逗号‘,’分隔)</td>
        </tr>
        <tr>
            <td><input type="text" placeholder="请输入需要删除的参与者号码" class="del_phone_number_input" style="width: 100%"></td>
        </tr>
        <tr>
            <td>
                <input type="button" class="del_phone_number button fr" onclick="delete_phone_number('del');" value="删除参与者电话">
            </td>
        </tr>
    </table>
    <table border="1" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th colspan="8">抽奖初始化</th>
        </tr>
        <tr>
            <td>待抽总数量</td>
            <td><input type="text" placeholder="待抽总数量" class="total_number" value="<?php if($rewardInfo['total_number']) { echo $rewardInfo['total_number']; } ?>"></td>
            <td>一等奖总数量</td>
            <td><input type="text" placeholder="一等奖数量" class="grade_number_1" value="<?php if($rewardInfo['grade_number_1']) { echo $rewardInfo['grade_number_1']; } ?>"></td>
        </tr>
        <tr>
            <td>二等奖总数量</td>
            <td><input type="text" placeholder="二等奖数量" class="grade_number_2" value="<?php if($rewardInfo['grade_number_2']) { echo $rewardInfo['grade_number_2']; } ?>"></td>
            <td>三等奖总数量</td>
            <td><input type="text" placeholder="三等奖数量" class="grade_number_3" value="<?php if($rewardInfo['grade_number_3']) { echo $rewardInfo['grade_number_3']; } ?>"></td>
        </tr>
        <tr>
            <td>安慰奖总数量</td>
            <td><input type="text" placeholder="安慰奖数量" class="grade_number_10000" value="<?php if($rewardInfo['grade_number_10000']) { echo $rewardInfo['grade_number_10000']; } ?>" disabled></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="8"><input type="button" class="init_reward button fr" onclick="init_reward();" value="初始化抽奖总数及奖品数量"></td>
        </tr>
    </table>

    <table border="1" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <th colspan="4">抽奖报表(剩余数量)</th>
        </tr>
        <tr>
            <td>待抽总数量</td>
            <td>
                <input type="text" class="current_total_number" value="<?php if($currentRewardInfo['total_number']) { echo $currentRewardInfo['total_number']; } ?>" disabled>
            </td>
            <td>一等奖数量</td>
            <td>
                <input type="text" class="current_grade_number_1" value="<?php if($currentRewardInfo['grade_number_1']) { echo $currentRewardInfo['grade_number_1']; } ?>" disabled>
                <input type="button" class="button-sm" onclick="reward_away_detail(1)" value="抽奖详情">
            </td>
        </tr>
        <tr>
            <td>二等奖数量</td>
            <td>
                <input type="text" class="current_grade_number_2" value="<?php if($currentRewardInfo['grade_number_2']) { echo $currentRewardInfo['grade_number_2']; } ?>" disabled>
                <input type="button" class="button-sm" onclick="reward_away_detail(2)" value="抽奖详情">
            </td>
            <td>三等奖数量</td>
            <td>
                <input type="text" class="current_grade_number_3" value="<?php if($currentRewardInfo['grade_number_3']) { echo $currentRewardInfo['grade_number_3']; } ?>" disabled>
                <input type="button" class="button-sm" onclick="reward_away_detail(3)" value="抽奖详情">
            </td>
        <tr>
            <td>安慰奖数量</td>
            <td>
                <input type="text" class="current_grade_number_10000" value="<?php if($currentRewardInfo['grade_number_10000']) { echo $currentRewardInfo['grade_number_10000']; } ?>" disabled>
                <input type="button" class="button-sm" onclick="reward_away_detail(10000)" value="抽奖详情">
            </td>
            <td colspan="2"></td>
        </tr>
        </tr>
    </table>
</div>
<div class="box"><img src="images/loading.gif"></div>
</body>
<script type="text/javascript" src="js/admin.js"></script>
</html>