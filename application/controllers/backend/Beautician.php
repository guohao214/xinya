<?php

/**
 * 美容师管理
 * User: GuoHao
 * Date: 2016/1/11
 * Time: 20:30
 */
class Beautician extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BeauticianModel', 'beauticianModel');
    }

    /**
     * 美容师列表 没有使用分页
     */
    public function index()
    {

        $where = RequestUtil::buildLikeQueryParamsWithDisabled();
        $beauticians = (new BeauticianModel())->getAllBeauticians($where);
        $shops = (new ShopModel())->getAllShops();
        $beauticianOrderCounts = (new OrderModel())->getOrderCountsByBeauticianId();
        $this->view('beautician/index', array('beauticians' => $beauticians, 'shops' => $shops,
            'params' => RequestUtil::getParams(), 'beauticianOrderCounts' => $beauticianOrderCounts));
    }

    public function addBeautician()
    {
        if (RequestUtil::isPost()) {
            if ($this->beauticianModel->rules()->run()) {
                $params = RequestUtil::postParams();

                $params['avatar'] = UploadUtil::commonUpload(array('upload/resize_200x200',
                    'upload/resize_350x350', 'upload/resize_100x100'));

                $insertId = (new CurdUtil($this->beauticianModel))->
                create(array_merge($params, array('create_time' => DateUtil::now())));

                if ($insertId)
                    $this->message('新增美容师成功!', 'beautician/index');
                else
                    $this->message('新增美容师失败!', 'beautician/index');
            }

        }

        $this->view('beautician/addBeautician');
    }

    /**
     * 修改 美容师
     * @param $beautician_id
     */
    public function updateBeautician($beautician_id)
    {
        if (RequestUtil::isPost()) {
            if ($this->beauticianModel->rules()->run()) {
                $params = RequestUtil::postParams();
                $upload = UploadUtil::commonUpload(array('upload/resize_200x200',
                    'upload/resize_350x350', 'upload/resize_100x100'));

                if ($upload)
                    $params['avatar'] = $upload;

                if ((new CurdUtil($this->beauticianModel))->update(array('beautician_id' => $beautician_id), $params))
                    $this->message('修改美容师信息成功!', 'beautician/updateBeautician/' . $beautician_id);
                else
                    $this->message('修改美容师信失败!', 'beautician/updateBeautician/' . $beautician_id);
            }

        }

        $beautician = $this->beauticianModel->readOne($beautician_id);

        if (!$beautician)
            $this->message('美容师不存在！', 'beautician/index');

        $this->view('beautician/updateBeautician', array('beautician' => $beautician, 'selectShop' => $beautician['shop_id']));
    }

    public function deleteBeautician($beautician_id)
    {
        if (!$beautician_id)
            $this->message('要删除的美容师ID不能为空！');

        if ((new CurdUtil($this->beauticianModel))->update(array('beautician_id' => $beautician_id), array('disabled' => 1)))
            $this->message('删除美容师成功！', 'beautician/index');
        else
            $this->message('删除美容师失败！', 'beautician/index');
    }

    /**
     * 请假记录
     * @param $beautiian_id
     */
    public function rest($limit = 0)
    {
        $beautician_id = $this->input->get('beautician_id')+0;
        $where = array('beautician_id' => $beautician_id, 'disabled' => 0);
        $beautician = (new BeauticianModel())->readOne($beautician_id);
        if (!$beautician)
            $this->message('美容师记录不存在!');

        $beauticianRestModel = new BeauticianRestModel();

        $beauticianRests = (new CurdUtil($beauticianRestModel))->readLimit($where, $limit, 'beautician_rest_id desc');
        $beauticianRestCount = (new CurdUtil($beauticianRestModel))->count($where);

        $pages = new PaginationUtil($beauticianRestCount);

        $this->view('beautician/rest', array('beauticianRests' => $beauticianRests,
            'pages' => $pages->pagination(), 'beautician_id' => $beautician_id, 'beautician' => $beautician));
    }

    public function addBeauticianRest($beautician_id)
    {
        $beautician = (new BeauticianModel())->readOne($beautician_id);
        if (!$beautician)
            $this->message('美容师记录不存在!');


        $beauticianRestModel = new BeauticianRestModel();

        if (RequestUtil::isPost()) {
            if ($beauticianRestModel->rules()->run()) {
                $params = RequestUtil::postParams();

                $insertId = (new CurdUtil($beauticianRestModel))->
                create(array_merge($params, array('create_time' => DateUtil::now())));

                if ($insertId)
                    $this->message('新增请假记录成功!', 'beautician/rest?beautician_id='. $beautician_id);
                else
                    $this->message('新增请假记录失败!', 'beautician/rest?beautician_id='. $beautician_id);
            }

        }


        $this->view('beautician/addBeauticianRest', array('beautician_id' => $beautician_id, 'beautician' => $beautician));
    }


    public function deleteBeauticianRest($beautician_rest_id)
    {
        if (!$beautician_rest_id)
            $this->message('要删除的请假记录不能为空！');

        if ((new CurdUtil(new BeauticianRestModel()))->update(array('beautician_rest_id' => $beautician_rest_id), array('disabled' => 1)))
            $this->message('删除请假记录成功！');
        else
            $this->message('删除请假记录失败！');
    }


}