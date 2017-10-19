var app=angular.module('hoc2h-role',['ui.bootstrap'])
app.run(function(){
	console.log("hello role");	
})
app.factory('role', [function () {
    return {
        list_roles:[]
    };
}])
app.controller('ctlRole', function($scope,$http,$uibModal,role){
    $http.get('/admin/roles/api/getall').then(function (res) {
            role.list_roles=res.data;
            $scope.roles=role.list_roles;
        }, function (err) {
            console.log(err);
        })
        $scope.checkAll = function () {
        if ($scope.selectedAll) {
            $scope.selectedAll = true;
        } else {
            $scope.selectedAll = false;
        }
        angular.forEach($scope.roles, function (faq) {
            faq.Selected = $scope.selectedAll;
        });
    };

    $scope.create=function () {
        var modalInstance = $uibModal.open({
                templateUrl: 'myModalContent.html',
                controller: 'ModalAddRole',
                size:'md',
            });
    }
    $scope.delete=function (id) {
        if(checkRole(id))
            var modalInstance = $uibModal.open({
                templateUrl: 'modal_delete.html',
                controller: 'ModalDeleteRole',
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
      $scope.edit=function (role) {
        if(checkRole(role.id))
            var modalInstance = $uibModal.open({
                templateUrl: 'modal_edit.html',
                controller: 'ModalEditRole',
                size:'md', 
                resolve: {
                    data:{
                        role:role,
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
    $scope.multidelete=function () {
        var data = [];
            angular.forEach($scope.roles, function(role) {
                if (role.Selected) {
                    data.push(role.id);
                }
            });
            
            if (data.length == 0) {
                swal('Delete fail!', '', 'error');
                return false;
            }
            else
            {
                var modalInstance = $uibModal.open({
                    templateUrl: 'modal_multidelete.html',
                    controller: 'ModalMultiDeleteRole',
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
app.controller('ModalAddRole', function($scope,$uibModalInstance,role,$http){
    $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
    $scope.create=function () {
        $http.post('/admin/roles/create', {name:$scope.name}).then(function (res) {
            role.list_roles.push(res.data);
            swal({
               title: 'Create role success',
               type: 'success',
               showCancelButton: true,
               confirmButtonColor: '#4c7ff0',
               confirmButtonText: 'go to permission!',
           }, function() {
             //window.location.href='';
          });
            $uibModalInstance.dismiss('cancel');
        }, function (err) {
            swal('Create fail!', '', 'error');
        })
       
    }
});
app.controller('ModalDeleteRole',  function($scope,$uibModalInstance,role,$http,data){
    $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
    $scope.delete=function () {
       $http.delete('roles/delete/'+data.id).then(function (res) {
          role.list_roles.splice(role.list_roles.indexOf(res.data.id),1);
          $uibModalInstance.dismiss('cancel');
           swal('Delete Success!', '', 'success');
       }, function (err) {
           $uibModalInstance.dismiss('cancel');
           swal('Delete fail!', '', 'error');
       })
    }
})
app.controller('ModalMultiDeleteRole',  function($scope,$uibModalInstance,role,$http,data){
    $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
    $scope.delete=function () {
       $http.post('roles/multidelete/',data.list_id).then(function (res) {
        if(res.data=="true")
        {
          for (var i = 0; i < data.list_id.length; i++) {
              role.list_roles.splice(findWithAttr(role.list_roles,'id',data.list_id[i]),1);
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
app.controller('ModalwarningRole',function($scope,$uibModalInstance,role,$http){
     $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
})
app.controller('ModalEditRole',  function($scope,$uibModalInstance,role,$http,data){
    $scope.name=data.role.name;
    $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
    $scope.edit=function () {
       $http.post('roles/edit/',{id:data.role.id,name:$scope.name}).then(function (res) {
          $uibModalInstance.dismiss('cancel');
          role.list_roles[findWithAttr(role.list_roles,'id',res.data.id)]=res.data;
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