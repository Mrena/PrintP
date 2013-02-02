
var indexPage = "";

$(document).ready(function () {
    indexPage = $("#page").html();


    $("h1").click(function () {
        $("#page").hide("slow").html(indexPage).show("slow");
    }).mouseover(function () {
        $(this).css("color", "teal");
    }).mouseout(function () {
        $(this).css("color", "black");
    });



});




$("a").click(function () {


    // when a link is clicked load the page
    // which is the value of the link's id attribute
    // but dont just load it
    // first hide the data within the div with an id of page,
    // load the data while it is hidden, and then
    // show the div with the new data  
    if ($(this).attr("id") == "close") {
        $("header,#page,footer").addClass("ui-state-disabled");
        $("#exit").html("Are you sure?").dialog({
            buttons: {
                NO: function () {
                    $("#exit").dialog("close");
                    $("header,#page,footer").removeClass("ui-state-disabled");
                },
                Yes: function () {
                    blackberry.app.exit();
                }
            }
        });

        $("#exit").dialog("option", "width", 220);
        $("#exit").dialog("option", "height", 180);
        $("#exit").dialog("option", "draggable", false);
        $("#exit").on("dialogclose", function () {
            $("header,#page,footer").removeClass("ui-state-disabled");
        });
    }



    else {
        $.get($(this).attr("id"), function (data) {

            $("#page").hide("slow").html(data).show("slow");

        });

        // if the id attribute of the clicked link is not equal to home
        // prevent the browser from trying to navigate to the location specified
        // in href
        if ($(this).attr("id") == "about.html") {
            getCovered();
            return false;
        }

        else if ($(this).attr("id") == "orderhistory.html") {

            /* var objOrderHistory = new OrderHistory();
            objOrderHistory.*/
            displayOrderHistory();
            return false;

        }

        else if ($(this).attr("id") != "home")
            return false;
        else {
            // when the home link is clicked, hide the content of
            // the div with a value of page
            // insert the content of variable indexPage
            // and show the content  
            $("#page").hide("slow").html(indexPage).show("slow");

            init();
            populateCities();
            return false;
        }
    }

}).hover(function () {
    // do this on mouse over
    $(this).css("color", "lime");
}, function () {
    // do this on mouse out
    $(this).css("color", "teal");
});