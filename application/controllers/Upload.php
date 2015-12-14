<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-14
 * Time: 下午5:15
 */

class Upload extends FrontController
{
    public function up()
    {
        $this->load->helper('form');
        $this->view('upload');
    }
} 