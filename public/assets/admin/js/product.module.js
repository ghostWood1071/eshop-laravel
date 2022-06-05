app.controller('product', ($scope, $http)=>{
    $scope.products = [];
    $scope.categories = [];
    $scope.colors = [];
    $scope.formData  = new FormData();
    $scope.selectedColorFiles = [];
    $scope.colorFiles = [];
    $scope.imgPreviewIndex = 0;
    $scope.selectedColorIndex = -1;
    $scope.images = [];

    $scope.load = ()=>{
        let start = ($scope.currentPage-1)*$scope.maxSize;
        let end = start + $scope.maxSize;
        $scope.products = $scope.data.slice(start, end);
    }
    
    //load product
    $scope.loadProduct = ()=>{
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/product'
        }).then((res)=>{
            $scope.data = res.data;
            $scope.currentPage = 1;
            $scope.totalItems = $scope.data.length;
            $scope.maxSize = 10+"";
            $scope.load();
        }, (err)=>{
            console.log(err);
        });
    }
    
    $scope.loadProduct();

    //load category
    $http({
        method: 'GET',
        url: 'http://127.0.0.1:8000/api/category'
    }).then((res)=>{
        $scope.categories = res.data;
    }, (err)=>{
        console.log(err);
    });
    
    //upload product
    $scope.save = ()=>{
        if($scope.state == "create"){
            let files = $scope.colorFiles.flatMap(f=>f);
            for(var f of files)
                $scope.formData.append('file[]', f);
            $http({
                method: 'POST',
                url: 'http://127.0.0.1:8000/api/file',
                data: $scope.formData,
                headers: {'Content-Type': undefined}
            }).then((res)=>{
                $scope.postProduct(res.data);
            },(err)=>{
                console.log(err);
            });

        } else{
            let colors = $scope.colors.filter(x=>x.state==0);
            if(colors.length>0){
                let files = $scope.colorFiles.flatMap(f=>f);
                $scope.formData = new FormData();
                for(var f of files)
                    $scope.formData.append('file[]', f);
                $http({
                    method: 'POST',
                    url: 'http://127.0.0.1:8000/api/file',
                    data: $scope.formData,
                    headers: {'Content-Type': undefined}
                }).then((res)=>{
                    $http({
                        method: 'PUT',
                        url: 'http://127.0.0.1:8000/api/product/'+$scope.selected,
                        'content-type': 'application/json',
                        data: {
                           product: $scope.product,
                           colors: colors,
                           images: res.data
                        }
                    }).then((res)=>{
                        $scope.products[$scope.index] = res.data[0];
                        $("#updatemodal").modal('hide');
                    }, (err)=>{
                        console.log(err);
                    });
                },(err)=>{
                    console.log(err);
                })
            } else{
                $http({
                    method: 'PUT',
                    url: 'http://127.0.0.1:8000/api/product/'+$scope.selected,
                    'content-type': 'application/json',
                    data: {
                        product:  $scope.product,
                        colors: [],
                        images: []
                    }
                }).then((res)=>{
                    $scope.products[$scope.index] = res.data[0];
                    $("#updatemodal").modal('hide');
                }, (err)=>{
                    console.log(err);
                });
            }
            
        }
    }

    $scope.openModal = (id, index)=>{
        if(id !=-1){
            $scope.title = "Update product";
            $scope.selected = id;
            $scope.index = index;
            $scope.state = "update";
            let selectedProduct = Object.assign({},$scope.products[index]);
            $scope.product = selectedProduct;
            $scope.selectedColorIndex = -1;
            $scope.getColors();
        } else {
            $scope.product = null;
            $scope.title = "Create new";
            $scope.state = "create"
            $scope.colors = [];
            $scope.selectedColorIndex = -1;
            $scope.color = null;
        }
        $("#updatemodal").modal('show');
    }

    $scope.openConfirm =(id, index)=>{
        $("#deletemodal").modal('show');
        $scope.selected = id;
        $scope.index = index;
    }

    $scope.delete = ()=>{
        $http({
            method: 'DELETE',
            url: 'http://127.0.0.1:8000/api/product/'+$scope.selected,
        }).then((res)=>{
            $scope.data.splice($scope.index, 1);
            $("#deletemodal").modal('hide');
            $scope.totalItems = $scope.data.length;
            $scope.load();
        }, (err)=>{
            console.log(err);
        });
    }

    $scope.upload = ()=>{

        var fd = new FormData();
        angular.forEach($scope.uploadfiles,function(file){
            fd.append('file[]',file);
        });

        $http({
            method: 'post',
            url: 'http://127.0.0.1:8000/api/file',
            data: fd,
            headers: {'Content-Type': undefined},
        }).then(function successCallback(response) {  
            $scope.response = response.data;
        });
    }

    $scope.postProduct = (files)=>{
        $http({
            method: 'POST',
            url: 'http://127.0.0.1:8000/api/product',
            data: {
                product: $scope.product,
                colors: $scope.colors,
                fs: files,
            }
        }).then((res)=>{
            $scope.data.push(res.data[0]);
            $scope.colors = [];
            $scope.colorFiles=[];
            $scope.selectedColorFiles = [];
            $scope.formData = new FormData();
            $scope.totalItems = $scope.data.length;
            $scope.load();
            $("#updatemodal").modal('hide');
        }, (err)=>{
            console.log(err);
        });
    }

    //for color
    //add color
    $scope.addColor = ()=>{
        let files = Object.assign([], $('#file')[0].files);
        if(files.length>0 && $scope.color.name!=null && $scope.color.value !=null){
            $scope.color.price = 0;
            $scope.color.state = 0;
            $scope.color.quantity = 0;
            $scope.colors.push($scope.color);
            $scope.colorFiles.push(files);
            $($('#file')[0]).val(null);
            $scope.color = null;
        }
    }
    //choose color
    $scope.chooseColor = (index)=>{
        $scope.color = Object.assign({}, $scope.colors[index]);
        $scope.selectedColorFiles = $scope.colorFiles[index];
        $scope.selectedColorIndex = index;
    }
    //set color for selected row
    $scope.getColorForColorRow =(index)=>{
        if(index == $scope.selectedColorIndex)
            return "#a9c9eb";
        return "white";
    }
    //delete color
    $scope.removeColor = ()=>{
        let id = $scope.colors[$scope.selectedColorIndex].id;
        let index = $scope.selectedColorIndex;
        if(id != null){
            console.log(id);
            $http({
                method: 'DELETE',
                url: 'http://127.0.0.1:8000/api/color/'+id
            }).then((res)=>{
                $scope.colors.splice(index, 1);
                $scope.colorFiles.splice(index, 1 );
                $scope.selectedColorIndex = -1;
                $scope.selectedColorFiles = [];
                $("#deletecolormodal").modal("hide");
            }, (err)=>{
                console.log(err);
            }); 
            return;
        }
        $scope.colors.splice(index, 1);
        $scope.colorFiles.splice(index, 1 );
        $scope.selectedColorIndex = -1;
        $scope.selectedColorFiles = [];
        $("#deletecolormodal").modal("hide");
    }
    // put color
    $scope.putColor = (response)=>{
        let names = response==null?[]:response.data;
        $http({
            method: 'PUT',
            url: 'http://127.0.0.1:8000/api/color/'+ $scope.color.id,
            data: {
                color: $scope.color,
                images: names
            }
        }).then((res)=>{
            $scope.colors[$scope.selectedColorIndex] = Object.assign({}, $scope.color);
            $scope.color=null;
            if(names.length>0)
                $scope.loadProduct();
        }, (err)=>{
            console.log(err);
        })
    }
    //update color 
    $scope.updateColor =()=>{
        if($scope.state == "update"){   
            let files = $('#file')[0].files;
            if(files.length==0)
                $scope.putColor(null);
            else{
                for(var f of files)
                    $scope.formData.append('file[]', f);
                $http({
                    method: 'POST',
                    url: 'http://127.0.0.1:8000/api/file/', 
                    headers: {'Content-Type': undefined},
                    data: $scope.formData
                }).then((res)=>{
                    $scope.formData = new FormData();
                    $scope.putColor(res);
                }, (err)=>{
                    console.log(err);
                });
            }
        } else{
            $scope.colors[$scope.selectedColorIndex] = Object.assign({}, $scope.color);
            $scope.color=null;
        }
        
    }
    //get color acording product_id
    $scope.getColors =()=>{
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/color/'+$scope.selected
        }).then((res)=>{
            $scope.colors = res.data;
        }, (err)=>{
            console.log(err);
        })
    }
    //open confirm color
    $scope.openConfirmColor = (index)=>{
        $scope.selectedColorIndex = index;
        $("#deletecolormodal").modal("show");
    }

    //image
    //load preview 
    $scope.loadPreviewImg = ()=>{
        if($scope.selectedColorFiles.length == 0){
            let files = $('#file')[0].files;
            if(files.length == 0)
                return;
            if($scope.imgPreviewIndex>=files.length || $scope.imgPreviewIndex<0)
                $scope.imgPreviewIndex = files.length-1;
            $scope.preview = URL.createObjectURL(files[$scope.imgPreviewIndex]);
            return;
        }
        if($scope.imgPreviewIndex>=$scope.selectedColorFiles.length || $scope.imgPreviewIndex<0)
            $scope.imgPreviewIndex = $scope.selectedColorFiles.length-1;
        $scope.preview = URL.createObjectURL($scope.selectedColorFiles[$scope.imgPreviewIndex]);
    }
    //load uploaded when choose a color
    $scope.loadUploadedImg = ()=>{
        if($scope.images.length == 0)
            return;
        if($scope.imgPreviewIndex>=$scope.images.length || $scope.imgPreviewIndex<0)
            $scope.imgPreviewIndex = $scope.images.length-1;
        $scope.preview = "/upload/"+$scope.images[$scope.imgPreviewIndex].name;
    }
    //get images from server
    $scope.getImages = ()=>{
        let id = $scope.colors[$scope.selectedColorIndex].id;
        $http({
            method: 'GET',
            url: 'http://127.0.0.1:8000/api/image/'+id
        }).then((res)=>{    
            $scope.images = res.data;
            $scope.loadUploadedImg();
        }, (err)=>{
            console.log(err);
        });
    }
    //click eye to view color's images
    $scope.viewImage = ()=>{
        $("#view-image-modal").modal('show');
        if($scope.state == 'update'){
            $scope.getImages();
            return;
        } else
        $scope.loadPreviewImg();
    }
    //view next image
    $scope.viewNext = ()=>{
        $scope.imgPreviewIndex += 1;
        if($scope.state == 'update'){
            $scope.loadUploadedImg();
            return;
        }
        $scope.loadPreviewImg();
    }
    //view previous image
    $scope.viewPrev = () =>{
        $scope.imgPreviewIndex -= 1;
        if($scope.state == 'update'){
            $scope.loadUploadedImg();
            return;
        }
        $scope.loadPreviewImg();
    }

    $scope.openConfirmImage = ()=>{
        $('#deleteimagemodal').modal("show");
    }

    // delete image
    $scope.deleteImage = ()=>{
        if($scope.state == "update"){
            let id = $scope.images[$scope.imgPreviewIndex].id;
            $http({
                method: 'DELETE',
                url: 'http://127.0.0.1:8000/api/image/'+id
            }).then((res)=>{
                console.log(res);
                $('#deleteimagemodal').modal("hide");
                $scope.loadUploadedImg();
            }, (err)=>{
                console.log(err);
            });
        } else {
            if($scope.selectedColorFiles.length == 0){
                toastr.warning('You can not delete file when you did not upload this file before');
                $('#deleteimagemodal').modal("hide");
                return;
            }
            $scope.selectedColorFiles.splice($scope.imgPreviewIndex, 1);
            $('#deleteimagemodal').modal("hide");
            if($scope.selectedColorFiles.length==0)
                $scope.preview = "";
            $scope.loadPreviewImg();
        }
    }
});
