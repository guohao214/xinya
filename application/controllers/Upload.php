<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-12-14
 * Time: 下午5:15
 */

class Upload extends FrontendController
{
    public function up()
    {
//        $this->load->helper('form');
//        $this->view('upload');
//
//
//        $pagination = new PaginationUtil(300);
//        echo $pagination->pagination();

        $_POST = array(
            'category_name' => time().rand(),
            'create_time' => date('Y-m-d H:i:s')
        );

        $post = RequestUtil::postParams();

        $this->load->model('Category', 'category');

        $curd = new CurdUtil($this->category);

        var_dump($curd->create($post));

    }

    public function delete($id)
    {
        $this->load->model('Category', 'category');
        $curd = new CurdUtil($this->category);

        var_dump($curd->delete(array('category_id' => $id)));
    }
} 