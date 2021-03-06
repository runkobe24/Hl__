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
	$scope.users = [{
			"_id" : "53fceb7ef214c5316e93e7c8",
			"first_name" : "Francis",
			"last_name" : "Hill"
		}, {
			"_id" : "53fceb7e4a46965ec9f1d08f",
			"first_name" : "Lessie",
			"last_name" : "Caldwell"
		}, {
			"_id" : "53fceb7e502379253e2e7b0d",
			"first_name" : "Alyson",
			"last_name" : "Woodward"
		}, {
			"_id" : "53fceb7ee548c39f3d6d651e",
			"first_name" : "Malone",
			"last_name" : "Becker"
		}, {
			"_id" : "53fceb7e216dabb188bf3cec",
			"first_name" : "Terrell",
			"last_name" : "Stein"
		}, {
			"_id" : "53fceb7ed393a16f29b2dc78",
			"first_name" : "Laurie",
			"last_name" : "Ayers"
		}, {
			"_id" : "53fceb7e956d8f3aaf33634e",
			"first_name" : "Rowland",
			"last_name" : "Rosario"
		}, {
			"_id" : "53fceb7ec92ee5342dc5c5df",
			"first_name" : "Laurel",
			"last_name" : "Hobbs"
		}, {
			"_id" : "53fceb7ed624f8dd26ebb171",
			"first_name" : "Kristie",
			"last_name" : "Barker"
		}, {
			"_id" : "53fceb7e14cb861f7e72c202",
			"first_name" : "Riley",
			"last_name" : "Ortiz"
		}, {
			"_id" : "53fceb7ecfe77b71b7a5d4fe",
			"first_name" : "Morin",
			"last_name" : "Terry"
		}, {
			"_id" : "53fceb7e671c72b0dacb44f5",
			"first_name" : "Ida",
			"last_name" : "Haney"
		}, {
			"_id" : "53fceb7e91f884a9dea10cb7",
			"first_name" : "Boyd",
			"last_name" : "Davis"
		}, {
			"_id" : "53fceb7e91a18e0fd67cc7e6",
			"first_name" : "Milagros",
			"last_name" : "Blair"
		}, {
			"_id" : "53fceb7e25edb893c03c320f",
			"first_name" : "Marissa",
			"last_name" : "Howell"
		}, {
			"_id" : "53fceb7e67e3275edd8b577d",
			"first_name" : "Whitehead",
			"last_name" : "Sosa"
		}, {
			"_id" : "53fceb7ed368d55809a0d1c8",
			"first_name" : "Potts",
			"last_name" : "Byers"
		}, {
			"_id" : "53fceb7e433a701299f9c02b",
			"first_name" : "Tara",
			"last_name" : "Adams"
		}, {
			"_id" : "53fceb7e8e7502eedfe0b0bc",
			"first_name" : "Velasquez",
			"last_name" : "Carver"
		}, {
			"_id" : "53fceb7ef69a7352f0c2cd55",
			"first_name" : "Dale",
			"last_name" : "Flowers"
		}, {
			"_id" : "53fceb7ed2212f228b769a86",
			"first_name" : "Baldwin",
			"last_name" : "Donovan"
		}, {
			"_id" : "53fceb7e0bf90a7ab5801e32",
			"first_name" : "Lynch",
			"last_name" : "Gibson"
		}, {
			"_id" : "53fceb7ee7053b2a611f0809",
			"first_name" : "Deana",
			"last_name" : "Norris"
		}, {
			"_id" : "53fceb7e3c0e0d3e9350cbce",
			"first_name" : "Harrison",
			"last_name" : "Decker"
		}, {
			"_id" : "53fceb7e1c3626c8d09db3f6",
			"first_name" : "Anne",
			"last_name" : "Harris"
		}, {
			"_id" : "53fceb7e981cb971bf0b40eb",
			"first_name" : "Nanette",
			"last_name" : "Harmon"
		}, {
			"_id" : "53fceb7ee8f2b6ecf8fd0338",
			"first_name" : "Byers",
			"last_name" : "Maldonado"
		}
	];
	var users = $scope.users;
	var log = [];

	$scope.alphabet = iterateAlphabet();

	//Sort user list by first letter of name
	var tmp = {};
	for (i = 0; i < users.length; i++) {
		var letter = users[i].first_name.toUpperCase().charAt(0);
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
                margin-bottom: 6px;
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
                {{author.first_name}} {{author.last_name}}
            </ion-item>
        </div>
    </ion-content>
    <ul class="alpha_sidebar">
        <li ng-click="gotoList('index_{{letter}}')"ng-repeat="letter in alphabet"> 
            {{letter}}
        </li>
    </ul>

</body>
</html>