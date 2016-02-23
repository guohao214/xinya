<?php

/**
 * 美容师管理
 * User: GuoHao
 * Date: 2016/1/11
 * Time: 20:30
 * // array(0 => '星期天', 1 => '星期一', 2 => '星期二', 3 => '星期三', 4 => '星期四', 5 => '星期五', 6 => '星期六');
 * // 1 => 全天, 2 => 早班, 3 => 晚班, 4 => 中班, 5 => 全天休息
 */
class Beautician extends BackendController
{
    public $timeSetting;

    public function __construct()
    {
        parent::__construct();
        $this->timeSetting = array(BeauticianModel::ALL_DAY => '全天', BeauticianModel::MORNING_SHIFT => '早班',
            BeauticianModel::NIGHT_SHIFT => '晚班', BeauticianModel::MIDDAY_SHIFT => '中班',
            BeauticianModel::REST_SHIFT => '休息');

        $this->load->model('BeauticianModel', 'beauticianModel');
    }

    /**
     * 美容师列表 没有使用分页
     */
    public function index()
    {
        $timeSetting = $this->timeSetting;

        $workTime = new WorkTimeUtil();
        $where = RequestUtil::buildLikeQueryParamsWithDisabled();
        $beauticians = (new BeauticianModel())->getAllBeauticians($where);
        $shops = (new ShopModel())->getAllShops();
        $beauticianOrderCounts = (new OrderModel())->getOrderCountsByBeauticianId();
        $this->view('beautician/index', array('beauticians' => $beauticians, 'shops' => $shops,
            'params' => RequestUtil::getParams(), 'beauticianOrderCounts' => $beauticianOrderCounts,
            'timeSetting' => $timeSetting, 'workTime' => $workTime->beauticianWorkTime));
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
        $beautician_id = $this->input->get('beautician_id') + 0;
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
                    $this->message('新增请假记录成功!', 'beautician/rest?beautician_id=' . $beautician_id);
                else
                    $this->message('新增请假记录失败!', 'beautician/rest?beautician_id=' . $beautician_id);
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

    /**
     * 修改美容师工作时间
     * @param $beauticianId
     */
    public function updateBeauticianWorkTime($beauticianId)
    {
        $workTimeUtil = new WorkTimeUtil();
        $workTime = $workTimeUtil->beauticianWorkTime;

        /**
         * array (size=7)
         * 'work_type_0' => string '5' (length=1)
         * 'work_type_1' => string '2' (length=1)
         * 'work_type_2' => string '5' (length=1)
         * 'work_type_3' => string '3' (length=1)
         * 'work_type_4' => string '3' (length=1)
         * 'work_type_5' => string '2' (length=1)
         * 'work_type_6' => string '2' (length=1)
         */
        if (RequestUtil::isPost()) {
            $post = RequestUtil::postParams();
            $data = array();
            foreach($post as $key => $value) {
                if (!preg_match('~^work_type_(\d+)$~', $key, $matches)) {
                    continue;
                } else {
                    $w = $matches[1];
                    $data[$w] = $value;
                }
            }

            // 保持数据
            $workTime[$beauticianId] = $data;
            $workTimeUtil->saveBeauticianWorkTime($workTime);
        }

        $workTime = $workTimeUtil->getBeauticianWorkTime();
        $beauticianWorkTime = $workTime[$beauticianId];
        $timeSetting = $this->timeSetting;
        $beautician = (new BeauticianModel())->readOne($beauticianId);
        $this->view('beautician/updateBeauticianWorkTime',
            array('beauticianWorkTime' => $beauticianWorkTime, 'timeSetting' => $timeSetting,
                'beauticianId' => $beauticianId, 'beautician' => $beautician));
    }
}