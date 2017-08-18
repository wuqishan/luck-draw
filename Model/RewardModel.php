<?php

namespace Model;

class RewardModel extends Model
{
    protected $tableName = 'reward';
    protected $primaryKey = 'id';

    public function initReward($init_info)
    {
        unset($init_info['type']);
        $data = array_map('intval', $init_info);

        $ifGtTotal = $data['total_number'] - ($data['grade_number_1'] + $data['grade_number_2'] + $data['grade_number_3']);
        if ($ifGtTotal <= 0 || $data['total_number'] <= 0) {
            return array();
        }

        $data['grade_number_10000'] = $ifGtTotal;
            // 初始化表格,准备重新录入
        $this->initTable();
        $this->initTable('user_reward');

        $reward = ['grade' => 0, 'away' => 0];
        if ($data['grade_number_1'] > 0) {
            for ($i = 0; $i < $data['grade_number_1']; $i++) {
                $reward['grade'] = 1;
                $this->insert($reward);
            }
        }
        if ($data['grade_number_2'] > 0) {
            for ($i = 0; $i < $data['grade_number_2']; $i++) {
                $reward['grade'] = 2;
                $this->insert($reward);
            }
        }
        if ($data['grade_number_3'] > 0) {
            for ($i = 0; $i < $data['grade_number_3']; $i++) {
                $reward['grade'] = 3;
                $this->insert($reward);
            }
        }
        for ($i = 0; $i < $ifGtTotal; $i++) {
            $reward['grade'] = 10000;    // 阳光普照为10000
            $this->insert($reward);
        }

        return $data;
    }

    public function getRewardInfo($current)
    {
        $result = ['grade_number_1' => 0, 'grade_number_2' => 0, 'grade_number_3' => 0, 'total_number' => 0, 'grade_number_10000' => 0];
        $allReward = parent::getAll();

        foreach ($allReward as $v) {

            if ($current) {
                $v['away'] == 0 && $result['total_number']++;
                $v['grade'] == 1 && $v['away'] == 0 && $result['grade_number_1']++;
                $v['grade'] == 2 && $v['away'] == 0 && $result['grade_number_2']++;
                $v['grade'] == 3 && $v['away'] == 0 && $result['grade_number_3']++;
                $v['grade'] == 10000 && $v['away'] == 0 && $result['grade_number_10000']++;
            } else {
                $result['total_number']++;
                $v['grade'] == 1 && $result['grade_number_1']++;
                $v['grade'] == 2 && $result['grade_number_2']++;
                $v['grade'] == 3 && $result['grade_number_3']++;
                $v['grade'] == 10000 && $result['grade_number_10000']++;
            }
        }

        return $result;
    }

    public function rewardDetail($grade)
    {
        $grade = intval($grade);

        $sqlPtn = 'select * from reward as r '.
            'left join user_reward as ur on r.id = ur.reward_id '.
            'left join user as u on ur.user_id = u.id where r.grade = %d and away = %d';
        $sql = sprintf($sqlPtn, $grade, 1);

        return $this->db->getAll($sql);
    }
}


?>