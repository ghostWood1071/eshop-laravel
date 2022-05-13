var app = angular.module('shop', ['ui.bootstrap']);
// app.config(function(paginationTemplateProvider) {
//     paginationTemplateProvider.setPath('/js/paginate/customTemplate.html');
// });

function getKeyWord(){
	let key = sessionStorage.getItem('keyword');
	if(key == null )
		return "";
	return key;
}

function getParam(paramName){
    var urlString = window.location.href;
    var url = new URL(urlString);
    var value = url.searchParams.get(paramName);
    return value;
}

app.controller('shared', ($scope, $http)=>{
    $scope.categories = [];
    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/shopping/get-categories'
    }).then((res)=>{
        $scope.categories = res.data;
    }, (err)=>{
        console.log(err);
    });
    $scope.search = ()=>{
        window.sessionStorage.setItem('keyword', $scope.keyword);
        location.replace('/product');
    }
});

app.controller('login', ($scope, $http)=>{
    $scope.login = ()=>{
        $http({
            method: 'POST',
            url: 'http://127.0.0.1:8000/authenthicate/login',
            data: {
                account: $scope.account,
                password: $scope.password
            }
        }).then((res)=>{
            console.log(res.data);
            if(res.data==1)
                window.location.href = "/auththenthicate/redirect";
            toastr.error('Your account or password is incorrect');
        }, (err)=>{
            console.log(err);
        })
    }

    $scope.auth = ()=>{
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/authenthicate/auth'
        }).then((res)=>{
            if(res.data!=0){
                window.location.href = "/checkout";
                return;
            }
            toastr.warning('You must login before make a payment');
        }, (err)=>{
            toastr.warning('You must login before make a payment');
        })
    }
});
