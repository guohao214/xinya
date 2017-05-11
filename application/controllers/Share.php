<?php

/**
 * Created by PhpStorm.
 * User: GuoHao
 * Date: 2017/5/11
 * Time: 23:50
 */
class Share extends FrontendController
{
    /**
     * 分享来源
     * @return  string
     */
    public function index()
    {
        $weChat = new WeixinUtil();
        $openId = $weChat->getOpenId();

        $instance = get_instance();
        $segments = $instance->uri->segments;
        $segments = join($segments, '/');
        $url = $segments . '?' . http_build_query($_GET);

        if (!$openId)
            $weChat->authorize($url);

        // 删除
        ShareUtil::clearShareForm();

        $params = RequestUtil::getParams();
        $firstStage = $params['f'];
        $secondStage = $params['s'];
        $buyerOpenId = $params['b'];

        $shareForm = array($firstStage, $secondStage, $buyerOpenId);
        array_walk($shareForm, function (&$item) {
            if ($item)
                $item = EncryptUtil::decrypt($item);
        });
        $shareForm[] = $openId;
        $shareForm = array_filter(array_unique($shareForm));

        $count = (new CustomerModel())->findCustomer($shareForm);
        if ($count != count($shareForm))
            show_error('来源用户不存在');

        if (count($shareForm) > 3)
            array_shift($shareForm);

        ShareUtil::setShareFrom($shareForm);

        // 返回到首页
        ResponseUtil::redirect(UrlUtil::createUrl('project/index'));
    }
}