<?php

/**
 * 创客申请管理
 * User: GuoHao
 * Date: 2017/5/11
 * Time: 0:00
 */
class Makers extends BackendController
{
    public function index($offset = 0)
    {
        $makers = (new MakerModel())->getList($offset);
        $pages = (new PaginationUtil($makers['count']))->pagination();

        $status = array(
            '申请中',
            '通过申请',
            '拒绝申请'
        );

        $this->view('makers/index', array('makers' => $makers['list'], 'pages' => $pages,
            'params' => RequestUtil::getParams(),  'limit' => $offset, 'status' => $status));
    }

    public function pass()
    {
        $params = RequestUtil::getParams();
        $id = $params['id'];

        $data = array('status' => 1);

        if ((new CurdUtil(new MakerModel()))->update(array('maker_id' => $id), $data))
            $this->message('操作成功');
        else
            $this->message('操作失败');
    }


    public function reject()
    {
        $params = RequestUtil::getParams();
        $id = $params['id'];

        $data = array('status' => 2);

        if ((new CurdUtil(new MakerModel()))->update(array('maker_id' => $id), $data))
            $this->message('操作成功');
        else
            $this->message('操作失败');
    }
}