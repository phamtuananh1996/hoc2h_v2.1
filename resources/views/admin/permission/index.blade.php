@extends('admin.layout.master')
@section('content')
	<div class="card" ng-app="hoc2h-permission" ng-controller="ctlPermission">
		@include('admin.permission.directives.modal_create')
		@include('admin.permission.directives.modal_edit')
		@include('admin.permission.directives.modal_delete')
		@include('admin.permission.directives.modal_warning')
		@include('admin.permission.directives.model_multidelete')
		<div class="card-header b-a-0 col-md-12">
			<div class="col-md-3">Quản lý Permission</div>
			<input class="col-md-5" type="text" ng-model="search" ng-keyup="doSearch(search)" placeholder=" Search permission name">
			<button ng-click="multidelete()" class="btn btn-primary pull-right btn-sm col-md-1" style="margin-right: 30px"><i class="fa fa-trash" aria-hidden="true"></i> delete</button>
			<button ng-click="create()" class="btn btn-primary pull-right btn-sm col-md-1" style="margin-right: 30px"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
		</div>
		<div class="card-body">
			<div class="table-responsive" >
				<table class="table table-bordered table-striped m-b-0" ng-table="tableview">
					<thead>
						<tr>
							<th>
								<input type="checkbox" class="checkbox" ng-model="selectedAll" ng-click="checkAll()" />
							</th>
							<th>id</th>
							<th>name</th>
							<th>guard name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-hide="permissions.length ==0">
							<td ng-show="permissions.length < 0" ng-hide="permissions.length > 0" colspan="8" class="text-center" id="doclength" >
								<div  class="notrecord">loading...</div>
							</td>
						</tr>
						<tr ng-repeat="permission in permissions| orderBy:'-id'"> 
							@verbatim
							<td><input type="checkbox" class="checkbox" ng-model="permission.Selected" /></td>
							<td>{{permission.id}}</td>
							<td>{{permission.name}}</td>
							<td>{{permission.guard_name}}</td>
							<td>
								<div class="table-actions">
									<a href="" class="btn btn-sm btn-primary" ng-click="edit(permission)" data-toggle="tooltip" title="Edit">
										<i class="fa fa-edit"></i>								
									</a>&nbsp;
									<a href="" class="btn btn-sm btn-danger" ng-click="delete(permission.id)" data-toggle="tooltip" title="delete">
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