<?php

namespace Controller;

use Model\UserModel;

class AdminController extends Controller
{
    public function addPhoneNumber($phone_number)
    {
        $userModel = new UserModel();
        return $userModel->getUser($phone_number);
    }
}


?>