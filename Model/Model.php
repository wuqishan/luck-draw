<?php

namespace Model;

use Tool\Db;

class Model
{
    private $db;
    protected $tableName;


    public function __construct()
    {
        $this->db = Db::getIntance();
    }
}


?>