<?php

$err = 0;

$name = validate($_GET['name']) ? $_GET['name'] : flagErr();
$phoneNumber = validate($_GET['phoneNumber']) ? $_GET['phoneNumber'] : flagErr();
$comment = validate($_GET['comment']) ? $_GET['comment'] : flagErr();
$email = $_GET['email'];

function validate($in){

        if(isset($in)&& $in != NULL && $in != "")
        return TRUE;
        else
        return FALSE;
    } 

    function displayErr()
    {
        global $err;
        $err = 1;
    }

    if($err==0)
    {
        
        $from = "From:mrena.pro@gmail.com";
        $details =" Name: $name <br />\n Phone Number: $phoneNumber <br />\n Email Address: $email <br />\n Comment: $comment ";
        @mb_send_mail("khulekanik@live.com","Comment from PrintP",$details,$from);
        echo "Your comment has been sent.";
          
    }
    else
      echo "Could not send your comment.";



?>

