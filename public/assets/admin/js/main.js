var app = angular.module('admin', ['chart.js', 'ui.bootstrap']);

app.controller('sidebar', ($http, $scope)=>{
    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/username',
    }).then((res)=>{
        $scope.fullname = res.data;
    },(err)=>{
        console.log(err);
    })
});
