<?php

namespace Model;

use Tool\Db;

class Model
{
    private $db;
    protected $tableName;
    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->db = Db::getIntance();
    }
    

    public function fetchOneByPk($pk)
    {
        $sql = sprintf('select * from `%s` where ``%s`=%s', $this->tableName, $this->primaryKey);

        return $this->db->getRow($sql);
    }

    public function insert($data)
    {
        return $this->db->insert($this->tableName, $data);
    }

}


?>