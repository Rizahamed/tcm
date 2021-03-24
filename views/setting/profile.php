<div ng-controller="profile" class="container-fluid">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">Setting</li>
		<li class="breadcrumb-item active">Profile</li>
	</ol>
	<div class="row">
		<div class="col-md-6">
			<div class="card card-body">
				<form name="form">
					<h4> Profile </h4> 
					<br>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3">
							<label class="float-label">Name</label>
						</div>
						<div class="col-md-8">
							<div class="form-group form-primary">
								<input type="text" name="username" value="{{profile.name}}" placeholder="Example" class="form-control" disabled> <span class="form-bar"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3">
							<label class="float-label">Email</label>
						</div>
						<div class="col-md-8">
							<div class="form-group form-primary">
								<input type="email" name="email" readonly value="{{profile.email}}" placeholder="example@example.com" class="form-control" required> <span class="form-bar"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3">
							<label class="float-label">Number</label>
						</div>
						<div class="col-md-8">
							<div class="form-group form-primary">
								<input type="text" name="number" readonly value="{{profile.number}}" placeholder="0123456789" class="form-control" required> <span class="form-bar"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-3">
							<label class="float-label">Country</label>
						</div>
						<div class="col-md-8">
							<div class="form-group form-primary">
								<input type="text" name="country" value="{{profile.country}}" class="form-control" placeholder="Country" readonly> <span class="form-bar"></span>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>