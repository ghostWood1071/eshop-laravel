app.controller('order', ($scope, $http)=>{
    function Authenthicate(){
        console.log("ok");
        return new Promise((resolve, reject)=>{
            $http({
                method: 'GET',
                url: 'http://127.0.0.1:8000/authenthicate/auth'
            }).then((res)=>{
                if(res.data!=0){
                    resolve(res.data);
                    return;
                }
                toastr.warning('You must login');
                resolve(res.data);
            }, (err)=>{
                toastr.warning('You must login');
                reject(err);
            });
        });
    }

    async function getOrders(){
        
        $scope.user_id = await Authenthicate();
        
        if($scope.user_id == '')
            location.href='/';

        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/shopping/orders/'+ $scope.user_id
        }).then((res)=>{
            for(var i = 0; i<res.data.length; i++)
                res.data[i].status+="";
            $scope.orders = res.data;
            console.log(res.data);
        }, (err)=>{
            console.log(err);
        });
    }
    
    getOrders();

    $scope.save = (index)=>{
        let order = $scope.orders[index];
        order.status = 5;
        $http({
            method: 'PUT',
            url: 'http://127.0.0.1:8000/api/shopping/orders/update',
            data: order
        }).then((res)=>{
            $scope.orders[index].status = 5+"";
            toastr.success('your order was updated');
        }, (err)=>{
            console.log(err);
        })
    }
    
});