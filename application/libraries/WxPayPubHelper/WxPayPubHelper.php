<?php

include_once("SDKRuntimeException.php");

/**
 * 所有接口的基类
 */
class Common_util_pub
{
    public $weixin;
    public function __construct($weixin)
    {
        $this->weixin = $weixin;
    }

    function trimString($value)
    {
        $ret = null;
        if (null != $value) {
            $ret = $value;
            if (strlen($ret) == 0) {
                $ret = null;
            }
        }
        return $ret;
    }

    /**
     *    作用：产生随机字符串，不长于32位
     */
    public function createNoncestr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     *    作用：格式化参数，签名过程需要使用
     */
    function formatBizQueryParaMap($paraMap, $urlencode)
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if ($urlencode) {
                $v = urlencode($v);
            }
            //$buff .= strtolower($k) . "=" . $v . "&";
            $buff .= $k . "=" . $v . "&";
        }
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }

    /**
     *    作用：生成签名
     */
    public function getSign($Obj)
    {
        foreach ($Obj as $k => $v) {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters, false);
        //echo '【string1】'.$String.'</br>';
        //签名步骤二：在string后加入KEY
        $String = $String . "&key=" . $this->weixin->apiKey;
        //echo "【string2】".$String."</br>";
        //签名步骤三：MD5加密
        $String = md5($String);
        //echo "【string3】 ".$String."</br>";
        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        //echo "【result】 ".$result_."</br>";
        return $result_;
    }

    /**
     *    作用：array转xml
     */
    function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";

            } else
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
        $xml .= "</xml>";
        return $xml;
    }

    /**
     *    作用：将xml转为array
     */
    public function xmlToArray($xml)
    {
        //将XML转为array        
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array_data;
    }

    /**
     *    作用：以post方式提交xml到对应的接口url
     */
    public function postXmlCurl($xml, $url, $second = 30)
    {
        //初始化curl        
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOP_TIMEOUT, $second);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        curl_close($ch);
        //返回结果
        if ($data) {
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            echo "curl出错，错误码:$error" . "<br>";
            curl_close($ch);
            return false;
        }
    }

    /**
     *    作用：使用证书，以post方式提交xml到对应的接口url
     */
    function postXmlSSLCurl($xml, $url, $second = 30)
    {
        $ch = curl_init();
        //超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //设置证书
        //使用证书：cert 与 key 分别属于两个.pem文件
        //默认格式为PEM，可以注释
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_SSLCERT, WxPayConf_pub::SSLCERT_PATH);
        //默认格式为PEM，可以注释
        curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_SSLKEY, WxPayConf_pub::SSLKEY_PATH);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        $data = curl_exec($ch);
        //返回结果
        if ($data) {
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            echo "curl出错，错误码:$error" . "<br>";
            curl_close($ch);
            return false;
        }
    }

}

/**
 * 请求型接口的基类
 */
abstract class Wxpay_client_pub extends Common_util_pub
{
    var $parameters;//请求参数，类型为关联数组
    public $response;//微信返回的响应
    public $result;//返回参数，类型为关联数组
    public $url;//接口链接
    public $curl_timeout;//curl超时时间

    /**
     *    作用：设置请求参数
     */
    function setParameter($parameter, $parameterValue)
    {
        $this->parameters[$this->trimString($parameter)] = $this->trimString($parameterValue);
    }

    /**
     *    作用：设置标配的请求参数，生成签名，生成接口参数xml
     */
    function createXml()
    {
        $this->parameters["appid"] = $this->weixin->appId;//公众账号ID
        $this->parameters["mch_id"] = $this->weixin->mchId;//商户号
        $this->parameters["nonce_str"] = $this->createNoncestr();//随机字符串
        $this->parameters["sign"] = $this->getSign($this->parameters, $this->weixin->apiKey);//签名
        return $this->arrayToXml($this->parameters);
    }

    /**
     *    作用：post请求xml
     */
    function postXml()
    {
        $xml = $this->createXml();
        $this->response = $this->postXmlCurl($xml, $this->url, $this->curl_timeout);
        return $this->response;
    }

