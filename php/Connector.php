<?php
    
require_once('SQLException.php');

class Connector
{
protected $con;
private $server;
private $sUsername;
private $sPassword;
private $db; 



    public function _construct()
            {
        $this->server = "localhost";
        $this->sUsername = "root";
        $this->sPassword = "";
        $this->db="PrintP";


    
            }

    public function connect()
            {
    
   $this->con = mysql_connect("localhost","root","");
   mysql_select_db("PrintP", $this->con);
   if($this->con)
       return true;
   else
       return false;
   
    
            }  
            
  public function selectDB()
            {
      mysql_select_db($this->db);
         
            }
            
  public function runQuery($query)
            {
     if(mysql_query($query,$this->con))
             return true;
         else 
             return false;
     
            }
 
 public function runSelectQuery($query)
        {
     
     if($result = mysql_query($query,$this->con))
                {
         return $result;
             }
                else
                    return false;
             
     
     
        }

 public function disconnect()
        {
    mysql_close($this->con);
    
        }
}


?>

