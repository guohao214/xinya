<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-15
 * Time: 上午10:01
 */
class ValidateUtil
{
    private $controller;

    public function __construct()
    {
        $this->controller = get_instance();
        $this->controller->load->library('form_validation');
    }

    /**
     * 必填验证
     * @param $attribute
     * @param $label
     */
    public function required($attribute, $label = '')
    {
        $this->controller->form_validation->set_rules($attribute, $label, 'trim|required');
    }

    /**
     * 是否与表单中的另一元素相同
     * @param $attribute
     * @param $matchAttribute 要匹配的另一元素
     * @param $label
     */
    public function matches($attribute, $matchAttribute, $label = '')
    {
        $this->controller->form_validation->set_rules($attribute, $label, "matches[{$matchAttribute}]");
    }

    /**
     * 表单元素值在指定的表和字段中是否已存在
     * @param $attribute
     * @param $table
     * @param $field
     * @param $label
     */
    public function isUnique($attribute, $table, $field, $label = '')
    {
        $this->controller->form_validation->set_rules($attribute, $label, "is_unique[{$table}.{$field}]");
    }

    /**
     * 最小长度
     * @param $attribute
     * @param int $length
     * @param string $label
     */
    public function minLength($attribute, $length = 1, $label = '')
    {
        $this->controller->form_validation->set_rules($attribute, $label, "min_length[{$length}]");
    }

    /**
     * 最大长度
     * @param $attribute
     * @param int $length
     * @param string $label
     */
    public function maxLength($attribute, $length = 1, $label = '')
    {
        $this->controller->form_validation->set_rules($attribute, $label, "max_length[{$length}]");
    }

    /**
     * 如果表单元素值包含除数字以外的字符，返回 FALSE
     * @param $attribute
     * @param string $label
     */
    public function numeric($attribute, $label = '')
    {
        $this->controller->form_validation->set_rules($attribute, $label, 'numeric');
    }

    /**
     * 如果表单元素包含除整数以外的字符，返回 FALSE
     * @param $attribute
     * @param string $label
     */
    public function integer($attribute, $label = '')
    {
        $this->controller->form_validation->set_rules($attribute, $label, 'integer');
    }

    /**
     * 验证邮箱
     * @param $attribute
     * @param string $label
     */
    public function email($attribute, $label = '')
    {
        $this->controller->form_validation->set_rules($attribute, $label, 'valid_email');
    }

    /**
     * 验证URL
     * @param $attribute
     * @param string $label
     */
    public function url($attribute, $label = '')
    {
        $this->controller->form_validation->set_rules($attribute, $label, 'valid_url');
    }

    /**
     * 验证IP地址
     * @param $attribute
     * @param string $label
     */
    public function ip($attribute, $label = '')
    {
        $this->controller->form_validation->set_rules($attribute, $label, 'valid_ip');
    }


    /**
     * 验证
     * @return mixed
     */
    public function run()
    {
        return $this->controller->form_validation->run();
    }
} 