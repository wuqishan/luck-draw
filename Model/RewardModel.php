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

        // 初始化表格,准备重新录入
        $this->initTable();

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

    public function getRewardInfo()
    {
        $result = ['grade_number_1' => 0, 'grade_number_2' => 0, 'grade_number_3' => 0];
        $allReward = parent::getAll();
        $result['total_number'] = count($allReward);

        foreach ($allReward as $v) {
            $v['grade'] == 1 && $result['grade_number_1']++;
            $v['grade'] == 2 && $result['grade_number_2']++;
            $v['grade'] == 3 && $result['grade_number_3']++;
        }

        return $result;
    }
}


?>