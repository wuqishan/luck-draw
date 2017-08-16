<?php

namespace Model;

class UserModel extends Model
{
    protected $tableName = 'user';
    protected $primaryKey = 'id';

    public function getUser($phone_number)
    {
        $phone_number = $this->checkPhoneNumber($phone_number);



        return [];
    }


    protected function checkPhoneNumber($phone_number)
    {
        $result = ['right' => [], 'error' => []];
        $phone_number = (array)explode(',', $phone_number);

        foreach ($phone_number as $v) {
            $v = trim($v);
            if (preg_match('/^1\d{10}$/', $v)) {
                $result['right'][] = $v;
            } else {
                $result['error'][] = $v;
            }
        }

        return $result;
    }
}


?>