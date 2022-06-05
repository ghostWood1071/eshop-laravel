app.controller('index', ($scope, $http)=>{
    $scope.categories = [];
    $scope.trends = [];
    $scope.cate_id = "";
    $scope.latests = [];
    $scope.sales = [];
    $scope.images = [];
    $scope.colors = [];
    $scope.sizes = [];
    $scope.product = null;
    $scope.selected_color = null;
    $scope.price = 0;

    $scope.getTrending =(cate_id)=>{
        let url = 'http://127.0.0.1:8000/api/shopping/get-trending/'+cate_id+"/"+8;
        console.log(url);
        $http({
            method: 'GET',
            url: url,
        }).then((res)=>{
            $scope.trends = res.data;
            console.log(res.data);
        }, (err)=>{
            console.log(err);
        })
    }

    //get categories
    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/shopping/get-categories'
    }).then((res)=>{
        $scope.categories = res.data;
        $scope.cate_id = $scope.categories[0].id;
        $scope.getTrending($scope.cate_id);
    }, (err)=>{
        console.log(err);
    });
    
    //get latests
    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/shopping/get-new/'+8
    }).then((res)=>{
        $scope.latests = res.data;
        console.log(res.data);
    }, (err)=>{
        console.log(err);
    });

    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/shopping/get-sales/'+8
    }).then((res)=>{
        $scope.sales = res.data;
        console.log(res.data);
    }, (err)=>{
        console.log(err);
    });

    $scope.getPrice = (id)=>{
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/shopping/get-price/'+id
        }).then((res)=>{
            $scope.price = res.data[0].sold_value;
            console.log(res.data);
        }, (err)=>{
            console.log(err);
        });
    }
    $scope.getSizes = (id)=>{
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/shopping/get-sizes/'+id
        }).then((res)=>{
            $scope.sizes = res.data;
        }, (err)=>{
            console.log(err);
        });
    }
    $scope.getColors = (id)=>{
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/shopping/get-colors/'+id
        }).then((res)=>{
            $scope.colors = res.data;
            $scope.selected_color = res.data[0];
            $scope.getPrice($scope.selected_color.id);
            $scope.getSizes($scope.selected_color.id);
        }, (err)=>{
            console.log(err);
        });
    }
    $scope.getImages = (id)=>{
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/shopping/get-images/'+id
        }).then((res)=>{
            $scope.images = res.data;
            console.log(res.data);
        }, (err)=>{
            console.log(err);
        });
    }
    $scope.getProduct = (id)=>{
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/shopping/get-product/'+id
        }).then((res)=>{
            console.log(res.data);
            $scope.product = res.data[0];
        }, (err)=>{
            console.log(err);
        });
    }
});