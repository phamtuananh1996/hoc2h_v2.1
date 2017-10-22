@extends('admin.layout.master')
@section('content')
	<div class="card" ng-app="hoc2h-user" ng-controller="ctlUser">
		<div class="card-header b-a-0 col-md-12">
			<div class="col-md-3">Quản lý người dùng</div>
			<input class="col-md-4" type="text" ng-model="search" ng-keyup="doSearch(search)" placeholder=" Search user everywhere">
			<button ng-click="multidelete()" class="btn btn-primary pull-right btn-sm" style="margin-right: 30px"><i class="fa fa-trash" aria-hidden="true"></i> delete</button>
			<button ng-click="Active()" class="btn btn-primary pull-right btn-sm" style="margin-right: 30px"><i class="fa fa-check" aria-hidden="true"></i> Active</button>
			<button ng-click="multiban()" class="btn btn-primary pull-right btn-sm" style="margin-right: 30px"><i class="fa fa-ban" aria-hidden="true"></i> Ban</button>
			<a href="/admin/users/create" class="btn btn-primary pull-right btn-sm" style="margin-right: 30px"><i class="fa fa-plus" aria-hidden="true"></i> Create</a>
			
		</div>
		<div class="card-body">
			<div class="table-responsive" >
				<table class="table table-bordered table-striped m-b-0" ng-table="tableview">
					<thead>
						<tr>
							<th><input type="checkbox" class="checkbox" ng-model="selectedAll" ng-click="checkAll()" /></th>
							<th>id</th>
							<th>Username</th>
							<th>Email</th>
							<th>Name</th>
							<th>Role</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-hide="documents.length ==0">
							<td ng-show="documents.length < 0" ng-hide="users.length > 0" colspan="8" class="text-center" id="doclength" >
								<div  class="notrecord">loading...</div>
							</td>
						</tr>
						<tr ng-repeat="user in users| orderBy:'-id'"> 
							@verbatim
							<td><input type="checkbox" class="checkbox" ng-model="user.Selected" /></td>
							<td>{{user.id}}</td>
							<td>{{user.user_name}}</td>
							<td>{{user.email}}</td>
							<td>{{user.profile.name}}</td>
							<td class="text-center">{{user.roles[0].name}}</td>
							<td>
								<span class="alert-warning" ng-if="user.state==0">Disabled</span>
								<span class="alert-success" ng-if="user.state==1">Active</span>
							</td>
							<td>
								<div class="table-actions">
									<a class="btn btn-sm btn-warning" href="" ng-click="ban()" data-toggle="tooltip" title="Ban">
										<i class="fa fa-ban" aria-hidden="true"></i>
									</a>&nbsp;
									<a href="/admin/users/{{user.id}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
										<i class="fa fa-edit"></i>								
									</a>&nbsp;
									<a href="" class="btn btn-sm btn-danger" ng-click="delete(users.id)" data-toggle="tooltip" title="delete">
										<i class="fa fa-trash-o"></i>
									</a>
								</div>
							</td>
							@endverbatim 
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection