app.controller('category', ($scope, $http)=>{
    $http({
        method: 'GET',
        url: 'http://localhost:8000/api/shopping/get-categories'
    }).then((res)=>{
        $scope.categories = res.data;
    }, (err)=>{
        console.log(err);
    })
});