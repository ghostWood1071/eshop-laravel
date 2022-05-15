app.controller('order', ($scope, $http)=>{
    $scope.orders = [];
    $scope.updates = [];

    $scope.load = ()=>{
        let start = ($scope.currentPage-1)*$scope.maxSize;
        let end = start + $scope.maxSize;
        $scope.orders = $scope.data.slice(start, end);
    }

    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/order'
    }).then((res)=>{
        for(let item of res.data){
            item.status+="";
        }
        $scope.data = res.data;
        $scope.currentPage = 1;
        $scope.totalItems = $scope.data.length;
        $scope.maxSize = 10+"";
        $scope.load();
    }, (err)=>{
        console.log(err);
    });

    $scope.getStatus = (st)=>{
        if(st==0) return "ordered";
        if(st==1) return "preparing"; 
        if(st==2) return "transporting"
        if(st==3) return "shipping";
        if(st==4) return "successful delivery";
    }

    $scope.getPayment = (payment)=>{
        return payment==0?'online':'offline';
    }

    $scope.openModal = (index)=>{
        $('#updatemodal').modal('show');
        $order = $scope.orders[index];
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/order-detail/'+$order.id
        }).then((res)=>{
            $scope.details = res.data;
        },(err)=>{
            console.log(err);
        });
    }

    $scope.change = (o)=>{
        let index = $scope.updates.findIndex(x=>x.id==o.id);
        if(index == -1){
            $scope.updates.push(o);
        }
        else
            $scope.updates[index].status = o.status;
        console.log($scope.updates);
    }

    $scope.save = ()=>{
        $http({
            method: 'PUT',
            url: 'http://127.0.0.1:8000/api/order/update',
            data: $scope.updates
        }).then((res)=>{
            console.log(res.data);
            toastr.success('updated sucessfully');
        }, (err)=>{
            console.log(err);
        });
    }
});