//Creation of our services
myapp.factory('Service', function ($rootScope, $http) {
  //Declaration of our shareved variable between controller
  var sharedService = {};
  sharedService.qte = 1;
  sharedService.ifdelivery = 1;
  sharedService.price = '';
  sharedService.totalPrice = '';
  sharedService.category = 0;
  sharedService.bill = []
  sharedService.Delivery=0;
  sharedService.accumulativePrice = 0;
  sharedService.previousIndex = -1;
  sharedService.previousIndexArray = [];
  sharedService.CountpreviousIndex = 0;
  sharedService.isActive = 0;
  sharedService.toPush = 0;
  sharedService.PriceDontTouche = 0;
  sharedService.CounterUserForLivraison = 0;
  sharedService.people_number = 0;
  //Function toogle
  sharedService.changeActive = function (CountpreviousIndex) {
    if (CountpreviousIndex == 2) {
      this.isActive = 1;
    } else {
      this.isActive = 0;
    }
    $rootScope.$broadcast('handleisActive');
  }
  //Function toogle
  sharedService.changePreviousIndex = function (array, currentIndex, array_bill, oldaccumulativePrice,delivery) {
    var count = 0
    // alert(array.length+"ss");
    for (var i = 0; i < array.length; i++) {
      if (array.includes(currentIndex)) {

        this.CountpreviousIndex = 2;
        this.previousIndex = currentIndex;
        this.toPush = 0;
        this.accumulativePrice = (parseFloat(oldaccumulativePrice) -parseFloat( array_bill[currentIndex].price));
        this.accumulativePrice  = Math.round( this.accumulativePrice   * 1e12 ) / 1e12 ;
      } else {
        // alert("vide")
        this.CountpreviousIndex = 1;
        this.previousIndex = currentIndex;
        this.toPush = 1;
      }
    }
    if (array.length === 0) {
      //alert("farga")
      this.CountpreviousIndex = 0;
      this.previousIndex = currentIndex;
      this.toPush = 1;
    }
    $rootScope.$broadcast('handleisActive');
  }
  //Function To push
  sharedService.changeToPush = function (validity, currentIndex) {
    //alert(validity)
    if (validity == 1) {
      this
        .previousIndexArray
        .push(currentIndex)

    } else {
      var repetion = 0;
      if (this.previousIndexArray.length == 1) {
        var count = -1;
      } else {
        var count = -1;
      }

      for (var i = 0; i < this.previousIndexArray.length; i++) {
        if (this.previousIndexArray[i] == currentIndex) {
          repetion++;
          count++;
          this
            .previousIndexArray
            .splice(count, 1)
         
          count = 0;
          repetion = 0
        } else {
          count++;
        }

      }
    }
    $rootScope.$broadcast('handleisActive');
  }
  //Function that change Quantity of the shared variable qte
  sharedService.changeQuantity = function (qte) {
    this.qte = qte;
    $rootScope.$broadcast('handleQuantity');
  }
  //Function that change Price of the shared variable price
  sharedService.changePrice = function (qte, category, description, people_number, price, accumulative,delivery,ifdelivery) {
   
    var intialPrice = price;
    intialPrice = (parseFloat(price) +parseFloat(accumulative));
    
    if (category == 1) {
    
       
        intialPrice = (price * qte) + accumulative
     
    } else if (category == 3) {
     
      if(ifdelivery==1)
        intialPrice =((price * qte) / people_number) + accumulative+delivery
      else 
       intialPrice =(((price-delivery)* qte) / people_number) + accumulative-delivery;
     
    }
    if(category != 3 && category !=1 ){
      
      
      if(ifdelivery==1){
        intialPrice =((price-delivery) * qte)+ accumulative+delivery
      }
    else {
      intialPrice =((price-delivery) * qte)+ accumulative
    }
    
    
    }
    intialPrice = Math.round( intialPrice  * 1e12 ) / 1e12 ;

    // alert(intialPrice+'qte:'+qte+'intial:price'+price)
    this.description = description;
    this.people_number = people_number;
    this.totalPrice = intialPrice;
    $rootScope.$broadcast('handlePrice');
  }
  // Function that change Price when adding accumulative price of the shared
  // variable price Function that change Price when adding accumulative price of
  // the shared variable price
  sharedService.changePriceAddingTheAccuumative = function (price, qte, category, description, people_number, accumative,delivery,ifdelivery) {
    var intialPrice = 0;
    console.log(description)
    intialPrice = parseFloat(price) +parseFloat(accumative)-parseFloat(delivery);
 

    if (category == 1) {
  
        intialPrice = ((price) * qte) + accumative 

      
    } if (category == 3) {
     
         ifdelivery=0;
         intialPrice =(((price-delivery) * qte) / people_number) + accumative+delivery
      
    }
    if(category != 3 && category !=1 ){
      
      this.ifdelivery=0;
      if(ifdelivery==1)
         intialPrice =((price-delivery) * qte)+ accumative -delivery
      else
          intialPrice =((price-delivery) * qte)+ accumative 

     
    }
    intialPrice = Math.round( intialPrice  * 1e12 ) / 1e12 ;
    this.price = intialPrice;

    //alert('qte:'+qte+'intial:price'+price+"accumulative"+accumative)
    $rootScope.$broadcast('handlePriceAddingTheAccuumative');
  }
  //Function that assign to the shared variable price an intial price
  sharedService.changePriceIntial = function (price,intialPrice) {
    this.price = intialPrice;
    this.totalPrice = price;
    this.PriceDontTouche = intialPrice;
    $rootScope.$broadcast('handlePriceIntial');
  }
  // Function that change the accumulative price on the shared variable
  // changePriceAccuumative
  sharedService.changePriceAccuumative = function (price) {
    this.accumulativePrice = price;
    $rootScope.$broadcast('handlechangePriceAccuumative');
  }
  //Function that Will intial the bill
  sharedService.changeBillIntial = function (array, index) {
    let validity = true;
    for (var i = 0; i < this.bill.length; i++) {
      if (this.bill[i].index == index) {

        validity = false;
      }
    }

    if (validity == true) {
      this
        .bill
        .push(array);
    }

    $rootScope.$broadcast('handleBillIntial');
  }
  //Function that change the Bill Price Detail
  sharedService.changeBill = function (array, index) {
    let validity = true;
    let count = 0;
    // alert(index)
    for (var i = 0; i < this.bill.length; i++) {

      if (this.bill[i].index == index) {
        console.log(this.bill[i].index + "," + index)
        validity = false;
        count = i
      }
    }
    console.log("index que je vais suprimer est:" + count)
    console.log("Array before delete!" + JSON.stringify(this.bill))
    if (validity == false) 
    
      this.bill.splice(count, 1);
     
    
    $rootScope.$broadcast('handleBill');
  }

  return sharedService;
});