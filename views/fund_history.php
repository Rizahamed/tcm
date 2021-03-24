<div ng-controller="fund_history" ng-cloak class="container-fluid">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Fund History</li>
    </ol>
    <div class="col-md-12 card card-body">
        <div class="row">
            <h4>Fund History</h4>
        </div>
        <br>
        <div ng-show="orders.length > 0" class="row">
            <div class="col-md-12">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="o in orders">
                            <td>{{$index + 1}}</td>
                            <td>{{o.date}}</td>
                            <td>{{o.amount}}</td>
                            <td>{{o.operation}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <h6 class="text-center text-danger" ng-hide="orders.length > 0">{{http_status || 'No History Found'}}</h6>
        </div>
    </div>
</div>