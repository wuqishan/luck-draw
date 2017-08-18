<?php

namespace Controller;

use Model\UserModel;

class AdminController extends Controller
{
    public function addPhoneNumber($phone_number)
    {
        $userModel = new UserModel();
        $this->result['data'] = $userModel->addUser($phone_number);

        echo json_encode($this->result);
    }
}


?>