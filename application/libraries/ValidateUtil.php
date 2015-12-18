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
    public $rules;

    public function __construct()
    {
        $this->controller = get_instance();
        $this->controller->load->library('form_validation');
    }

    private function setRule($attribute, $rule)
    {
        $this->rules[$attribute][] = array('attribute' => $attribute, 'rule' => $rule);
    }

    /**
     * 必填验证
     * @param $attribute
     */
    public function required($attribute)
    {
        $this->setRule($attribute, 'trim|required');
    }

    /**
     * 是否与表单中的另一元素相同
     * @param $attribute
     * @param $matchAttribute 要匹配的另一元素
     */
    public function matches($attribute, $matchAttribute)
    {
        $this->setRule($attribute, "matches[{$matchAttribute}]");
    }

    /**
     * 表单元素值在指定的表和字段中是否已存在
     * @param $attribute
     * @param $table
     * @param $field
     */
    public function isUnique($attribute, $table, $field)
    {
        $this->setRule($attribute, "is_unique[{$table}.{$field}]");
    }

    /**
     * 最小长度
     * @param $attribute
     * @param int $length
     */
    public function minLength($attribute, $length = 1)
    {
        $this->setRule($attribute, "min_length[{$length}]");
    }

    /**
     * 最大长度
     * @param $attribute
     * @param int $length
     */
    public function maxLength($attribute, $length = 1)
    {
        $this->setRule($attribute, "max_length[{$length}]");
    }

    /**
     * 如果表单元素值包含除数字以外的字符，返回 FALSE
     * @param $attribute
     */
    public function numeric($attribute)
    {
        $this->setRule($attribute, 'numeric');
    }

    /**
     * 如果表单元素包含除整数以外的字符，返回 FALSE
     * @param $attribute
     */
    public function integer($attribute)
    {
        $this->setRule($attribute, 'integer');
    }

    /**
     * 验证邮箱
     * @param $attribute
     */
    public function email($attribute)
    {
        $this->setRule($attribute, 'valid_email');
    }

    /**
     * 验证URL
     * @param $attribute
     */
    public function url($attribute)
    {
        $this->setRule($attribute, 'valid_url');
    }

    /**
     * 验证IP地址
     * @param $attribute
     */
    public function ip($attribute)
    {
        $this->setRule($attribute, 'valid_ip');
    }


    /**
     * 验证
     * @return mixed
     */
    public function run()
    {
        $this->setValidationRules();

        return $this->controller->form_validation->run();
    }

    public function setValidationRules()
    {
        foreach ($this->rules as $key => $rules) {
            $ruleList = array();
            foreach ($rules as $rule) {
                array_push($ruleList, $rule['rule']);
            }

            $this->controller->form_validation->set_rules($key, '', implode('|', $ruleList));

        }
    }
} 