<script type="text/ng-template" id="modal_warning.html">
	<div class="modal-header bg-danger">
		<h4 class="modal-title">Cảnh báo!</h4>
	</div>
	<div class="modal-body">
		@verbatim
		   {{message}}
		@endverbatim
	</div>
	<div class="modal-footer">
		<button class="btn btn-warning" ng-click="cancel()">Cancel</button>
	</div>
</script>