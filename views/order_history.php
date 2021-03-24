<div ng-controller="order_history" ng-cloak class="container-fluid">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">Dashboard</li>
		<li class="breadcrumb-item active">Order History</li>
	</ol>
	<div class="col-md-12 card card-body">
		<div class="row">
			<h4>Order History</h4>
		</div>
		<br>
		<div ng-show="orders.length > 0" class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered ">
						<thead>
							<tr>
								<th>Login</th>
								<th>Position</th>
								<th>Open Price</th>
								<th>Close Price</th>
								<th>Open Time</th>
								<th>Order ID</th>
								<th>PriceSL</th>
								<th>PriceTP</th>
								<th>Profit</th>
								<th>Symbol</th>
								<th>Open Volume</th>
								<th>Close Volume</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="o in orders">
								<td>{{o.login}}</td>
								<td>{{o.positionID}}</td>
								<td>{{o.openPrice}}</td>
                                <td>{{o.closePrice}}</td>
								<td>{{o.openTime}}</td>
								<td>{{o.orderId}}</td>
								<td>{{o.sl}}</td>
								<td>{{o.tp}}</td>
								<td>{{o.pnl}}</td>
								<td>{{o.symbol}}</td>
								<td>{{o.volumeReal}}</td>
								<td>{{o.volumeClosed}}</td>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
        <div class="row">
            <h6 class="text-center text-danger" ng-hide="orders.length > 0">{{http_status || 'No Orders Found'}}</h6>
        </div>
	</div>
	<!-- Modal -->
	<div id="full_detail" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Order detail : {{s_order.positionID}}</h4>
				</div>
				<div class="modal-body">
					<p>Some text in the modal.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>