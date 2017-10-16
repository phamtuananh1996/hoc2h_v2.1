@extends('admin.layout.master')
@section('content')
<style type="text/css">
.jstree-anchor {
  /*enable wrapping*/
  white-space : normal !important;
  /*ensure lower nodes move down*/
  height : auto !important;
}
</style>
<link rel="stylesheet" href="{{ asset('js/flugin/treejs/dist/themes/default/style.min.css') }}" />
<script src="{{ asset('js/flugin/treejs/dist/jstree.min.js') }}"></script>
<script src="{{ asset('js/flugin/treejs/dist/myjstree.js') }}"></script>
<div class="box">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Dashboard</a></li>
		<span class="breadcrumb-item active">Category</span>
	</ol>
	<div class="card">
		<div class="card-body">
			<div id="jstree">
			</div>
		</div>
	</div>
</div>
@endsection