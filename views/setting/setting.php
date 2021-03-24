<div ng-controller="setting" class="container-fluid">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">Setting</li>
		<li class="breadcrumb-item active">Password Change</li>
	</ol>
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-6">
				<div class="card card-body">
					<h4> Password Change </h4>
                    <br>
					<form ng-submit="change_password(cpassword)">
						<div class="form-group form-primary">
							<label>New Password</label>
							<input type="password" name="cpassword" ng-model="cpassword" class="form-control" ng-trim="false" required> <span class="form-bar"></span>
							<label for="" class="text-danger" ng-show="form.password.$error">Confirm Password Same as Password</label>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="">
                                    <label class="text-center h6 text-danger">{{status}}</label>
									<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">change</button>
								</div>
							</div>
							<div class="col-md-2"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>