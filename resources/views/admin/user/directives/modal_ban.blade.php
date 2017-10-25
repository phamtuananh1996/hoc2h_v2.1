<script type="text/ng-template" id="ModalBan.html">
  <div class="modal-header bg-danger">
    <h4 class="modal-title">Xác nhận</h4>
  </div>
  <div class="modal-body">
    @verbatim
         {{message}}
    @endverbatim
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-sm" ng-click="ban()">Ban</button>
    <button class="btn btn-warning btn-sm" ng-click="cancel()">Cancel</button>
  </div>
</script>