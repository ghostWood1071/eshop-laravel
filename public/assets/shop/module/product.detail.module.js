app.controller('product_detail', ($scope, $http)=>{
    let productId = getParam('id');
    $scope.colorId = getParam('color_id');
    $scope.quantity = 1;

    $scope.getSizes = () =>{
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/shopping/get-sizes/'+$scope.colorId
        }).then((res)=>{
            $scope.sizes = res.data;
            console.log($scope.sizes);
        }, (err)=>{
            console.log(err);
        });
    }

    $scope.getImages = () =>{
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/shopping/get-images/'+$scope.colorId
        }).then((res)=>{
            $scope.images = res.data;
            $scope.image = res.data[0];
            console.log(res.data);
        }, (err)=>{
            console.log(err);
        });
    }

    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/shopping/get-product/'+productId 
    }).then((res)=>{
        $scope.product = res.data;
        console.log($scope.product);
    }, (err)=>{
        console.log(err);
    });
    
    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/shopping/get-colors/'+productId
    }).then((res)=>{
        $scope.colors = res.data;
        if($scope.colors.length>0)
            $scope.color = $scope.colors[0];
        console.log($scope.colors);
    }, (err)=>{
        console.log(err);
    });

    $scope.getSizes();
    $scope.getImages();

    $scope.chooseSize = (index)=>{
        $scope.size = $scope.sizes[index];
        $scope.inStock = $scope.size.quantity;
        $scope.quantity = 1;
    }

    $scope.chooseColor = (index)=>{
        $scope.color = $scope.colors[index];
        $scope.colorId = $scope.color.id;
        $scope.size = undefined;
        $scope.getSizes();
        $scope.getImages();
    }

    $scope.chooseImg = (index)=>{
        $scope.image = $scope.images[index];
    }

    $scope.minus = ()=>{
        if($scope.quantity-1<=0)
            return;
        $scope.quantity-=1; 
    }

    $scope.plus = ()=>{
        if($scope.quantity+1 > $scope.size.quantity)
            return;
        $scope.quantity+=1;
    }

});