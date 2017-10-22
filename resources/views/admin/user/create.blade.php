@extends('admin.layout.master')
@section('content')
<div class="card">
	<div class="card-header b-a-0">
		<div>Thông Tin người dùng ( * trường bắt buộc nhập)</div>
	</div>
	<div class="card-block">
		<form class="form-horizontal">
			<div class="form-group row">
				<label class="col-md-1 col-form-label">Role *:</label>
				<div class="col-md-10">
					<select class="form-control">
						<option value="">Role</option>
						@foreach ($role as $roles)
							<option value="{{$roles->id}}">{{$roles->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label">Name *:</label>
				<div class="col-md-10">
					<input type="text" name="name" class="form-control" placeholder="Name">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label">Userame*:</label>
				<div class="col-md-10">
					<input type="text" name="name" class="form-control" placeholder="Userame">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label">Email *:</label>
				<div class="col-md-10">
					<input type="text" name="email" placeholder="Email" class="form-control">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label">Password*:</label>
				<div class="col-md-10">
					<input type="text" name="password" placeholder="password" class="form-control">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label">Re-pw *:</label>
				<div class="col-md-10">
					<input type="text" name="re_password" placeholder="Password Confirm" class="form-control">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label">Phone/class:</label>
				<div class="col-md-5">
					<input type="text" name="phone" placeholder="Phone" class="form-control">
				</div>
				<div class="col-md-5">
					<input type="text" name="class" placeholder="class" class="form-control">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label">Sex/Birthday:</label>
				<div class="col-md-5">
					<select class="form-control">
						<option value="">--Sex--</option>
						<option value="">Nam</option>
						<option value="">Nữ</option>
					</select>
				</div>
				<div class="col-md-5">
					<input type="date" name="birthday" placeholder="Birthday" class="form-control">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label">Job/Status:</label>
				<div class="col-md-5">
					<input type="text" name="job" placeholder="job" class="form-control">
				</div>
				<div class="col-md-5">
					<select class="form-control" name="state">
						<option value="">--Status--</option>
						<option value="1">Active</option>
						<option value="0">Ban</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label">Avatar/Coin:</label>
				<div class="col-md-5">
					<label class="custom-file col-md-12">
                      <input type="file" id="file" class="custom-file-input" accept="image/*">
                      <span class="custom-file-control"></span>
                    </label>
				</div>
				<div class="col-md-5">
					<input type="number" name="coin" placeholder="coin" class="form-control">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label">Introduction*:</label>
				<div class="col-md-10">
					<textarea class="form-control" rows="3" placeholder="Introduction"> 
					</textarea>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-1 col-form-label"></label>
				<div class="col-md-1">
					<button type="submit" class="btn btn-primary">Submit </button>
				</div>
				<div class="col-md-1">
					<input type="reset" name="" value="Reset" class="btn-primary btn">
				</div>
			</div>
		</form>
	</div>
</div>
@stop