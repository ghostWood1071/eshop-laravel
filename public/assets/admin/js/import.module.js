app.controller('import', ($scope, $http)=>{
    $scope.imports = [];
    $scope.users = [];
    $scope.products = [];
    $scope.details = [];
    $scope.colors = [];
    $scope.detailUploads = [];

    $scope.load = ()=>{
        let start = ($scope.currentPage-1)*$scope.maxSize;
        let end = start + $scope.maxSize;
        $scope.imports = $scope.data.slice(start, end);
    }

    $scope.loadPr = ()=>{
        let start = ($scope.pcurrentPage-1)*$scope.pmaxSize;
        let end = start + $scope.pmaxSize;
        $scope.products = $scope.productData.slice(start, end);
    }
    //get list imports
    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/import'
    }).then((res)=>{
        //$scope.imports = res.data;
        $scope.data = res.data;
        $scope.currentPage = 1;
        $scope.maxSize = 10+"";
        $scope.totalItems = res.data.length;
        $scope.load();
    }, (err)=>{
        console.log(err);
    });

    //get user
    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/user'
    }).then((res)=>{
        $scope.users = res.data;
    }, (err)=>{
        console.log(err);
    });

    //get products
    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/product/create'
    }).then((res)=>{
        $scope.productData = res.data;
        $scope.pcurrentPage = 1;
        $scope.pmaxSize = 20+"";
        $scope.ptotalItems = res.data.length;
        $scope.loadPr();
    }, (err)=>{
        console.log(err);
    });
    
    //get import details
    $scope.getDetails = (id)=>{
        $http({
            url: 'http://127.0.0.1:8000/api/import-detail/'+id,
            method: 'GET'
        }).then((res)=>{
            console.log(res.data);
            let detail;
            let details = [];
            for(var d of res.data){
                detail = d;
                detail.colors = JSON.parse(d.colors);
                let index = $scope.products.findIndex(x=>x.product.id == detail.product_id);
                $scope.products[index].check = true;
                details.push(detail);
            }
            $scope.details = details;
        }, (err)=>{
            console.log(err);
        });
    }

    //get colors
    $scope.getColors = (id)=>{
        $http({
            url: 'http://127.0.0.1:8000/api/color/'+id,
            method: 'GET'
        }).then((res)=>{
            console.log(res.data);
            $scope.colors = res.data;
        }, (err)=>{
            console.log(err);
        })
    }


    //choose product to import 
    $scope.chooseProduct =(index)=>{
        let product = $scope.products[index];
        console.log(product);
        if(product.check==true || product.check == null){
            let detail = {
                id: null,
                product_index: index,
                product_id: product.product.id,
                import_id: '',
                image: product.image[0].name,
                name: product.product.name+"-"+product.name,
                color_id: product.id,
                size: '',
                quantity: 0,
                import_price: 0,
                sold_price: 0,
                unit_price: 0,
                state: 1
            }
            $scope.details.push(detail);
            
        }
        else {
            let i = $scope.details.findIndex(x=>x.product_index == index);
            $scope.details.splice(i, 1);
        }
        
    }


    //detect change state
    $scope.change = (index)=>{
        if($scope.details[index].id !=null)
            $scope.details[index].state = 0;
    }

    //avoid to edit when imported product
    $scope.avoid = (id)=>{
        if (id==null)
            return '';
        return 'disabled';
    }


    //choose color
    $scope.chooseColor = (product_id, index)=>{
        console.log(product_id);
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/color/'+product_id
        }).then((res)=>{
            $scope.details[index].colors= res.data;
            console.log(res.data);
        }, (err)=>{
            console.log(err);
        });
    }

    //confirm to delete detail
    $scope.confirmDetail = (index)=>{
        $scope.detailIndex = index;
        $("#deletedetailmodal").modal("show");
    }

    //remove detail
    $scope.removeDetail = ()=>{
        let detail = Object.assign({}, $scope.details[$scope.detailIndex]);
        $scope.details.splice($scope.detailIndex, 1);
        detail.state=2;
        $scope.detailUploads.push(detail);
        $("#deletedetailmodal").modal("hide");
    }


    // save the import
    $scope.save = ()=>{
        var total = 0;
        for(var d of $scope.details)
            total+=d.quantity*d.import_price; //caculate total price

        if($scope.state == "create"){
            $http({
                method: 'POST',
                url: 'http://127.0.0.1:8000/api/import',
                header: {'content-type': 'application/json'},
                data: {
                    id: null,
                    user_id: $scope.import.user_id,
                    import_date: $scope.import.import_date,
                    total_price: total,
                    details: $scope.details
                }
            }).then((res)=>{
                console.log(res.data);
                $scope.imports.push(res.data);
                $("#updatemodal").modal('hide');
            }, (err)=>{
                console.log(err);
            });
            
        } else{
            for(var d of $scope.details)
                $scope.detailUploads.push(d);
            $http({
                method: 'PUT',
                url: 'http://127.0.0.1:8000/api/import/'+$scope.selected,
                'content-type': 'application/json',
                data: {
                    id: $scope.selected,
                    user_id: $scope.import.user_id,
                    import_date: $scope.import.import_date,
                    total_price: total,
                    details: $scope.detailUploads
                }
            }).then((res)=>{
                console.log(res);
                $scope.imports[$scope.index] = res.data;
                $("#updatemodal").modal('hide');
            }, (err)=>{
                console.log(err);
            });
        }
    }


    //open modal to add or update
    $scope.openModal = (id, index)=>{
        if(id != -1){
            $scope.title = "Update row";
            $scope.selected = id;
            $scope.index = index;
            $scope.state = "update";
            $scope.import = Object.assign({},$scope.imports[index]);
            $scope.getDetails($scope.import.id);
        } else {
            $scope.import = null;
            $scope.details = [];
            for(var p of $scope.products)
                p.check = false;
            $scope.title = "Create new";
            $scope.state = "create"
        }
        $("#updatemodal").modal('show');
    }


    //confirm delete import
    $scope.openConfirm =(id, index)=>{
        $("#deletemodal").modal('show');
        $scope.selected = id;
        $scope.index = index;
    }


    //delete import
    $scope.delete = ()=>{
        $http({
            method: 'DELETE',
            url: 'http://127.0.0.1:8000/api/import/'+$scope.selected,
        }).then((res)=>{
            $scope.imports.splice($scope.index, 1);
            $("#deletemodal").modal('hide');
        }, (err)=>{
            console.log(err);
        });
    }

    $scope.closeUpdateModal = ()=>{
        $('#updatemodal').modal('hide');
        for(var p of $scope.products)
            p.check = false;
    }
});