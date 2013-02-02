
var OrderHistory = function () {

    this.orderNumber = 0;
    this.imageName = "";
    this.imageSize = "";
    this.quantity = 0;
    this.price = 0.0;
    this.orderTo = "";

    this.saveOrder = function (orderNumber, imageName, imageSize, quantity, price, orderTo) {


        this.orderNumber = orderNumber;
        this.imageName = imageName;
        this.imageSize = imageSize;
        this.quantity = quantity;
        this.price = price;
        this.orderTo = orderTo;

        localStorage["order" + orderNumber] = this.orderNumber + "," + this.imageName + "," + this.imageSize + "," + this.price + "," + this.orderTo;

    }

    this.displayOrderHistory = function () {


        var orderHistoryArray = new Array();
        var i = 1;
        while (localStorage["order" + i]) {

            var orderInfo = localStorage["order" + i];
            // orderHistoryArray[i] = orderInfo.replace(','," ");
            $("#ordered").append("hello");

            i++;
        }
        alert("hello");



    }




}









