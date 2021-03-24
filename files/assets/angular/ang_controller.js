var app = angular.module('app', ['ngRoute']);
var config = {
    "base": "files/_core/controller/route.php"
};

app.controller('login', ['$scope', '$http', '$window', function($scope, $http, $window){
    $scope.login = function(email, password) {
        let data = {
            "email": email,
            "password": password,
            "request": "login"
        };
        $http.post(config.base, data).then(function (r){
            $scope.message = r.data.message;
            if (r.data.status === "success")
                $window.location.href = "../../dashboard.php";
        });
    }
}]);

app.controller('margin_account', ['$scope', '$http', function($scope, $http){
    $scope.balance = 0;
    $scope.sum = 0;
    $scope.orders = [];
    get_orders();
    get_balance();
    function get_orders() {
        $scope.http_status = "Fetching Data";
        let data = {
            "request": "open_order_e",
        };
        $http.post(config.base, data).then(function(r) {
            $scope.orders = r.data.data;
            $scope.http_status = null;
            calculate_sum($scope.orders);
        });        
    }

    function calculate_sum(orders) {
        let sum = 0;
        orders.forEach(element => {
            sum += element.unrealized_pl;
        });
        $scope.sum = sum;
    }

    function get_balance() {
        let data = {
            "request": "balance",
        };
        $http.post(config.base, data).then(function(r) {
            $scope.balance = r.data.data;
        });            
    }
}]);

app.controller('open_orders', ['$scope', '$http', function($scope, $http){
    $scope.orders = [];
    get_open_orders();

    function get_open_orders() {
        $scope.http_status = "Fetching Data";
        let data = {
            "request": "open_order_list",
        };
        $http.post(config.base, data).then(function(r) {
            $scope.orders = r.data.data;
            $scope.http_status = null;
        });
    }
}]);

app.controller('order_history', ['$scope', '$http', function($scope, $http){
    $scope.orders = [];
    get_order_histroy();

    function get_order_histroy() {
        $scope.http_status = "Fetching Data";
        let data = {
            "request": "open_order_history_list",
        };        
        $http.post(config.base, data).then(function(r) {
            $scope.orders = r.data.data;
            $scope.http_status = null;
        });
    }

    $scope.full_details = function (order) {
        $scope.s_order = order;
        $("#full_detail").modal('show');
    }
}]);

app.controller('fund_history', ['$scope', '$http', function($scope, $http){
    $scope.orders = [];
    fund_history();

    function fund_history() {
        $scope.http_status = "Fetching Data";
        let data = {
            "request": "get_acm_fund_history",
        };
        $http.post(config.base, data).then(function(r) {
            $scope.orders = r.data.data;
            $scope.http_status = null;
        });
    }
}]);

app.controller('profile', ['$scope', '$http', function($scope, $http){
    get_profile();
    function get_profile() {
        let data = {
            "request": "profile",
        };        
        $http.post(config.base, data).then(function(r) {
            $scope.profile = r.data.data;
        });
    }
}]);

app.controller('setting', ['$scope', '$http', function($scope, $http){
    $scope.change_password = function(password) {
        let data = {
            "request": "change_password",
            "password": password
        };
        $http.post(config.base, data).then(function(r) {
            $scope.cpassword = "";
            $scope.status = r.data.message;
        });        
    }
}]);
