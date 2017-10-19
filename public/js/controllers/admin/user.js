var app=angular.module('hoc2h-user',[])
app.run(function(){
	console.log("hello user");	
})
app.controller('ctlUser', function($scope,$http){
    $http.get('/admin/users/api/getall').then(function (res) {
            $scope.users=res.data;
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
})