app.controller('checkout', ($scope, $http)=>{
    $scope.carts = [];
    $scope.total = 0;
    $scope.sale = 0;
    $scope.payment = ()=>{
        $scope.total = 0;
        $scope.sale = 0;
        for(let item of $scope.carts){
            $scope.total+=item.price*item.quantity;
            $scope.sale+=item.price*item.quantity-item.price*item.discount*item.quantity;
        }
    }
    if(localStorage.getItem('carts') != null){
        $scope.carts = JSON.parse(localStorage.getItem('carts'));
        $scope.payment();
    }

    function Authenthicate(){
        return new Promise((resolve, reject)=>{
            $http({
                method: 'GET',
                url: 'http://127.0.0.1:8000/authenthicate/auth'
            }).then((res)=>{
                if(res.data!=0){
                    resolve(res.data);
                    return;
                }
                toastr.warning('You must login before make a payment');
                resolve(res.data);
            }, (err)=>{
                toastr.warning('You must login before make a payment');
                reject(err);
            });
        });
    }

    $scope.pay = async ()=>{
        if($scope.carts.length==0){
            toastr.warning("your carts is empty");
        }
        try {
            let auth = await Authenthicate();
            if(auth == 0){
                toastr.warning("you must login before make a payment");
                return;
            }
            let payment = {
                user_id: auth,
                address: "name: "+$scope.fullname+" phone: "+$scope.phone+" address: "+$scope.address,
                total_price: $scope.sale,
                payment: $scope.online==true?1:0,
                details: $scope.carts
            }
            $http({
                method: 'POST',
                url: 'http://127.0.0.1:8000/api/order',
                data: payment
            }).then((res)=>{
                console.log(res.data);
                toastr.success('create order successfully');
                $scope.carts=[];
                $scope.payment();
                localStorage.setItem('carts', JSON.stringify($scope.carts));
            }, (err)=>{
                console.log(err);
            })
        } catch(e){
            console.log(e);
        }
    }
});