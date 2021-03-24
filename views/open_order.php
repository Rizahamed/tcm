<div ng-controller="open_orders" ng-cloak class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Open Order</li>
    </ol>
    <div class="col-md-12 card card-body">
        <div class="row">
            <h4>Open Orders</h4>
        </div>
        <br>
        <div ng-show="orders.length > 0" class="row">
            <div class="col-md-12">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Login</th>
                            <th>Position</th>
                            <th>PriceCurrent</th>
                            <th>PriceOpen</th>
                            <th>PriceSL</th>
                            <th>PriceTP</th>
                            <th>Profit</th>
                            <th>Symbol</th>
                            <th>Volume</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="o in orders">
                            <td>{{o.Login}}</td>
                            <td>{{o.Position}}</td>
                            <td>{{(o.PriceCurrent).toFixed(5)}}</td>
                            <td>{{(o.PriceOpen).toFixed(5)}}</td>
                            <td>{{(o.PriceSL).toFixed(5)}}</td>
                            <td>{{(o.PriceTP).toFixed(5)}}</td>
                            <td>{{(o.Profit).toFixed(4)}}</td>
                            <td>{{o.Symbol}}</td>
                            <td>{{o.Volume / 10000}}</td>
                            <td>{{o.Action === 1 ? 'Sell' : 'Buy'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <h6 class="text-center text-danger" ng-hide="orders.length > 0">{{http_status || 'No Orders Found'}}</h6>
        </div>
    </div>
</div>