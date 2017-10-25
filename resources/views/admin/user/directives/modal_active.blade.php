<script type="text/ng-template" id="ModalActive.html">
  <div class="modal-header bg-success">
    <h4 class="modal-title">Xác nhận</h4>
  </div>
  <div class="modal-body">
    @verbatim
        {{message}}
    @endverbatim
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-sm" ng-click="active()">Active</button>
    <button class="btn btn-warning btn-sm" ng-click="cancel()">Cancel</button>
  </div>
</script>