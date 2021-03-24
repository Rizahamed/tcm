<div ng-controller="margin_account" class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Margin Account</li>
    </ol>
    <div class="col-md-12 card card-body">
        <div class="row">
            <h4>Margin Account</h4>
        </div>
        <br>
        <div class="row ">
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th> Balance </th>
                            <th> Equity </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{balance}}</td>
                            <td>{{(balance + sum).toFixed(4)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12 card card-body">
        <div class="row">
            <h4>Symbol Exposure</h4>
        </div>
        <br>
        <div ng-show="orders.length > 0" class="row">
            <div class="col-md-12">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th> Symbol </th>
                            <th> Position </th>
                            <th> Unrealized Profit </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="o in orders">
                            <td>{{o.symbol}}</td>
                            <td>{{o.position}}</td>
                            <td>{{(o.unrealized_pl).toFixed(4)}}</td>
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