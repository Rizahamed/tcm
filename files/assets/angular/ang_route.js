app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when("/dashboard", {
            templateUrl: "../../margin_account.php"
        })

        .when("/", {
            templateUrl: "../../views/margin_account.php"
        })
        .when("/margin_account", {
            templateUrl: "../../views/margin_account.php"
        })
        .when("/open_orders", {
            templateUrl: "../../views/open_order.php"
        })
        .when("/fund_history", {
            templateUrl: "../../views/fund_history.php"
        })
        .when("/order_history", {
            templateUrl: "../../views/order_history.php"
        })
        .when("/profile", {
            templateUrl: "../../views/setting/profile.php"
          })
        .when("/setting", {
            templateUrl: "../../views/setting/setting.php"
        })
        .otherwise({
            redirectTo: '/margin_account.php'
        });
}]);