<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2016/4/6
 * Time: 23:04
 */
class ProjectRelationModel extends BaseModel
{
    public function setTable()
    {
        $this->table = 'project_relation';
    }

    public function getAllRelationProjects($mainProjectId)
    {
        $sql = "select project_id, project_name, relation_project_id,specification,main_project_id from project_relation left join project on
              project_relation.relation_project_id=project.project_id
              where project_relation.main_project_id={$mainProjectId}";

        return (new CurdUtil($this))->query($sql);
    }
}