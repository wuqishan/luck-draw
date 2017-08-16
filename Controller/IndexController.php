<?php

namespace Controller;

use Model\UserModel;

class IndexController extends Controller
{
    public function test()
    {
        $userModel = new UserModel();
        return $userModel->getUser();
    }
}


?>