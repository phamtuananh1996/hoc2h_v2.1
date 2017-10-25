<script type="text/ng-template" id="modal_edit.html">
  <div class="modal-header">
    <h4 class="modal-title">Edit Permission</h4>
  </div>
  <div class="modal-body">
        <label for="name">Name *:</label> 
        <input type="text" name="name" ng-model="name" class="form-control">
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary btn-sm" ng-click="edit()">Edit</button>
    <button class="btn btn-warning btn-sm" ng-click="cancel()">Cancel</button>
  </div>
</script>