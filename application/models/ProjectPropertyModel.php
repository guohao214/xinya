<?php

class ProjectPropertyModel extends BaseModel
{

    public function setTable()
    {
        $this->table = 'project_property';
    }


    public function rules()
    {
        // 添加验证

    }

    public function getForNewUserProjectList()
    {
        $this->db->from($this->table);
        $projectTable = (new ProjectModel())->table;
        $this->db->select("{$projectTable}.*, {$this->table}.project_property_id");
        $this->db->where(array("{$projectTable}.disabled" => 0, "{$this->table}.disabled" => 0), false);
        $this->db->join($projectTable, "{$this->table}.project_id={$projectTable}.project_id");

        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * 新用户可用
     * @param int $projectId
     * @param string $openId
     * @return  bool
     */
    public function projectOnlyForNewUser($projectId, $openId)
    {
        $where = array('project_id' => $projectId, 'disabled' => 0);
        $projectProperty = (new CurdUtil($this))->readOne($where);

        // 新用户专享， 判断是否已下单
        if ($projectProperty && $projectProperty['only_for_new_user'] == 1) {
            $lastOrder = (new OrderModel())->getLastOrder($openId);
            return ($lastOrder) ? true : false;
        }

        return false;
    }
}