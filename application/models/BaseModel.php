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
    private $cacheTime = 604800;

    public function __construct()
    {
        parent::__construct();
        $this->load->driver('cache', array('adapter' => 'file', 'backup' => 'file',
        'key_prefix' => '__xinya_cache'));

        $this->setTable();

        $this->load->database();
    }

    public function setCache($key, $value)
    {
        $this->cache->save($key, $value, $this->cacheTime);
    }

    public function getCache($key)
    {
        return $this->cache->get($key);
    }

    public function deleteCache($key)
    {
        return $this->cache->delete($key);
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