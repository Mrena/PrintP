<?php

class SQLException extends Exception {
    //put your code here
    
    /*function __construct($message) {
        parent::__construct();
        echo $message." ".mysql_error();
        }*/
    private $error;    
    
    function _construct()
    {
        
        $this->error = mysql_error();
    }
    
    public function getError()
    {
     return $this->error ? "" : mysql_error();   
        
    }
    
}






?>

