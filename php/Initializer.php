<?php
 
    require_once('Connector.php');


 class Initializer extends Connector
 {
     private $cities = array();
     private $locations = array();
     private $packages = array();
     private $orders = array();

     public function _construct()
     {
         

     }

     public function getCities()
      {
          
          $query = "SELECT name FROM City";

         $this->connect();
         $result =  $this->runSelectQuery($query);
         $count = 0;
         while($row = mysql_fetch_array($result))
         {
            $this->cities[$count] = $row[0];
            $count++;


         }

         echo json_encode($this->cities);

      }



     public function getLocations()
     {
         
         $query = "SELECT city,location FROM Areas";

         $this->connect();
         $result =  $this->runSelectQuery($query);
         while($row = mysql_fetch_array($result))
         {
            array_push($this->locations, array($row[0]=>$row[1]));
         }
        echo json_encode($this->locations);
        

     }

     public function getPackages()
     {
         
         $query = "SELECT print_size,price FROM Packages";

         $this->connect();
         $result =  $this->runSelectQuery($query);
         while($row = mysql_fetch_array($result))
         {
            array_push($this->packages, array($row[0]=>$row[1]));
         }
        echo json_encode($this->packages);

     }


     public function addOrder($order_from,$order_to,$order_from_id,$order_date,$order_location,$order_image_number,$order_price)
     {
         
         $query = "INSERT INTO Orders (order_from,order_to,order_from_id,order_date,order_location,order_image_number,order_price) VALUES('$order_from','$order_to','$order_from_id','$order_date','$order_location',$order_image_number,$order_price)";
         $this->connect();
         $this->runQuery($query);

     }

     public function getPhotographerIn($location)
     {
         
         $query = "SELECT username FROM Photographers WHERE operating_area = '$location'";

         $this->connect();
         if($this->runSelectQuery($query))
         {
             $result = $this->runSelectQuery($query);
             
         $row = mysql_fetch_array($result);
         
             
            return $row[0];
         

     }
     else
       echo "Could not get photographer ".mysql_error();

     }

     public function getOrderHistory($userId)
     {
        
        $query = "SELECT order_id,order_from,order_date,order_image_number,order_price FROM Orders WHERE order_from_id = $userId";

         $this->connect();
         $result =  $this->runSelectQuery($query);
         while($row = mysql_fetch_array($result))
         {
            array_push($this->orders, array($row));
         }
        echo json_encode($this->orders); 

     }


     public function generateUserId()
     {

         
         $generatedHashValue = time();
         $todayDate = date('m-d-y');
         $query = "INSERT INTO UserIds(hash_value,userId_date_created) VALUES($generatedHashValue,$todayDate)";
         $this->connect();     
         if($this->runQuery($query)==false)
           die("could not insert hash value ".mysql_error());


         $query = "SELECT user_id FROM UserIds WHERE hash_value = '$generatedHashValue'";

         
         if($this->runSelectQuery($query))
         {
             $result = $this->runSelectQuery($query);
            
             $row = mysql_fetch_array($result);
         
             echo $row[0];
            
         

     }
     else
       echo "Could not generate user id".mysql_error();

     } 



 }


 





?>
