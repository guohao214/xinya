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

    $orders = (new OrderModel())->getOrder( $where, 2);
    // 获得access_token
    $wechat = new WeixinUtil();
    $accessToken = $wechat->getToken();

    foreach ($orders as $order) {
      $message = array(
        "touser" => $order['open_id'],
        "template_id" => "OidPNNdf1SNAXWDSY7rwMhZwp-rFooV6f6JrK425P7c",
        "url" => UrlUtil::createUrl('userCenter/order'),
        "topcolor" => "#FF0000",
        "data" => array(
          "first" => array( //描述
            "value" => "您好，您预约的服务时间即将到期",
            "color" => "#000000"
          ),

          "keyword1" => array(
            "value" => $order['user_name'],
            "color" => "#173177"
          ),

          "keyword2" => array(
            "value" => $order['phone_number'],
            'color' => "#173177"
          ),

          "keyword3" => array(
            "value" => $order['beautician_name'],
            'color' => "#173177"
          ),

          "keyword4" => array(
            "value" => $order['appointment_day'] . ' '. $order['appointment_start_time'] . '~'. $order['appointment_end_time'],
            'color' => "#173177"
          ),

          "remark" => array( //备注
            "value" => "请提前10分钟到店, 有疑问请联系： 021-50809608",
            "color" => "#FF8CB3"
          )
        )
      );

      // 发送模板消息
      $wechat->templateMessage($message, $accessToken);
    }

    $this->message('共发送<label style="padding:0 5px; color:red">' . count($orders) . '</label>条预约到期提醒');
  }
}