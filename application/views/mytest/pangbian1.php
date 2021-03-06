<html ng-app="ionicApp">
    <head
        <title>Ionic Alphabetically Indexed List</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width"/>
        <link href='<?php echo base_url("lib/ionic/css/ionic.min.css"); ?>' rel="stylesheet">
        <script src='<?php echo base_url("lib/ionic/js/ionic.bundle.min.js"); ?>'></script>

        <script src='<?php echo base_url("lib/jquery/jquery.min.js"); ?>'></script>
        <script src='<?php echo base_url("lib/jquery/mobiscroll_date.js"); ?>'></script>
        <script src='<?php echo base_url("lib/jquery/mobiscroll.js"); ?>'></script>

        <script src='<?php echo base_url("lib/ionic/js/angular-local-storage.min.js"); ?>'></script>
        <script src='<?php echo base_url("lib/ionic/js/angular/angular-resource.min.js"); ?>'></script>
        <script src='<?php echo base_url("lib/ionic/js/angular/angular-sanitize.min.js"); ?>'></script>
        <script src='<?php echo base_url("lib/ionic/js/angular/angular-animate.min.js"); ?>'></script>

        <script type="text/javascript">
            angular.module('ionicApp', ['ionic'])

.controller('MyCtrl', function ($scope, $stateParams, $location, $ionicScrollDelegate, $log) {
	$scope.users = [{"code":"AHJ","city":"阿坝","pinyin":"Aba"},{"code":"YIE","city":"阿尔山","pinyin":"Aershan"},{"code":"AKU","city":"阿克苏","pinyin":"Akesu"},{"code":"RHT","city":"阿拉善右旗","pinyin":"Alashanyouqi"},{"code":"AXF","city":"阿拉善左旗","pinyin":"Alashanzuoqi"},{"code":"AAT","city":"阿勒泰","pinyin":"Aletai"},{"code":"NGQ","city":"阿里","pinyin":"Ali"},{"code":"AKA","city":"安康","pinyin":"Ankang"},{"code":"AQG","city":"安庆","pinyin":"Anqing"},{"code":"AOG","city":"鞍山","pinyin":"Anshan"},{"code":"AVA","city":"安顺","pinyin":"Anshun"},{"code":"MFM","city":"澳门","pinyin":"Aomen"},{"code":"AEB","city":"百色","pinyin":"Baise"},{"code":"BGF","city":"班吉","pinyin":"Banji"},{"code":"BSD","city":"保山","pinyin":"Baoshan"},{"code":"BAV","city":"包头","pinyin":"Baotou"},{"code":"RLK","city":"巴彦淖尔","pinyin":"Bayannaoer"},{"code":"BHY","city":"北海","pinyin":"Beihai"},{"code":"PEK","city":"北京","pinyin":"Beijing"},{"code":"BFJ","city":"毕节","pinyin":"Bijie"},{"code":"BPL","city":"博乐","pinyin":"Bole"},{"code":"CGQ","city":"长春","pinyin":"Changchun"},{"code":"CGD","city":"常德","pinyin":"Changde"},{"code":"BPX","city":"昌都","pinyin":"Changdu"},{"code":"CSX","city":"长沙","pinyin":"Changsha"},{"code":"CIH","city":"长治","pinyin":"Changzhi"},{"code":"CZX","city":"常州","pinyin":"Changzhou"},{"code":"CHG","city":"朝阳","pinyin":"Chaoyang"},{"code":"CTU","city":"成都","pinyin":"Chengdu"},{"code":"CIF","city":"赤峰","pinyin":"Chifeng"},{"code":"JUH","city":"池州","pinyin":"Chizhou"},{"code":"CKG","city":"重庆","pinyin":"Chongqing"},{"code":"DLU","city":"大理","pinyin":"Dali"},{"code":"DLC","city":"大连","pinyin":"Dalian"},{"code":"DDG","city":"丹东","pinyin":"Dandong"},{"code":"DCY","city":"稻城","pinyin":"Daocheng"},{"code":"DQA","city":"大庆","pinyin":"Daqing"},{"code":"DAT","city":"大同","pinyin":"Datong"},{"code":"DAX","city":"达州","pinyin":"Dazhou"},{"code":"DOY","city":"东营","pinyin":"Dongying"},{"code":"DNH","city":"敦煌","pinyin":"Dunhuang"},{"code":"DSN","city":"鄂尔多斯","pinyin":"Eerduosi"},{"code":"EJN","city":"额济纳旗","pinyin":"Ejinaqi"},{"code":"ENH","city":"恩施","pinyin":"Enshi"},{"code":"ERL","city":"二连浩特","pinyin":"Erlianhaote"},{"code":"FUO","city":"佛山","pinyin":"Foshan"},{"code":"FUG","city":"阜阳","pinyin":"Fuyang"},{"code":"FYJ","city":"抚远","pinyin":"Fuyuan"},{"code":"FYN","city":"富蕴","pinyin":"Fuyun"},{"code":"FOC","city":"福州","pinyin":"Fuzhou"},{"code":"KOW","city":"赣州","pinyin":"Ganzhou"},{"code":"KHH","city":"高雄","pinyin":"Gaoxiong"},{"code":"GOQ","city":"格尔木","pinyin":"Geermu"},{"code":"GNI","city":"格林岛","pinyin":"Gelindao"},{"code":"GYS","city":"广元","pinyin":"Guangyuan"},{"code":"CAN","city":"广州","pinyin":"Guangzhou"},{"code":"KWL","city":"桂林","pinyin":"Guilin"},{"code":"KWE","city":"贵阳","pinyin":"Guiyang"},{"code":"GYU","city":"固原","pinyin":"Guyuan"},{"code":"HRB","city":"哈尔滨","pinyin":"Haerbin"},{"code":"HAK","city":"海口","pinyin":"Haikou"},{"code":"HLD","city":"海拉尔","pinyin":"Hailaer"},{"code":"HXD","city":"海西","pinyin":"Haixi"},{"code":"HMI","city":"哈密","pinyin":"Hami"},{"code":"HDG","city":"邯郸","pinyin":"Handan"},{"code":"HGH","city":"杭州","pinyin":"Hangzhou"},{"code":"HZG","city":"汉中","pinyin":"Hanzhong"},{"code":"HCJ","city":"河池","pinyin":"Hechi"},{"code":"HFE","city":"合肥","pinyin":"Hefei"},{"code":"HEK","city":"黑河","pinyin":"Heihe"},{"code":"HCN","city":"恒春","pinyin":"Hengchun"},{"code":"HNY","city":"衡阳","pinyin":"Hengyang"},{"code":"HTN","city":"和田","pinyin":"Hetian"},{"code":"HIA","city":"淮安","pinyin":"Huaian"},{"code":"HJJ","city":"怀化","pinyin":"Huaihua"},{"code":"HUN","city":"花莲","pinyin":"Hualian"},{"code":"TXN","city":"黄山","pinyin":"Huangshan"},{"code":"HYN","city":"黄岩","pinyin":"Huangyan"},{"code":"HET","city":"呼和浩特","pinyin":"Huhehaote"},{"code":"HUZ","city":"惠州","pinyin":"Huizhou"},{"code":"JGD","city":"加格达奇","pinyin":"Jiagedaqi"},{"code":"JMU","city":"佳木斯","pinyin":"Jiamusi"},{"code":"CYI","city":"嘉义","pinyin":"Jiayi"},{"code":"JGN","city":"嘉峪关","pinyin":"Jiayuguan"},{"code":"SWA","city":"揭阳","pinyin":"Jieyang"},{"code":"TNA","city":"济南","pinyin":"Jinan"},{"code":"JIC","city":"金昌","pinyin":"Jinchang"},{"code":"JDZ","city":"景德镇","pinyin":"Jingdezhen"},{"code":"JGS","city":"井冈山","pinyin":"Jinggangshan"},{"code":"JNG","city":"济宁","pinyin":"Jining"},{"code":"JJN","city":"晋江","pinyin":"Jinjiang"},{"code":"KNH","city":"金门","pinyin":"Jinmen"},{"code":"JNZ","city":"锦州","pinyin":"Jinzhou"},{"code":"JIU","city":"九江","pinyin":"Jiujiang"},{"code":"JZH","city":"九寨沟","pinyin":"Jiuzhaigou"},{"code":"JXA","city":"鸡西","pinyin":"Jixi"},{"code":"KJH","city":"凯里","pinyin":"Kaili"},{"code":"KJI","city":"喀纳斯","pinyin":"Kanasi"},{"code":"KGT","city":"康定","pinyin":"Kangding"},{"code":"KHG","city":"喀什","pinyin":"Kashi"},{"code":"KRY","city":"克拉玛依","pinyin":"Kelamayi"},{"code":"KCA","city":"库车","pinyin":"Kuche"},{"code":"KRL","city":"库尔勒","pinyin":"Kuerle"},{"code":"KMG","city":"昆明","pinyin":"Kunming"},{"code":"LHW","city":"兰州","pinyin":"Lanzhou"},{"code":"LXA","city":"拉萨","pinyin":"Lasa"},{"code":"LCX","city":"连城","pinyin":"Liancheng"},{"code":"LYG","city":"连云港","pinyin":"Lianyungang"},{"code":"LLB","city":"荔波","pinyin":"Libo"},{"code":"LJG","city":"丽江","pinyin":"Lijiang"},{"code":"LNJ","city":"临沧","pinyin":"Lincang"},{"code":"LYI","city":"临沂","pinyin":"Linyi"},{"code":"LZY","city":"林芝","pinyin":"Linzhi"},{"code":"HZH","city":"黎平","pinyin":"liping"},{"code":"LPF","city":"六盘水","pinyin":"Liupanshui"},{"code":"LZH","city":"柳州","pinyin":"Liuzhou"},{"code":"LYA","city":"洛阳","pinyin":"Luoyang"},{"code":"LZO","city":"泸州","pinyin":"LuZhou"},{"code":"LLV","city":"吕梁","pinyin":"Lvliang"},{"code":"MZG","city":"马公","pinyin":"Magong"},{"code":"LUM","city":"芒市","pinyin":"Mangshi"},{"code":"MFK","city":"马祖","pinyin":"Mazu"},{"code":"MXZ","city":"梅县","pinyin":"Meixian"},{"code":"MIG","city":"绵阳","pinyin":"Mianyang"},{"code":"NZH","city":"满洲里","pinyin":"Mianzhonli"},{"code":"OHE","city":"漠河","pinyin":"Mohe"},{"code":"MDG","city":"牡丹江","pinyin":"Mudanjiang"},{"code":"NLT","city":"那拉提","pinyin":"Nalati"},{"code":"KHN","city":"南昌","pinyin":"Nanchang"},{"code":"NAO","city":"南充","pinyin":"Nanchong"},{"code":"NKG","city":"南京","pinyin":"Nanjing"},{"code":"NNG","city":"南宁","pinyin":"Nanning"},{"code":"NTG","city":"南通","pinyin":"Nantong"},{"code":"NNY","city":"南阳","pinyin":"Nanyang"},{"code":"NGB","city":"宁波","pinyin":"Ningbo"},{"code":"PZI","city":"攀枝花","pinyin":"Panzhihua"},{"code":"PIF","city":"屏东","pinyin":"Pingdong"},{"code":"SYM","city":"普洱","pinyin":"Puer"},{"code":"JIQ","city":"黔江","pinyin":"Qianjiang"},{"code":"IQM","city":"且末","pinyin":"Qiemo"},{"code":"CMJ","city":"七美","pinyin":"Qimei"},{"code":"TAO","city":"青岛","pinyin":"Qingdao"},{"code":"RMQ","city":"清泉岗","pinyin":"Qingquangang"},{"code":"IQN","city":"庆阳","pinyin":"Qingyang"},{"code":"SHP","city":"秦皇岛","pinyin":"Qinhuangdao"},{"code":"NDG","city":"齐齐哈尔","pinyin":"Qiqihaer"},{"code":"JUZ","city":"衢州","pinyin":"QuZhou"},{"code":"RKZ","city":"日喀则","pinyin":"Rikaze"},{"code":"SYX","city":"三亚","pinyin":"Sanya"},{"code":"SHA","city":"上海","pinyin":"Shanghai"},{"code":"HSC","city":"韶关","pinyin":"Shaoguan"},{"code":"HPG","city":"神农架","pinyin":"Shennongjia"},{"code":"SHE","city":"沈阳","pinyin":"Shenyang"},{"code":"SZX","city":"深圳","pinyin":"Shenzhen"},{"code":"SJW","city":"石家庄","pinyin":"Shijiazhuang"},{"code":"TSA","city":"松山","pinyin":"Songsan"},{"code":"SUN","city":"遂宁","pinyin":"Suining"},{"code":"TCG","city":"塔城","pinyin":"Tacheng"},{"code":"TPE","city":"台北","pinyin":"Taibei"},{"code":"TTT","city":"台东","pinyin":"Taidong"},{"code":"TNN","city":"台南","pinyin":"Tainan"},{"code":"TYN","city":"太原","pinyin":"Taiyuan"},{"code":"TVS","city":"唐山","pinyin":"Tangshan"},{"code":"TCZ","city":"腾冲","pinyin":"Tengchong"},{"code":"TSN","city":"天津","pinyin":"Tianjin"},{"code":"THQ","city":"天水","pinyin":"Tianshui"},{"code":"TNH","city":"通化","pinyin":"Tonghua"},{"code":"TGO","city":"通辽","pinyin":"Tongliao"},{"code":"TEN","city":"铜仁","pinyin":"Tongren"},{"code":"TLQ","city":"吐鲁番","pinyin":"Tulufan"},{"code":"WOT","city":"望安","pinyin":"Wangan"},{"code":"WXN","city":"万县","pinyin":"Wanxian"},{"code":"WEF","city":"潍坊","pinyin":"Weifang"},{"code":"WEH","city":"威海","pinyin":"Weihai"},{"code":"WNH","city":"文山","pinyin":"Wenshan"},{"code":"WNZ","city":"温州","pinyin":"Wenzhou"},{"code":"WUA","city":"乌海","pinyin":"Wuhai"},{"code":"WUH","city":"武汉","pinyin":"Wuhan"},{"code":"HLH","city":"乌兰浩特","pinyin":"Wulanhaote"},{"code":"URC","city":"乌鲁木齐","pinyin":"Wulumuqi"},{"code":"WUX","city":"无锡","pinyin":"Wuxi"},{"code":"WUS","city":"武夷山","pinyin":"Wuyishan"},{"code":"WUZ","city":"梧州","pinyin":"Wuzhou"},{"code":"GXH","city":"夏河","pinyin":"Xiahe"},{"code":"XMN","city":"厦门","pinyin":"Xiamen"},{"code":"XIY","city":"西安","pinyin":"Xian"},{"code":"XFN","city":"襄樊","pinyin":"Xiangfan"},{"code":"DIG","city":"香格里拉","pinyin":"Xianggelila"},{"code":"XIC","city":"西昌","pinyin":"Xichang"},{"code":"XIL","city":"锡林浩特","pinyin":"Xilinhaote"},{"code":"XNT","city":"邢台","pinyin":"Xingtai"},{"code":"ACX","city":"兴义","pinyin":"Xingyi"},{"code":"XNN","city":"西宁","pinyin":"Xining"},{"code":"JHG","city":"西双版纳","pinyin":"Xishuangbanna"},{"code":"XUZ","city":"徐州","pinyin":"Xuzhou"},{"code":"ENY","city":"延安","pinyin":"Yanan"},{"code":"YNZ","city":"盐城","pinyin":"Yancheng"},{"code":"YTY","city":"扬州","pinyin":"Yangzhou"},{"code":"YNJ","city":"延吉","pinyin":"Yanji"},{"code":"YNT","city":"烟台","pinyin":"Yantai"},{"code":"YBP","city":"宜宾","pinyin":"Yibin"},{"code":"YIH","city":"宜昌","pinyin":"Yichang"},{"code":"LDS","city":"伊春","pinyin":"Yichun"},{"code":"YIC","city":"宜春","pinyin":"Yichun"},{"code":"INC","city":"银川","pinyin":"Yinchuan"},{"code":"YIN","city":"伊宁","pinyin":"Yining"},{"code":"YIW","city":"义乌","pinyin":"yiwu"},{"code":"LLF","city":"永州","pinyin":"Yongzhou"},{"code":"UYN","city":"榆林","pinyin":"Yulin"},{"code":"YCU","city":"运城","pinyin":"Yuncheng"},{"code":"YUS","city":"玉树","pinyin":"Yushu"},{"code":"NBS","city":"长白山","pinyin":"Zhangbaishan"},{"code":"CNI","city":"长海","pinyin":"Zhanghai"},{"code":"DYG","city":"张家界","pinyin":"Zhangjiajie"},{"code":"ZQZ","city":"张家口","pinyin":"Zhangjiakou"},{"code":"YZY","city":"张掖","pinyin":"Zhangye"},{"code":"ZHA","city":"湛江","pinyin":"Zhanjiang"},{"code":"ZAT","city":"昭通","pinyin":"Zhaotong"},{"code":"CGO","city":"郑州","pinyin":"Zhengzhou"},{"code":"ZHY","city":"中卫","pinyin":"Zhongwei"},{"code":"HSN","city":"舟山","pinyin":"Zhoushan"},{"code":"ZUH","city":"珠海","pinyin":"Zhuhai"},{"code":"ZYI","city":"遵义","pinyin":"Zunyi"}];
	var users = $scope.users;
	var log = [];

	$scope.alphabet = iterateAlphabet();

	//Sort user list by first letter of name
	var tmp = {};
	for (i = 0; i < users.length; i++) {
		var letter = users[i].pinyin.toUpperCase().charAt(0);
		if (tmp[letter] == undefined) {
			tmp[letter] = []
		}
		tmp[letter].push(users[i]);
	}
	$scope.sorted_users = tmp;

	//Click letter event
	$scope.gotoList = function (id) {
		$location.hash(id);
		$ionicScrollDelegate.anchorScroll();
	};

	//Create alphabet object
	function iterateAlphabet() {
		var str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		var numbers = new Array();
		for (var i = 0; i < str.length; i++) {
			var nextChar = str.charAt(i);
			numbers.push(nextChar);
		}
		return numbers;
	}
	$scope.groups = [];
	for (var i = 0; i < 10; i++) {
		$scope.groups[i] = {
			name : i,
			items : []
		};
		for (var j = 0; j < 3; j++) {
			$scope.groups[i].items.push(i + '-' + j);
		}
	}

	/*
	 * if given group is the selected group, deselect it
	 * else, select the given group
	 */
	$scope.toggleGroup = function (group) {
		if ($scope.isGroupShown(group)) {
			$scope.shownGroup = null;
		} else {
			$scope.shownGroup = group;
		}
	};
	$scope.isGroupShown = function (group) {
		return $scope.shownGroup === group;
	};

});

        </script>

        <style type="text/css">
            .alpha_sidebar{
                position: absolute;
                top:50px;
                right: 	10px;
                z-index: 100000
            }
            .alpha_sidebar li{
                color: #49afcd;
                margin-bottom: 2px;
                cursor: pointer;
            }
            .alpha_list{
                padding-right: 22px;
            }
        </style>
    </head>

    <body ng-controller="MyCtrl">

    <ion-header-bar class="bar-positive">
        <h1 class="title">Alphabetically Indexed List</h1>
    </ion-header-bar>

    <ion-content scroll="true" class="has-header" padding="true">
        <div data-ng-repeat="(letter, authors) in sorted_users" class="alpha_list">
            <ion-item class="item item-divider" id="index_{{letter}}">
                {{letter}}
            </ion-item>
            <ion-item ng-repeat="author in authors">
                {{author.city}}
            </ion-item>
        </div>
    </ion-content>
    <ul class="alpha_sidebar">
        <li ng-click="gotoList('index_{{letter}}')" ng-repeat="letter in alphabet"> 
            {{letter}}
        </li>
    </ul>

</body>
</html>