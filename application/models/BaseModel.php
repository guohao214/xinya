<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-16
 * Time: 下午4:47
 */
abstract class BaseModel extends CI_Model
{
    public $table;

    public function __construct()
    {
        parent::__construct();
        $this->setTable();

        $this->load->database();
    }

    abstract public function setTable();

    public function beforeInsert()
    {
        return true;
    }

    public function afterInsert()
    {
        return true;
    }

    public function beforeRead()
    {
        return true;
    }

    public function afterRead()
    {
        return true;
    }

    public function beforeUpdate()
    {
        return true;
    }

    public function afterUpdate()
    {
        return true;
    }

    public function beforeDelete()
    {
        return true;
    }

    public function afterDelete()
    {
        return true;
    }
}