
var totalPrice = 0;

 
 function init() {
        var name, phoneNumber, address, directions;

        // pre-populate client's information if exists
     
        var name = localStorage['name'],
             phoneNumber = localStorage['phoneNumber'],
             address = localStorage['address'],
             directions = localStorage['directions'],
             location = localStorage['location'];

             
        $("#name").val(name);
        $("#number").val(phoneNumber);
        $("#address").val(address);
        $("#directions").val(directions);
        $("#location").val("Umlazi");



        $.get("php/initHandler.php?q=packages", function (data) {

            data = JSON.parse(data);

            $.each(data, function (index, value) {
                $.each(value, function (index, value) {

                    $("#printSize").append("<option id='"+value+"'>"+index+"</option>");

                    });
                });
            });
       




    }


    function generateUserId(){


        $.get("php/initHandler.php?q=generateId", function (data) {
            localStorage['printP_userId'] = data;

        });
    }





    var imgs = 1;
    function addUp() {

        add.innerHTML += document.getElementById("img").innerHTML + "<br />";

        imgs++;
        document.getElementById("imgNum").value = imgs;
        calcPrice(document.getElementById("imgNum").value);


    }

     // new implementation of populating the location drop-down list
            // using AJAX, JQuery, PHP, and JSON :) 
            // Humble beginnings of developing asyc apps :)
            function populateCities() {
                $.get("php/initHandler.php?q=cities", function (data) {
                    // Asynchronously send a get query string to initHandler.php
                    // iniHandler.php returns a JSON encoded string which was a array
                    // we parse the string to a JavaScript JSON object
                    // and iterate through it so to append all of it values as options of the location drop-down
                    data = JSON.parse(data);

                    $.each(data, function (index, value) {
                        $("#location").append("<option id='" + value + "'> + " + value + "</option>");
                    });

                });
            }
            populateCities();


     function validateFields()
            {
                
                $("#image").val() == "" ? displayErr("image") : "";
                $("#printSize").val() == "Select print size" ? displayErr("printSize") : "";
                $("#quantity").val() == "Select quantity" ? displayErr("quantity") : "";
                $("#name").val() == "" ? displayErr("name") : "";
                $("#number").val() == "" ? displayErr("number") : "";
                $("#location").val() == "Select location" ? displayErr("location") : "";
                $("#address").val() == "" ? displayErr("address") : "";
                $("#directions").val() == "" ? displayErr("directions") : "";
            }

            function validateComment()
            {
                $("#name").val() == "" ? displayErr("name") : "";
                $("#phoneNumber").val() == "" ? displayErr("phoneNumber") : "";
                $("#comment").val() == "" ? displayErr("comment") : "";

                $.get("php/comment.php?name=" + $("#name").val() + "&phoneNumber=" + $("#phoneNumber").val() + "&comment=" + $("#comment").val() + "&email=" + $("#email").val(), function (data) {

                    $("#page").hide("slow").html(data).show("slow");
                });

            }

            function restoreDetails()
            {
                  
                var name = localStorage['name'];
                var phoneNumber = localStorage['phoneNumber'];
                
                
                $("#name").val(name);
                $("#phoneNumber").val(phoneNumber);
                return false;
                
            }


    function saveOrder()
    {
                var orderNum = localStorage['orderNum'] == null ? 0 : localStorage['orderNum'];
                orderNum++;
                localStorage['orderNum'] = orderNum;
                var objOrderHistory = new OrderHistory();
                objOrderHistory.saveOrder(orderNum,"imageName", $("#printSize").val(),$("#quantity").val(),$("#priceIn").val(),$("#number").val());
               
               

    } 

     function locationChanged()
           {
               
                $.each(populatedCities, function (index, value) {
                    // we iterate through the populatedCities array to see
                    // if the selected city has already had it chance of being populated
                    // with specific locations 
                    // if it has, we set the populated variable to true
                    // so to not populate it again, and have duplicate values  
                    if (value == $("#location").val()) {
                        
                        populated = true;
                    }

                });
                
                // if the selected city has not been populated
                // go on and populate it
                if (!populated) {


                    
                    // Asynchronously send a get query string to initHandler.php
                    // iniHandler.php returns a JSON encoded string which was a 2d array
                    $.get("php/initHandler.php?q=locations", function (data) {

                        // we parse the string to a JavaScript JSON object 
                        data = JSON.parse(data);

                        // we then go deep into the object's value
                        // and only populate the one which is currently selected
                        $.each(data, function (index, value) {
                            $.each(value, function (index, value) {

                                if ($("#location").val().substr(2) == index) {
                                    $("#" + index).after("<option id='" + value + "' class='" + value + "'>" + value + "</option>");

                                }
                            });
                        });

                    });
                    // after being populated, push it inside the populatedCities array
                    // and reset populated to false 
                    populatedCities.push($("#location").val());
                    populated = false;
                }


           }


           function quantitySizeChanged()
                    {
                        
                    // calculates the total amount a user needs to
                    // pay on delivery of their printed photos.
                    // It does this whenever the user changes his/her 
                    // selection on the quantity and printSize drop-down 

                    var n = document.getElementById("printSize").options.selectedIndex;
                    var index = document.getElementById("quantity").options.selectedIndex;
                    var q = document.getElementById("quantity").options[index].value;

                    var price;
                    if (parseInt(q) && parseFloat($("#printSize").find("option:eq(" + n + ")").attr("id"))) {

                        price = parseFloat($("#printSize").find("option:eq(" + n + ")").attr("id"));
                        totalPrice = (price * q);
                        $("#priceIn").val(totalPrice);
                        $("#price").html("R" + totalPrice);

                    }


                    }


                $("a").css({ "text-decoration": "none", "color": "teal" });

                // populates quantity drop-down with values of 1 to 10
                for (var i = 5; i < 16; i++)
                    $("#quantity").append("<option class='quantity1'>" + i + "</option>");






                $("#quantity, #printSize").change(function () {

                    quantitySizeChanged();
                });



                $("#next").click(function () {

                    nextLinkClicked();
                });

            function nextLinkClicked()
            {
               // implements the next button for quantity drop-down
                var last = parseInt($(".quantity1:last").val());
                $("#quantity").empty();
                last++;
                var lastX10 = last + 10;
                for (var i = last; i < lastX10; i++) {
                    if (i == last)
                        $("#quantity").append("<option class='quantity1'>Select quantity</option>");
                    $("#quantity").append("<option class='quantity1'>" + i + "</option>");
                }
                $("#range").remove();
                $(this).after(" <span id='range'>" + last + "-" + (lastX10 - 1) + "</span>"); 

            }

            // populates the location drop-down with cities
               /* var locations = new Array("Durban", "Empangeni");

                $.each(locations, function (index, value) {
                    $("#location").append("<option id='" + value + "'> + " + value + "</option>");
                });*/

           /* $("#location").change(function () {

                // Implements the location drop down list
                switch ($("#location").val()) {
                    case "+ Durban": appendAfter(new Array("Durban Central", "Umlazi", "Isipingo", "Chatsworth"), "DurbanSub");
                        $("#" + $("#location").val().substr(2)).html("- Durban").css("color", "teal");
                        break;
                    case "- Durban": $(".DurbanSub").remove();
                        $("#" + $("#location").val().substr(2)).html("+ Durban").css("color", "black");
                        break;
                    case "+ Empangeni": appendAfter(new Array("Esikhawini", "KwaDlangezwe"), "EmpangeniSub");
                        $("#" + $("#location").val().substr(2)).html("- Empangeni").css("color", "teal");
                        break;
                    case "- Empangeni": $(".EmpangeniSub").remove();
                        $("#" + $("#location").val().substr(2)).html("+ Empangeni").css("color", "black");
                        break;
                }

            });

            // Appends specific locations of a selected city 
            function appendAfter(specificLocation, sub) {
                $.each(specificLocation, function () {
                    $("#" + $("#location").val().substr(2)).after("<option id='" + this + "' class='" + sub + "'>" + this + "</option>");
                });
            }*/

           

            // this right here became a bit complex...
            // but let me explain
            // variable populated start off as false and populated Cities as an empty array
            // since haven't populated any city with specific location
            var populated = false;
            var populatedCities = Array();
            $("#location").change(function () {
                locationChanged();
            });






            $("#save").click(function () {

                saveDetails();
            });

            function saveDetails()
            {
               // saves client's details for re-populating later 
                var name = $("#name").val();
                var phoneNumber = $("#number").val();
                var address = $("#address").val();
                var directions = $("#directions").val();
                var location = $("#location").val();


                try {
                    localStorage['name'] = name;
                    localStorage['phoneNumber'] = phoneNumber;
                    localStorage['address'] = address;
                    localStorage['directions'] = directions;
                    localStorage['location'] = location;

                } catch (ex) {

                    $("#err").html("Your broswer does not support LocalStorage, please upgrade it.").css("color", "red");
                }
                $("#err").html("Your details have been saved.").css({ "color": "teal" }).dialog().show('slow');

                setTimeout(function () {
                    // close the dialig after just over a second
                    $("#err").dialog('close');
                }, 1111);  

            }

            $("#submit, #save").hover(function () {
                validateFields();

            }, function () {
                // do nothing when a user moves a mouse pointer away from the button


            });

           
            $("#submit").click(function (e) {

                validateFields();
                

                
                //$("#mainForm").serialize()
                $.post("php/handle_img.php?location=" + $("#location").val(), $("input[@type=file]").serialize(), function (data) {
                    $("#page").hide("slow").html(data).show("slow");

                });
                return false;

                /* $("#mainForm").ajaxForm(function (data) {
                $("#page").hide("slow").html(data).show("slow");
                });
                return false;*/
            });

            var errFields = 0;
            var displayErr = function (field) {
                // makes sure for that the first control that triggers an error
                // is the one that receives focus
                errFields++;
                if (errFields == 1) {
                    // disables the submit and save button
                    $("#submit").attr("class", "ui-button ui-state-disabled");
                    $("#save").attr("class", "ui-button ui-state-disabled");

                    // adds a tittle attribute and focus the element so to enable it tooltip 
                    $("#" + field).attr("title", "Please enter " + field).focus().hover(function () {

                        // enables the submit and save button when a user hovers over the control that
                        // triggered an error
                        $("#submit").attr("class", "ui-button");
                        $("#save").attr("class", "ui-button");
                        errFields = 0;
                        // I could explain whats happening above in detail but im tired
                    }, function () {


                    });
                    return false;
                }



            }


             