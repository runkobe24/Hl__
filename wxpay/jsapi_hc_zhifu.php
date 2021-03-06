<?php
ini_set('date.timezone','Asia/Shanghai');
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";

require_once '../lib/WxPay.Notify.php';
class PayNotifyCallBack extends WxPayNotify
{
	function request_get($url = '', $get_data = array()) {
        if (empty($url) || empty($get_data)) {
            return false;
        }

        $o = "";
        foreach ($get_data as $k => $v) {
            $o.= "$k=" . urlencode($v) . "&";
        }
        $get_data = substr($o, 0, -1);

        $postUrl = $url . '?' . $get_data;
        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, $postUrl); //抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
        $data = curl_exec($ch); //运行curl
        curl_close($ch);

        return $data;
    }
	
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);

				
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
	
			$fukuanshijian = $result["time_end"];
			$out_trade_no = $result["out_trade_no"];
			$total_fee = $result["total_fee"];
			$url = "http://m.bibi321.com/hl/index.php/app/db/trainorder/create19yiorder";
			$get_data["fukuanshijian"] = $fukuanshijian;
			$get_data["out_trade_no"] = $out_trade_no;
			$get_data["total_fee"] = $total_fee;
			$this->request_get($url, $get_data);
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		//Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		return true;
	}
}

$notify = new PayNotifyCallBack();
$notify->Handle(false);

$ps = $_GET['ps'];
$cs = json_decode(urldecode($ps));
$leixing = 'hc';
$mydata = date("YmdHis");
$dingdanid = $cs->dingdanid;
$dingdanhao = $leixing.$mydata.$dingdanid;
	 
if(!empty($cs) && !empty($cs->total_fee) && $cs->total_fee > 0)
{
//①、获取用户openid
$tools = new JsApiPay();
$openId = $tools->GetOpenid();

//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody($cs->body);
$input->SetAttach($cs->attach);
//$input->SetOut_trade_no($leixing.WxPayConfig::MCHID.$mydata.$count);
$input->SetOut_trade_no($dingdanhao);
$input->SetTotal_fee($cs->total_fee  * 100);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 6000));
$input->SetGoods_tag($cs->goods_tag);
$input->SetNotify_url("http://m.bibi321.com/hl/wxpay/jsapi_hc_zhifu.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);

$jsApiParameters = $tools->GetJsApiParameters($order);

}

?>

<!DOCTYPE html>
<html ng-app="trainApp">
    <head>
        <title>火车票-微信支付</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width"/>
        <link href='http://m.bibi321.com/hl/lib/ionic/css/ionic.min.css' rel="stylesheet"/>
        <script src='http://m.bibi321.com/hl/lib/jquery/jquery.min.js'></script>
        <script src='http://m.bibi321.com/hl/lib/ionic/js/ionic.bundle.min.js'></script>
        
		<script src='http://m.bibi321.com/hl/js/services.js'></script>
        <script src='http://m.bibi321.com/hl/js/publicJS.js'></script>
		
		<link href='http://m.bibi321.com/hl/css/common.css' rel="stylesheet"/>
        <link href='http://m.bibi321.com/hl/css/index.css' rel="stylesheet"/>

        <link type="text/css" href='http://m.bibi321.com/hl/css/publicCss1.css' rel="stylesheet" />
        <link type="text/css" href='http://m.bibi321.com/hl/css/trainList.css' rel="stylesheet"/>
        <link type="text/css" href='http://m.bibi321.com/hl/css/trainOrder.css' rel="stylesheet"/>
        <link href='http://m.bibi321.com/hl/css/layout.css' rel="stylesheet"/>
        <style type="text/css">
            .user_type{
                width: auto;
                border-radius: 0.1rem;
                border: 1px solid #27adff;
                padding: 0 0.15rem;
                color: #27adff;
                margin-left: 0.4rem;
            }
        </style>
    </head>
    <body ng-controller="Train_WXPayCtrl">
    <ion-header-bar align-title="center" class="bar-positive bar bar-header disable-user-behavior" style="width:100%;padding:0;">
        <div style="width:100%;height:44px;line-height: 44px;text-align: center;color:#fff;background-color: #387ef5">
            <a class="returnbut c_fff" style="font-size: 1.6rem;" ng-click="retunurl();"><span></span>返回</a>
            <span style="font-size: 1.6rem;">火车票-微信支付</span>
        </div>
    </ion-header-bar>
	<ion-header-bar align-title="center" class="bar-subheader" style="width:100%;padding:0;height:auto;border: none;">
        <div class="paneBox border_b_1_e9 bg_fff7dc f_s13 c_987b4d text_a_c pt_100 pb_100">
            请在订单有效期内完成支付，还剩
            <span class="c_ff6d6d ng-binding" ng-bind="minute"></span>
            分
            <span class="c_ff6d6d ng-binding" ng-bind="second"></span>
            秒
        </div>
    </ion-header-bar>
    <ion-content style="width:100%;padding-top:0.6rem;">
        <div class="fliTimenbox pt_35" style="border-top: 1px solid #c9c9c9;">
            <div class="toFliTime pb_100">
                <span class="wid35 fl text_a_c f_s15" ng-bind="orderDetail.from_station"></span>
                <span class="wid30 fl text_a_c">
                    <p class="maxIcon pl_150 pr_150" ng-bind="orderDetail.train_code"></p>
                    <p class="maxIcon pl_150 pr_150"><img src='http://m.bibi321.com/hl/resources/air/image/fdfdv.png'></p>
                    <p class="maxIcon pl_150 pr_150" ng-bind="orderDetail.seat_Name"></p>
                </span>
                <span class="wid35 fr text_a_c f_s15" ng-bind="orderDetail.arrive_station"></span>
            </div>
            <div class="toFliTime mt_100 pt_100">
                <span class="wid40 fl text_a_c f_s16" ng-bind="orderDetail.depTime"></span>
                <span class="wid40 fr text_a_c f_s16" ng-bind="orderDetail.arrTime"></span>
            </div>
        </div>
        <div class="passengerInfo" style="border-top: 1px solid #c9c9c9;padding-top: 0.6rem;">
            <div class="row">
                <div class="column">乘车人：</div>
                <div class="column">
                    <ul>
                        <li ng-repeat="x in ticketInfo">
                            <div class="userName">
                                <span ng-bind="x.user_name"></span>
                                <span class="user_type" ng_show="x.ticket_type == '0'">成人票</span>
                                <span class="user_type" ng_show="x.ticket_type == '1'">儿童票</span>
                            </div>
                            <div class="cardNumber">
                                <span ng-bind="x.identityName + '：'"></span>
                                <span ng-bind="x.user_ids"></span>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </ion-content>
    <ion-footer-bar align-title="center" class="bar-positive bar bar-footer" style="height: 3.8rem;line-height: 3rem;padding: 0.4rem;background-color:#387ef5;border-color: #387ef5;">
        <div class="c_fff" style="width:100%;">
		    <span id="hid" style="display:none;"><?php echo $dingdanhao;?></span>
            <span class="f_s18">订单总额:<span class="c_ff6d6d ng-binding">￥<span ng-bind="orderDetail.pay_money"></span></span></span>
            <input id="btn_ziying_zhifu" class="bg_ff6d6d c_fff f_s18 tomaiby fr ml_100" ng-click="zhifu()" type="button" value="支付">
        </div>
    </ion-footer-bar>
