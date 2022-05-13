app.controller('category', ($scope, $http)=>{
    $scope.categories = [];

    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/category'
    }).then((res)=>{
        $scope.categories = res.data;
    }, (err)=>{
        console.log(err);
    });
    
    $scope.save = ()=>{
        if($scope.state == "create"){
            $http({
                method: 'POST',
                url: 'http://127.0.0.1:8000/api/category',
                'content-type': 'application/json',
                data: $scope.cate
            }).then((res)=>{
    
                $scope.categories.push(res.data);
                $("#updatemodal").modal('hide');
            }, (err)=>{
                console.log(err);
            });
        } else{
            $http({
                method: 'PUT',
                url: 'http://127.0.0.1:8000/api/category/'+$scope.selected,
                'content-type': 'application/json',
                data: $scope.cate
            }).then((res)=>{
                $scope.categories[$scope.index] = res.data;
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
            $scope.cate = Object.assign({},$scope.categories[index]);
        } else {
            $scope.cate = null;
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
            url: 'http://127.0.0.1:8000/api/category/'+$scope.selected,
        }).then((res)=>{
            $scope.categories.splice($scope.index, 1);
            $("#deletemodal").modal('hide');
        }, (err)=>{

        });
    }
});
