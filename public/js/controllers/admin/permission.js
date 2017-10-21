var app=angular.module('hoc2h-permission',['ui.bootstrap'])
app.run(function(){
	console.log("hello role");	
})
app.factory('permission', [function () {
    return {
        list_permissions:[]
    };
}])
app.controller('ctlPermission', function($scope,$http,$uibModal,permission){
    $http.get('/admin/permissions/api/getall').then(function (res) {
            permission.list_permissions=res.data;
            $scope.permissions=permission.list_permissions;
        }, function (err) {
            console.log(err);
        })
        $scope.checkAll = function () {
        if ($scope.selectedAll) {
            $scope.selectedAll = true;
        } else {
            $scope.selectedAll = false;
        }
        angular.forEach($scope.permissions, function (item) {
            item.Selected = $scope.selectedAll;
        });
    };
    $scope.doSearch=function (name) {
      $http.post('/admin/permissions/search',{name:name}).then(function (res) {
        $scope.permissions=res.data;
      }, function (err) {
        
      })
    }
    $scope.create=function () {
        var modalInstance = $uibModal.open({
                templateUrl: 'myModalContent.html',
                controller: 'ModalAdd',
                size:'md',
            });
    }
    $scope.delete=function (id) {
        if(checkRole(id))
            var modalInstance = $uibModal.open({
                templateUrl: 'modal_delete.html',
                controller: 'ModalDelete',
                size:'md', 
                resolve: {
                    data:{
                        id:id,
                    }
                } 
            });
        else
             var modalInstance = $uibModal.open({
                templateUrl: 'modal_warning.html',
                controller: 'ModalwarningRole',
                size:'md', 
            });
    }
    $scope.edit=function (permission) {
      var modalInstance = $uibModal.open({
        templateUrl: 'modal_edit.html',
        controller: 'ModalEdit',
        size:'md', 
        resolve: {
          data:{
            permission:permission,
          }
        } 
      });
    }
    $scope.multidelete=function () {
        var data = [];
            angular.forEach($scope.permissions, function(permission) {
                if (permission.Selected) {
                    data.push(permission.id);
                }
            });
            
            if (data.length == 0) {
                var modalInstance = $uibModal.open({
                    templateUrl: 'modal_warning.html',
                    controller: 'Modalwarning',
                    size:'md'
                });
            }
            else
            {
                var modalInstance = $uibModal.open({
                    templateUrl: 'modal_multidelete.html',
                    controller: 'ModalMultiDelete',
                    size:'md', 
                    resolve: {
                        data:{
                            list_id:data,
                        }
                    } 
                });
            }
    }
})
app.controller('ModalAdd', function($scope,$uibModalInstance,permission,$http){
    $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
    $scope.create=function () {
        $http.post('/admin/permissions/create', {name:$scope.name}).then(function (res) {
            permission.list_permissions.push(res.data);
            swal({
               title: 'Create permission success',
               type: 'success',
               confirmButtonColor: '#4c7ff0',
           }, function() {
             //window.location.href='';
          });
            $uibModalInstance.dismiss('cancel');
        }, function (err) {
            swal('Create fail!', '', 'error');
        })
       
    }
});
app.controller('ModalDelete',  function($scope,$uibModalInstance,permission,$http,data){
    $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
    $scope.delete=function () {
       $http.delete('permissions/delete/'+data.id).then(function (res) {
          console.log(findWithAttr(permission.list_permissions,'id',res.data.id));
          permission.list_permissions.splice(findWithAttr(permission.list_permissions,'id',res.data.id),1);
          $uibModalInstance.dismiss('cancel');
           swal('Delete Success!', '', 'success');
       }, function (err) {
           $uibModalInstance.dismiss('cancel');
           swal('Delete fail!', '', 'error');
       })
    }
})
app.controller('ModalMultiDelete',  function($scope,$uibModalInstance,permission,$http,data){
    $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
    $scope.delete=function () {
       $http.post('permissions/multidelete/',data.list_id).then(function (res) {
        if(res.data=="true")
        {
          for (var i = 0; i < data.list_id.length; i++) {
              permission.list_permissions.splice(findWithAttr(permission.list_permissions,'id',data.list_id[i]),1);
          }
          swal('Delete Success!', '', 'success');
        }
        else
        {
             swal('Delete fail!', '', 'error');
        }
        $uibModalInstance.dismiss('cancel');
      }, function (err) {
         $uibModalInstance.dismiss('cancel');
         swal('Delete fail!', '', 'error');
     })
   }
})
app.controller('Modalwarning',function($scope,$uibModalInstance,permission,$http){
     $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
})
app.controller('ModalEdit',  function($scope,$uibModalInstance,permission,$http,data){
    $scope.name=data.permission.name;
    $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
    $scope.edit=function () {
       $http.post('permissions/edit/',{id:data.permission.id,name:$scope.name}).then(function (res) {
          $uibModalInstance.dismiss('cancel');
          permission.list_permissions[findWithAttr(permission.list_permissions,'id',res.data.id)]=res.data;
          swal('Edit Success!', '', 'success');
       }, function (err) {
           $uibModalInstance.dismiss('cancel');
           swal('Edit fail!', '', 'error');
       })
    }
})
function checkRole(id) {
    if(id==1||id==2||id==3||id==4||id==5)
    {
        return false;
    }
    else
    {
        return true;
    }
}
 function findWithAttr(array, attr, value) {
        for (var i = 0; i < array.length; i += 1) {
            if (array[i][attr] === value) {
                return i;
            }
        }
        return -1;
    }