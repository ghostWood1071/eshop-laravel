
app.controller('search', ($scope, $http)=>{
    $scope.search =()=>{
        sessionStorage.setItem('keyword', $scope.keyword==undefined?"":$scope.keyword);
        location.href="/product"
    }
});