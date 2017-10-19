<script type="text/ng-template" id="modal_multidelete.html">
  <div class="modal-header">
    <h4 class="modal-title">Xác nhận</h4>
  </div>
  <div class="modal-body">
    Bạn có chắc chắn muốn xóa các group này không.nếu xóa các thành viên trong group này sẽ chuyển thành member !
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-sm" ng-click="delete()">Vẫn xóa</button>
    <button class="btn btn-warning btn-sm" ng-click="cancel()">Cancel</button>
  </div>
</script>