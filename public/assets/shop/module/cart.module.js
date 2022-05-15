app.controller('cart', ($scope)=>{
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
    
    

    $scope.addCart = (product, color, size, image, quantity)=>{
        console.log(color);
        let item = {
            color_id: color.id,
            color_name: color.name,
            product_id: product.id,
            product_name: product.name,
            size_id: size.id,
            image: image.name, 
            inStock: size.quantity,
            quantity: quantity,
            color: color.value,
            price: color.price[0].sold_value,
            discount: color.discount,
            price_id: color.price[0].id
        };
        let cartItem = $scope.carts.find(x=>x.color_id==item.color_id && x.size_id == item.size_id);
        if(cartItem == undefined){
            if(item.inStock <=0)
                return;
            $scope.carts.push(item);
        } else {
            if((item.inStock-(cartItem.quantity+item.quantity))<0)
                return;
            cartItem.quantity+=quantity;
        }
        localStorage.setItem('carts', JSON.stringify($scope.carts));
        
    }

    $scope.minus = (index) =>{
        let item = $scope.carts[index];
        if(item.quantity-1<=0)
            return;
        item.quantity -= 1;
        localStorage.setItem('carts', JSON.stringify($scope.carts));
        $scope.payment();
    }

    $scope.plus = (index)=>{
        let item = $scope.carts[index];
        if(item.quantity+1>item.inStock)
            return;
        item.quantity+=1;
        localStorage.setItem('carts', JSON.stringify($scope.carts));
        $scope.payment();
    }

    $scope.delete = (index)=>{
        $scope.carts.splice(index, 1);
        localStorage.setItem('carts', JSON.stringify($scope.carts));
        $scope.payment();
    }
});