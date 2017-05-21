<?php

class Manage extends BackendController
{
  /**
   * 订单提醒
   */
  public function weChatOrderRemind()
  {
    set_time_limit(120);

    // 获得所有订单
    $date = date('Y-m-d', time());
    $tomorrow = date('Y-m-d', strtotime("{$date}+1 day"));
    $where = array(
      'appointment_day' => $tomorrow,
      'order_status' => OrderModel::ORDER_PAYED
    );

    $curdUtil = new CurdUtil(new OrderModel());
    $orders = $curdUtil->readAll('order_id desc', $where);
    var_dump($orders);
    // 获得access_token
    $wechat = new WeixinUtil();
    $accessToken = $wechat->getToken();

    $message = array();

    foreach ($orders as $order) {
      $message = array(
        "touser" => $order['open_id'],
        "template_id" => "l62F-ewHevL8esn_9jRsJsrDLwAGly32Y-8w5DkFHJM",
        "url" => UrlUtil::createUrl('userCenter/order'),
        "topcolor" => "#FF0000",
        "data" => array(
          "first" => array( //描述
            "value" => "您好，谢谢购买不期而遇美容商品（测试）",
            "color" => "#FF8CB3"
          ),

          "keyword1" => array(
            "value" => "尊敬的顾客",
            "color" => "#173177"
          ),

          "keyword2" => array(
            "value" => $order['appointment_day'],
            'color' => "#173177"
          ),

          "keyword3" => array(
            "value" => '金海路',
            'color' => "#173177"
          ),

          "keyword4" => array(
            "value" => '小敏',
            'color' => "#173177"
          ),

          "keyword5" => array(
            "value" => '臀疗',
            'color' => "#173177"
          ),

          "remark" => array( //备注
            "value" => "请合理安排您的时间, 有疑问请联系： 021-50809608",
            "color" => "#c9151b"
          )
        )
      );
      $wechat->templateMessage($message, $accessToken);
    }

    // 发送模板消息
  }
}