</body>
<script type="text/javascript">

            function objtops(obj)
            {
                var p = [];
                for (var key in obj) {
                    p.push(key + '=' + encodeURIComponent(obj[key]));
                }
                return p.join('&');
            }

            function getCsrf() {
                var name = 'csrf_cookie_name';
                var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
                if (arr != null)
                    return unescape(arr[2]);
                return null;
            }
	

    //调用微信JS api 支付
    function jsApiCall()
    {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            <?php echo $jsApiParameters; ?>,
            function(res){
                //WeixinJSBridge.log(res.err_msg);
                if(res.err_msg == "get_brand_wcpay_request:ok" ){
     
                    //我在这里选择了前台只要支付成功将单号传递更新数据

					publicJS.promptBox("正在为您跳转订单管理,请稍候", 3000);
					window.location.href = 'http://m.bibi321.com/hl/index.php#/tab/trainorderlist';

                } 
				else if(res.err_msg == "get_brand_wcpay_request:cancel" )
				{
					publicJS.promptBox("支付取消", 2000);
					window.location.href = 'http://m.bibi321.com/hl/index.php#/tab/trainorderlist';					
				}
				else 
                {
					publicJS.promptBox("支付失败", 2000);
					window.location.href = 'http://m.bibi321.com/hl/index.php#/tab/trainorderlist';					
                }
            }
        );
    }
 
    function callpay()
    {
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
            jsApiCall();
        }
    }
	

    angular.module("trainApp", ["ionic","starter.services"]).controller("Train_WXPayCtrl", function($scope, $interval, $timeout,MsgBox, $http) {

        var a = window.localStorage.getItem('orderDetail');
        
      
        var train_order = $.parseJSON(a);
        //订单详情
        $scope.orderDetail = train_order;
        $scope.ticketInfo = $scope.orderDetail.passenslist;
 
        $scope.retunurl = function() {
            window.location.href = 'http://m.bibi321.com/hl/index.php#/tab/trainOrder';
        };
		
		//定时重新加载航班
		$scope.countdown = function() {
			$scope.minute = 10;
			$scope.second = 0;
			var timePromise = $interval(function() {
				$scope.second--;
				if ($scope.second <= 0) {
					if ($scope.minute > 0) {
						$scope.second = 59;
						$scope.minute--;
					} else {
						$interval.cancel(timePromise);
						MsgBox.promptBox("支付超时，请重新选择！", 2000);
						$timeout(function() {
							window.location.href = 'http://m.bibi321.com/hl/index.php#/tab/train';
						}, 2000);
						return;
					}
				}
			}, 1000, 0);
		};
		//启动倒计时
		$scope.countdown();
		
	$scope.zhifu = function(){
            var orderDetail = JSON.stringify($scope.orderDetail);
            $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
            var csrf_test_name = getCsrf();
            var myobject = {
                orderDetail: window.localStorage.getItem('orderDetail'),
                csrf_test_name: csrf_test_name
            };
            $http.post('http://m.bibi321.com/hl/index.php/app/jiekou/train/checkTicketNumzhifu', objtops(myobject)).success(function(data) {
                if (data == "余票充足") {

                 callpay();
                } else {
                    MsgBox.promptBox(data + "，请重新提交订单！", 2000);
                    $timeout(function() {
                    window.location.href = 'http://m.bibi321.com/hl/index.php#/tab/train';
                    }, 2000);
                    return;
                }
            });
            
			
        };
    });
</script>
</html>