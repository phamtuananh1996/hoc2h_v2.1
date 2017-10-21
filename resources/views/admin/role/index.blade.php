@extends('admin.layout.master')
@section('content')
	<div class="card" ng-app="hoc2h-role" ng-controller="ctlRole">
		@include('admin.role.directives.modal_create')
		@include('admin.role.directives.modal_edit')
		@include('admin.role.directives.modal_delete')
		@include('admin.role.directives.modal_warning')
		@include('admin.role.directives.model_multidelete')
		<div class="card-header b-a-0">
			Quản lý Role
			<button ng-click="multidelete()" class="btn btn-primary pull-right btn-sm" style="margin-right: 30px"><i class="fa fa-trash" aria-hidden="true"></i> delete</button>
			<button ng-click="create()" class="btn btn-primary pull-right btn-sm" style="margin-right: 30px"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
			
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
						<tr ng-hide="documents.length ==0">
							<td ng-show="documents.length < 0" ng-hide="roles.length > 0" colspan="8" class="text-center" id="doclength" >
								<div  class="notrecord">loading...</div>
							</td>
						</tr>
						<tr ng-repeat="role in roles| orderBy:'-id'"> 
							@verbatim
							<td><input type="checkbox" class="checkbox" ng-model="role.Selected" /></td>
							<td>{{role.id}}</td>
							<td>{{role.name}}</td>
							<td>{{role.guard_name}}</td>
							<td>
								<div class="table-actions">
									<a class="btn btn-sm btn-warning" href="/admin/pemission/{{role.id}}" data-toggle="tooltip" title="Permission">
										<i class="fa fa-users" aria-hidden="true"></i>
									</a>&nbsp;
									<a href="" class="btn btn-sm btn-primary" ng-click="edit(role)" data-toggle="tooltip" title="Edit">
										<i class="fa fa-edit"></i>								
									</a>&nbsp;
									<a href="" class="btn btn-sm btn-danger" ng-click="delete(role.id)" data-toggle="tooltip" title="delete">
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