<?php

namespace Model;

class UserModel extends Model
{
    protected $tableName = 'user';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function addUser($phone_number)
    {
        $phone_number = $this->checkPhoneNumber($phone_number);

        if (count($phone_number['right']) > 0) {
            foreach ($phone_number['right'] as $v) {
                if (! $this->getRow(['phone_number' => $v])) {
                    $this->insert(['phone_number' => $v]);
                }
            }
        }

        return $phone_number;
    }

    public function delUser($phone_number, $del_type)
    {
        $result = [];
        if ($del_type === 'init') {
            $result = $this->initTable();
        } else {
            $result = $this->checkPhoneNumber($phone_number);
            $this->delete(['phone_number' => $result['right']]);
        }

        return $result;
    }

    protected function checkPhoneNumber($phone_number)
    {
        $result = ['right' => [], 'wrong' => []];
        $phone_number = (array)explode(',', $phone_number);
        $phone_number = array_filter($phone_number);

        foreach ($phone_number as $v) {
            $v = trim($v);
            if (preg_match('/^1\d{10}$/', $v)) {
                $result['right'][] = $v;
            } else {
                $result['wrong'][] = $v;
            }
        }

        return $result;
    }

    public function getAllUser()
    {
        $result = parent::getAll();
        $result2 = [];
        foreach ($result as $v) {
            array_push($result2, $v['phone_number']);
        }

        return $result2;
    }

    public function getAll($where = '')
    {
        return parent::getAll($where);
    }
}


?>