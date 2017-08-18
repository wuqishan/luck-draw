<?php

namespace Model;

use Tool\Db;

class Model
{
    protected $db;
    protected $tableName;
    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->db = Db::getIntance();
    }

    public function getRow($where)
    {
        $condition = [];
        if (is_array($where)) {
            foreach ($where as $k => $v) {
                $condition[] = '`' . $k . '`' . '="' . $v .'"';
            }
        } else if (is_string($where)) {
            $condition[] = $where;
        } else {
            return [];
        }

        $condition = implode(' and ', $condition);
        $sql = sprintf('select * from `%s` where %s', $this->tableName, $condition);

        return $this->db->getRow($sql);
    }

    public function getAll($where = '')
    {
        $condition = [1];
        if (is_array($where)) {
            foreach ($where as $k => $v) {
                $condition[] = '`' . $k . '`' . '="' . $v .'"';
            }
        } else if (is_string($where)) {
            $condition[] = $where;
        }

        $condition = implode(' and ', $condition);
        $sql = sprintf('select * from `%s` where %s', $this->tableName, $condition);

        return $this->db->getAll($sql);
    }

    public function insert($data)
    {
        return $this->db->insert($this->tableName, $data);
    }

}


?>