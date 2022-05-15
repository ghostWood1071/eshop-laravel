app.controller('dashboard', ($scope, $http)=>{
    let curentDate = new Date();
    $scope.datasetOverride = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2' }];
    $scope.series = ['Profit'];
    $scope.monthOptions = {
        scales: {
          yAxes: [
            {
              id: 'y-axis-1',
              type: 'linear',
              display: true,
              position: 'left'
            },
            {
              id: 'y-axis-2',
              type: 'linear',
              display: true,
              position: 'right'
            }
          ]
        }
    };
    $scope.months = ['January','February','March','April','May','June','July','August','September','October','November','December']

    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/dashboard/get-month-profit/'+curentDate.getFullYear(),
    }).then((res)=>{
        $scope.monthData = [];
        let dict = {}
        res.data.forEach(x=>dict[`${x.month-1}`]=x.profit);
        for(var i = 0; i<12; i++){
            if(dict[`${i}`] == undefined)
                $scope.monthData[i] = 0;
            else $scope.monthData[i] = dict[`${i}`];    
        }
        console.log($scope.monthData);
    }, (err)=>{
        
    });

    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/dashboard/get-year-profit/'+5,
    }).then((res)=>{
        $scope.yearData = res.data.map(x=>x.profit);
        $scope.years = res.data.map(x=>x.year)
    }, (err)=>{
        
    });

    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/shopping/get-trending/null/10',
    }).then((res)=>{
        $scope.products = res.data;
    }, (err)=>{
        console.log(err);
    });

    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/dashboard/get-loyal-customer/'+5,
    }).then((res)=>{
        $scope.customers = res.data;
    }, (err)=>{
        console.log(err);
    });

});