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

    private $db;

    public function __construct(CI_Model $model)
    {
        $this->model = $model;
        $this->table = $this->model->table;
        $this->instance = get_instance();
        $this->instance->load->database();
        $this->db = $this->instance->db;
    }


    public function create($data = array())
    {
        $this->model->beforeInsert();
        $this->db->insert($this->table, $data);
        $this->model->afterInsert();

        return $this->db->insert_id();
    }


    public function update($where = array(), $data = array())
    {
        if (empty($where))
            return false;

        $this->db->where($where);

        $this->model->beforeUpdate();
        $this->db->update($this->table, $data);
        $this->model->afterUpdate();

        return $this->db->affected_rows();
    }


    public function readOne($where = array())
    {
        if (empty($where))
            $where = '1=1';

        $this->model->beforeRead();
        $query = $this->db->get_where($this->table, $where);
        $this->model->afterRead();

        return $this->result($query);
    }

    public function readAll($order = '', $where = array())
    {
        if (!empty($order))
            $this->db->order_by($order);

        if (!empty($where))
            $this->db->where($where);

        return $this->result($this->db->get($this->table));
    }

    public function readLimit($where, $limit = '', $config = 'pagination')
    {
        if (!$limit)
            $limit = 0;

        if (empty($where))
            $where = '1=1';

        $pagination = ConfigUtil::loadConfig($config);
        $offset = $pagination['per_page'];

        $this->model->beforeRead();
        $query = $this->db->get_where($this->table, $where, $offset, $limit);
        $this->model->afterRead();

        return $this->result($query);
    }

    public function count($where = array())
    {
        if (empty($where))
            $where = '1=1';

        $this->db->where($where);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    public function delete($where = array())
    {
        $this->model->beforeDelete();
        $this->db->delete($this->table, $where);
        $this->model->afterDelete();

        return $this->db->affected_rows();
    }

    protected function result($query)
    {
        return $query->result_array();
    }
} 