    /**
     *    作用：使用证书post请求xml
     */
    function postXmlSSL()
    {
        $xml = $this->createXml();
        $this->response = $this->postXmlSSLCurl($xml, $this->url, $this->curl_timeout);
        return $this->response;
    }

    /**
     *    作用：获取结果，默认不使用证书
     */
    function getResult()
    {
        $this->postXml();
        $this->result = $this->xmlToArray($this->response);
        return $this->result;
    }
}


/**
 * 统一支付接口类
 */
class UnifiedOrder_pub extends Wxpay_client_pub
{

    function __construct($weixin)
    {
        //设置接口链接
        $this->url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
        //设置curl超时时间
        $this->curl_timeout = 15;

        parent::__construct($weixin);
    }

    /**
     * 生成接口参数xml
     */
    function createXml()
    {
        try {
            //检测必填参数
            if ($this->parameters["out_trade_no"] == null) {
                throw new SDKRuntimeException("缺少统一支付接口必填参数out_trade_no！" . "<br>");
            } elseif ($this->parameters["body"] == null) {
                throw new SDKRuntimeException("缺少统一支付接口必填参数body！" . "<br>");
            } elseif ($this->parameters["total_fee"] == null) {
                throw new SDKRuntimeException("缺少统一支付接口必填参数total_fee！" . "<br>");
            } elseif ($this->parameters["notify_url"] == null) {
                throw new SDKRuntimeException("缺少统一支付接口必填参数notify_url！" . "<br>");
            } elseif ($this->parameters["trade_type"] == null) {
                throw new SDKRuntimeException("缺少统一支付接口必填参数trade_type！" . "<br>");
            } elseif ($this->parameters["trade_type"] == "JSAPI" &&
                $this->parameters["openid"] == NULL
            ) {
                throw new SDKRuntimeException("统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！" . "<br>");
            }
            $this->parameters["appid"] = $this->weixin->appId;//公众账号ID
            $this->parameters["mch_id"] = $this->weixin->mchId;//商户号
            $this->parameters["spbill_create_ip"] = $_SERVER['REMOTE_ADDR'];//终端ip
            $this->parameters["nonce_str"] = $this->createNoncestr();//随机字符串
            $this->parameters["sign"] = $this->getSign($this->parameters, $this->weixin->apiKey);//签名
            return $this->arrayToXml($this->parameters);
        } catch (SDKRuntimeException $e) {
            die($e->getMessage());
        }
    }

    /**
     * 获取prepay_id
     */
    function getPrepayId()
    {
        $this->postXml();
        $this->result = $this->xmlToArray($this->response);
        $prepay_id = $this->result["prepay_id"];
        return $prepay_id;
    }

}


/**
 * 响应型接口基类
 */
abstract class Wxpay_server_pub extends Common_util_pub
{
    public $data;//接收到的数据，类型为关联数组
    public $returnParameters;//返回参数，类型为关联数组

    /**
     * 将微信的请求xml转换成关联数组，以方便数据处理
     */
    function saveData($xml)
    {
        $this->data = $this->xmlToArray($xml);
    }

    function checkSign()
    {
        $tmpData = $this->data;
        unset($tmpData['sign']);
        $sign = $this->getSign($tmpData);//本地签名
        if ($this->data['sign'] == $sign) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * 获取微信的请求数据
     */
    function getData()
    {
        return $this->data;
    }

    /**
     * 设置返回微信的xml数据
     */
    function setReturnParameter($parameter, $parameterValue)
    {
        $this->returnParameters[$this->trimString($parameter)] = $this->trimString($parameterValue);
    }

    /**
     * 生成接口参数xml
     */
    function createXml()
    {
        return $this->arrayToXml($this->returnParameters);
    }

    /**
     * 将xml数据返回微信
     */
    function returnXml()
    {
        $returnXml = $this->createXml();
        return $returnXml;
    }
}


/**
 * 通用通知接口
 */
class Notify_pub extends Wxpay_server_pub
{

    public function __construct($weixin)
    {
        parent::__construct($weixin);
    }
}
