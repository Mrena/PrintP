<?php
        require_once('Initializer.php');


        $objInit = new Initializer();
        if(isset($_GET['q']) && $_GET['q']=="cities")
        $objInit->getCities();

        else if(isset($_GET['q']) && ($_GET['q']=="locations" || $_GET['q']=="coveredAreas"))
         $objInit->getLocations();

         else if(isset($_GET['q']) && $_GET['q']=="packages")
         $objInit->getPackages();

         else if(isset($_GET['q'],$_GET['userId']) && $_GET['q']=="orderHistory")
         $objInit->getOrderHistory($_GET['userId']);

         else if(isset($_GET['q']) && $_GET['q']=="generateId")
         $objInit->generateUserId();

         else
           "";

        
        





?>

