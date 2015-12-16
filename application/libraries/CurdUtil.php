<?php

/**
 * 操作简单的CURD的
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-16
 * Time: 下午3:45
 */
class CurdUtil
{
    private $model;
    private $instance;
    private $table;
    
    public function __construct(CI_Model $model)
    {
        $this->model = $model;
        $this->table = $this->model->table;
        $this->instance = get_instance();

        $this->instance->load->database();
    }

    /**
     * 从post里取数据，并过滤
     */
    public function create($post = array())
    {
        $this->model->beforeInsert();
        $this->instance->db->insert($this->table, $post);
        $this->model->afterInsert();

        return $this->instance->db->insert_id();
    }

    /**
     * 从post里取
     */
    public function update($where = array(), $post = array())
    {
        if (empty($where))
            return false;

        $this->instance->db->where(array());
        $this->instance->db->where($where);

        $this->model->beforeUpdate();
        $this->instance->db->update($this->table, $post);
        $this->model->afterUpdate();

        return $this->instance->db->affected_rows();
    }

    /**
     * 从get里取
     */
    public function readOne($get = array())
    {
        $this->model->beforeRead();
        $query = $this->instance->db->get_where($this->table, $get);
        $this->model->afterRead();

        return $query;
    }

    public function readAll($get, $limit, $config = 'pagination')
    {
        $pagination = ConfigUtil::loadConfig($config);
        $offset = $pagination['per_page'];

        $this->model->beforeRead();
        $query = $this->instance->db->get_where($this->table, $get, $limit, $offset);
        $this->model->afterRead();

        return $query;
    }

    public function count($get = array())
    {
        $this->instance->db->where(array());

        $this->instance->db->where($get);
        return $this->instance->db->count_all_results();
    }

    /**
     * 从get里取
     */
    public function delete($get = array())
    {
        $this->model->beforeDelete();
        $this->instance->db->delete($this->table, $get);
        $this->model->afterDelete();

        return $this->instance->db->affected_rows();
    }
} 