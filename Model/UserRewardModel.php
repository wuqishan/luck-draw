<?php

namespace Model;

class UserRewardModel extends Model
{
    protected $tableName = 'user_reward';
    protected $primaryKey = 'id';

    public function getAll($where = '')
    {
        return parent::getAll($where);
    }
}


?>