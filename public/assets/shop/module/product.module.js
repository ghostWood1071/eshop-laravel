
app.controller('product', ($scope, $http)=>{
    
    $scope.products = [];

    $scope.txtSearch = getKeyWord();

    $scope.loadProducts = ()=>{
        console.log("hello");
        let start = ($scope.currentPage-1)*$scope.maxSize;
        let end = start + $scope.maxSize;
        $scope.products = $scope.data.slice(start, end);
    }

    $scope.getProductAccordingCategory = (id)=>{
        $scope.txtSearch = id;
    }

    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/shopping/products'
    }).then((res)=>{
        console.log(res.data);
        $scope.data = res.data; 
        $scope.totalItems = res.data.length; //res.data.length;
        $scope.currentPage = 1,
        $scope.maxSize = 10;
        $scope.loadProducts();
    }, (err)=>{
        console.log(err);
    });
});