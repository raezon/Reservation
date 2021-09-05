//here my controller with it's own method
myapp.controller("myCntrl", function ($scope, Service, $http) {
 

  //IncrementingPrice
  $scope.IncrementPrice = function (qty, category, description, people_number) {
    Service.changePrice(qty, category, description, people_number, (Service.PriceDontTouche), Service.accumulativePrice,Service.Delivery,Service.ifdelivery);
    $scope.price = parseFloat(Service.totalPrice);
    Service.totalPrice=parseFloat(Service.totalPrice);
    Service.changeQuantity(qty)
    return (Service.totalPrice)
  }
  //Function That decrement the price
  $scope.DecrementPrice = function (qty, category, description, people_number) {
    if (qty > 1) {
      qty = qty - 1;
      Service.changePrice(qty, category, description, people_number, (Service.PriceDontTouche), Service.accumulativePrice,Service.Delivery,Service.ifdelivery);
      $scope.price = parseFloat(Service.totalPrice);
      Service.totalPrice=parseFloat(Service.totalPrice);
      Service.changeQuantity(qty)
      return (Service.totalPrice)
    }
  }
  //Function that Handle the click on the checkbox for additional prices
  $scope.AdditionalPrice = function (index_array, product_parent_id) {
    //ajax call
    $http
      .get('web/index.php?r=api/bill/extra&id=' + product_parent_id)
      .then(function (response) {
        $scope.extra = response.data
        //Partie de tratiement et supression de redondance
        Service.changeBillIntial(response.data[index_array], index_array)
        Service.changePreviousIndex(Service.previousIndexArray, index_array, response.data, Service.accumulativePrice,Service.Delivery,Service.ifdelivery);
        Service.changeToPush(Service.toPush, index_array);
        Service.changeActive(Service.CountpreviousIndex)

        if (Service.isActive == 1) {
          Service.changeBill(response.data[index_array], index_array)
          Service.isActive = 0
          Service.changeActive(0)
          Service.previousIndex = -1
          Service.CountpreviousIndex = 0;
        }

        var accumative_price = parseFloat("0");
        for (let i = 0; i < Service.bill.length; i++) {
          accumative_price = (accumative_price + parseFloat(Service.bill[i].Price))
        }
        accumative_price = Math.round( accumative_price  * 1e12 ) / 1e12 ;
        //you need here to debite the original delivery price
        
        // alert(accumative_price)

        $scope.productSelected = Service.bill;
        Service.changePriceAccuumative(accumative_price)
        Service.changePriceAddingTheAccuumative(Service.PriceDontTouche, Service.qte, Service.category, Service.description, Service.people_number, accumative_price,Service.Delivery)
        $scope.price = Service.price;
        console.log("tableau" + JSON.stringify(Service.bill))
        return (Service.price)
      });

  }
  //Function that is responsible for the calculation of the total price
  $scope.TotalPrice = function (id, qte, category,delivery) {
    //I need to cal an api here to get the value of the delivery and dispalcement
    if(category==4 ||category==6||category==7 )
      Service
        .bill
        .push({'index': -1, 'Description': 'Displacement price ', 'Price': delivery})
    else  
      Service
      .bill
      .push({'index': -1, 'Description': 'Delivery price ', 'Price': delivery})
 
    $scope.productSelected = Service.bill;

    Service.category = category;
    Service.changeQuantity(qte);
    Service.Delivery=delivery;
    $http
      .get('web/index.php?r=api/bill&id=' + id + '&qte=' + qte)
      .then(function (response) {
        
        if (Service.CounterUserForLivraison == 0) {
          $scope.price = (parseFloat(response.data.price) + parseFloat(delivery))
          $scope.price= Math.round( $scope.price * 1e12 ) / 1e12 ;
          $scope.intialPrice = (parseFloat(response.data.intialPrice) + parseFloat(delivery))
          $scope.intialPrice= Math.round( $scope.intialPrice * 1e12 ) / 1e12 ;
        } else {
          
          $scope.price = (parseFloat(response.data.price) + parseFloat(delivery))
          $scope.price= Math.round( $scope.price * 1e12 ) / 1e12 ;
          $scope.intialPrice = (parseFloat(response.data.intialPrice) + parseFloat(delivery))
          $scope.intialPrice= Math.round( $scope.intialPrice * 1e12 ) / 1e12 ;
          
        }
        Service.CounterUserForLivraison++;

        Service.changePriceIntial(parseFloat($scope.price),parseFloat( $scope.intialPrice));
        // if(Service.CounterUserForLivraison==0){
        // Service.bill.push({'index':-5,'Description':'Livraison','Price':2})  }
      });
    $scope.price = Service.totalPrice;
    return ($scope.price)
  }
});