var app=angular.module('hoc2h-user',['ui.bootstrap'])
app.run(function(){
	console.log("hello user");	
})
app.factory('users', [function () {
    return {
        list_users:[]
    };
}])
app.controller('ctlUser', function($scope,$http,users,$uibModal){
    $http.get('/admin/users/api/getall').then(function (res) {
            users.list_users=res.data
            $scope.users=users.list_users;
        }, function (err) {
            console.log(err);
        })
        $scope.checkAll = function () {
        if ($scope.selectedAll) {
            $scope.selectedAll = true;
        } else {
            $scope.selectedAll = false;
        }
        angular.forEach($scope.users, function (faq) {
            faq.Selected = $scope.selectedAll;
        });
    };
    $scope.ban=function (id) {
           var modalInstance = $uibModal.open({
                templateUrl: 'ModalBan.html',
                controller: 'ModalBan',
                size:'md',
                 resolve: {
                    data:{
                        id:id,
                    }
                } 
            });
    }
    $scope.active=function (id) {
           var modalInstance = $uibModal.open({
                templateUrl: 'ModalActive.html',
                controller: 'ModalActive',
                size:'md',
                 resolve: {
                    data:{
                        id:id,
                    }
                } 
            });
    }
    $scope.delete=function (id) {
           var modalInstance = $uibModal.open({
                templateUrl: 'ModalDelete.html',
                controller: 'ModalDeleteUser',
                size:'md',
                 resolve: {
                    data:{
                        id:id,
                    }
                } 
            });
    }
    $scope.multiban=function () {
        var data = [];
            angular.forEach($scope.users, function(user) {
                if (user.Selected&&user.state!=0) {
                    data.push(user.id);
                }
            });
            console.log(data);
            if (data.length == 0) {
                var modalInstance = $uibModal.open({
                    templateUrl: 'modal_warning.html',
                    controller: 'ModalWarningUser',
                    size:'md', 
                    resolve: {
                        data:{
                           message:"Bạn chưa chọn hoặc không có user nào active !!",
                        }
                    } 
                });
            }
            else
            {
                var modalInstance = $uibModal.open({
                    templateUrl: 'ModalBan.html',
                    controller: 'ModalMultiBanUser',
                    size:'md', 
                    resolve: {
                        data:{
                            list_id:data,
                        }
                    } 
                });
            }
    }
     $scope.multiactive=function () {
        var data = [];
            angular.forEach($scope.users, function(user) {
                if (user.Selected&&user.state==0) {
                    data.push(user.id);
                }
            });
            console.log(data);
            if (data.length == 0) {
                var modalInstance = $uibModal.open({
                    templateUrl: 'modal_warning.html',
                    controller: 'ModalWarningUser',
                    size:'md', 
                    resolve: {
                        data:{
                            message:"Bạn chưa chọn hoặc không có user nào disable !!",
                        }
                    } 
                });
            }
            else
            {
                var modalInstance = $uibModal.open({
                    templateUrl: 'ModalActive.html',
                    controller: 'ModalMultiActiveUser',
                    size:'md', 
                    resolve: {
                        data:{
                            list_id:data,
                        }
                    } 
                });
            }
    }
    $scope.multidelete=function () {
        var data = [];
            angular.forEach($scope.users, function(user) {
                if (user.Selected) {
                    data.push(user.id);
                }
            });
            console.log(data);
            if (data.length == 0) {
                var modalInstance = $uibModal.open({
                    templateUrl: 'modal_warning.html',
                    controller: 'ModalWarningUser',
                    size:'md', 
                    resolve: {
                        data:{
                            message:"Bạn chưa chọn user !!",
                        }
                    } 
                });
            }
            else
            {
                var modalInstance = $uibModal.open({
                    templateUrl: 'modal_multidelete.html',
                    controller: 'ModalMultiDeleteUser',
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

app.controller('ModalMultiDeleteUser',function($scope,$http,users,data,$uibModalInstance){
     $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
     $scope.delete=function () {
        $http.post('/admin/users/multidelete', data.list_id).then(function (res) {
            swal('Delete Success!', '', 'success');
            $uibModalInstance.dismiss('cancel');
            for (var i = 0; i < data.list_id.length; i++) {
              users.list_users.splice(findWithAttr(users.list_users,'id',data.list_id[i]));
             }
        }, function (err) {
            $uibModalInstance.dismiss('cancel');
            swal('Delete fail!', '', 'error');
        })
    }
})
app.controller('ModalMultiBanUser',function($scope,$http,users,data,$uibModalInstance){
    $scope.message="Bạn có chắc chắn muốn ban các user này !";
     $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
     $scope.ban=function () {
        $http.post('/admin/users/multiban', data.list_id).then(function (res) {
            swal('Ban Success!', '', 'success');
            $uibModalInstance.dismiss('cancel');
            for (var i = 0; i < data.list_id.length; i++) {
              users.list_users[findWithAttr(users.list_users,'id',data.list_id[i])].state=0;
             }
        }, function (err) {
            $uibModalInstance.dismiss('cancel');
            swal('Ban fail!', '', 'error');
        })
    }
})
app.controller('ModalMultiActiveUser',function($scope,$http,users,data,$uibModalInstance){
    $scope.message="Bạn có chắc chắn muốn active các user này !";
     $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
     $scope.active=function () {
        $http.post('/admin/users/multiactive', data.list_id).then(function (res) {
            swal('active Success!', '', 'success');
            $uibModalInstance.dismiss('cancel');
            for (var i = 0; i < data.list_id.length; i++) {
              users.list_users[findWithAttr(users.list_users,'id',data.list_id[i])].state=1;
             }
        }, function (err) {
            $uibModalInstance.dismiss('cancel');
            swal('active fail!', '', 'error');
        })
    }
})
app.controller('ModalBan',function($scope,$http,users,data,$uibModalInstance){
    $scope.message="Bạn có chắc chắn muốn ban user này !";
     $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
     $scope.ban=function () {
        $http.post('/admin/users/ban', {id:data.id}).then(function (res) {
            users.list_users[findWithAttr(users.list_users,'id',data.id)]=res.data;
            swal('Ban Success!', '', 'success');
            $uibModalInstance.dismiss('cancel');
        }, function (err) {
            $uibModalInstance.dismiss('cancel');
            swal('Create fail!', '', 'error');
        })
    }
})
app.controller('ModalActive',function($scope,$http,users,data,$uibModalInstance){
     $scope.message="Bạn có chắc chắn muốn active user này !";
     $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
     $scope.active=function () {
        $http.post('/admin/users/active', {id:data.id}).then(function (res) {
            users.list_users[findWithAttr(users.list_users,'id',data.id)]=res.data;
            swal('Active Success!', '', 'success');
            $uibModalInstance.dismiss('cancel');
        }, function (err) {
            $uibModalInstance.dismiss('cancel');
            swal('Create fail!', '', 'error');
        })
    }
})
app.controller('ModalDeleteUser',function($scope,$http,users,data,$uibModalInstance){
     $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
     $scope.delete=function () {
        $http.delete('/admin/users/delete/'+data.id).then(function (res) {
            users.list_users.splice([findWithAttr(users.list_users,'id',data.id)],1);
            swal('Delete Success!', '', 'success');
            $uibModalInstance.dismiss('cancel');
        }, function (err) {
            $uibModalInstance.dismiss('cancel');
            swal('Create fail!', '', 'error');
        })
    }
})
app.controller('ModalWarningUser',function($scope,$http,users,data,$uibModalInstance){
    $scope.message=data.message;
     $scope.cancel=function () {
        $uibModalInstance.dismiss('cancel');
    }
})
 function findWithAttr(array, attr, value) {
        for (var i = 0; i < array.length; i += 1) {
            if (array[i][attr] === value) {
                return i;
            }
        }
        return -1;
    }