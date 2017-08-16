<?php

namespace Controller;

use Model\BaseModel;

class IndexController extends Controller
{
    public function test()
    {
        $baseModel = new BaseModel();
        return $baseModel->test();
    }
}


?>