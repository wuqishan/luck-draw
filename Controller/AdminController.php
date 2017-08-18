<?php

namespace Controller;

use Model\RewardModel;
use Model\UserModel;

class AdminController extends Controller
{
    /**
     * 添加用户【用户号码】
     *
     * @param $data
     * @return array
     */
    public function addPhoneNumber($data)
    {
        $userModel = new UserModel();
        $this->result['data']['sub_data'] = $userModel->addUser($data['phone_number']);
        $this->result['data']['all_data'] = $userModel->getAll();

        return $this->result;
    }

    /**
     * 删除用户，初始化用户和删除部分用户
     *
     * @param $data
     * @return array
     */
    public function delPhoneNumber($data)
    {
        $userModel = new UserModel();
        $this->result['data']['sub_data'] = $userModel->delUser($data['phone_number'], $data['del_type']);
        $this->result['data']['all_data'] = $userModel->getAll();

        return $this->result;
    }

    public function initReward($data)
    {
        $rewardModel = new RewardModel();
        $this->result['data']['all_data'] = $rewardModel->initReward($data);

        return $this->result;
    }

    /**
     * 获取所有用户信息
     *
     * @return array
     */
    public function getAllUser()
    {
        $userModel = new UserModel();

        return $userModel->getAllUser();
    }
}


?>