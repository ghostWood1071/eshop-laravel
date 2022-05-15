app.controller('user', ($scope, $http)=>{
    $scope.users = [];
    $scope.load = ()=>{
        let start = ($scope.currentPage-1)*$scope.maxSize;
        let end = start + $scope.maxSize;
        $scope.users = $scope.data.slice(start, end);
    }

    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/user'
    }).then((res)=>{
        $scope.data = res.data;
        $scope.currentPage = 1;
        $scope.totalItems = $scope.data.length;
        $scope.maxSize = 10+"";
        $scope.load();
    }, (err)=>{
        console.log(err);
    });
    
    $scope.save = ()=>{
        if($scope.state == "create"){
            $http({
                method: 'POST',
                url: 'http://127.0.0.1:8000/api/user',
                header: {'content-type': 'application/json'},
                data: $scope.user
            }).then((res)=>{
                $scope.users.push(res.data);
                $("#updatemodal").modal('hide');
            }, (err)=>{
                console.log(err);
            });
        } else{
            $http({
                method: 'PUT',
                url: 'http://127.0.0.1:8000/api/user/'+$scope.selected,
                header: {'content-type': 'application/json'},
                data: $scope.user
            }).then((res)=>{
                $scope.users[$scope.index] = res.data;
                $("#updatemodal").modal('hide');
            }, (err)=>{
                console.log(err);
            });
        }
    }

    $scope.openModal = (id, index)=>{
        if(id != -1){
            $scope.title = "Update row";
            $scope.selected = id;
            $scope.index = index;
            $scope.state = "update";
            $scope.user = Object.assign({},$scope.users[index]);
        } else {
            $scope.user = null;
            $scope.title = "Create new";
            $scope.state = "create"
        }
        $("#updatemodal").modal('show');
    }

    $scope.openConfirm =(id, index)=>{
        $("#deletemodal").modal('show');
        $scope.selected = id;
        $scope.index = index;
    }

    $scope.delete = ()=>{
        $http({
            method: 'DELETE',
            url: 'http://127.0.0.1:8000/api/user/'+$scope.selected,
        }).then((res)=>{
            $scope.users.splice($scope.index, 1);
            $("#deletemodal").modal('hide');
        }, (err)=>{

        });
    }
});
