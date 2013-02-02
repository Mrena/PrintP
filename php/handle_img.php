<?php
    
    require_once('Connector.php');
    require_once('Initializer.php');
	/* configuration settings */
  
$max_photo_size = 5000000;
$upload_required = true;
$upload_page = '../index.html';
$upload_dir =  '../fileupl/';
$err = 0;

 function displayErr()
    {
        global $err;
        $err = 1;
    }

    function validate($in){

        if(isset($in)&& $in != NULL && $in != "")
        return TRUE;
        else
        return FALSE;
    } 

    $me = validate("hello") ? "hello" : displayErr();
    $userId = validate($_POST['userId']) ? $_POST['userId'] : displayErr();
    $totalPrice = validate($_POST['priceIn']) ? $_POST['priceIn'] : displayErr();
    $location = validate($_POST['location']) ? $_POST['location'] : displayErr();
    $printSize = validate($_POST['printSize']) ? $_POST['printSize'] : displayErr();
    $quantity = validate($_POST['quantity']) ? $_POST['quantity'] : displayErr() ;
    $name = validate($_POST['name']) ? $_POST['name'] : displayErr();
    $number = validate($_POST['number']) ? $_POST['number'] : displayErr();
    
    $address = validate($_POST['address']) ? $_POST['address'] : displayErr();
    $directions = validate($_POST['directions']) ? $_POST['directions'] : displayErr();

   
    

$err_msg = false;
do {
 
 /* Does the file field even exist? */
 
if (!isset ($_FILES['image'])){
$err_msg = 'The form was not sent in completely. Please enter all of the required fields.';
break;

} else {
$image = $_FILES['image'];
}

/* We check for all possible error codes we might get */

switch ($image['error']) {
case UPLOAD_ERR_INI_SIZE:
 displayErr();
$err_msg = 'The size of the image is too large, '.
"it can not be more than $max_photo_size bytes.";
break 2;
case UPLOAD_ERR_PARTIAL:
 displayErr();
$err_msg = 'An error ocurred while uploading the file, '.
"please <a href='{$upload_page}'>try again</a>.";
break 2;
case UPLOAD_ERR_NO_FILE:
if ($upload_required) {
     displayErr();
$err_msg = 'You did not select a file to be uploaded, '.
"please do so <a href='{$upload_page}'>here</a>.";
break 2;
}
break 2;
case UPLOAD_ERR_FORM_SIZE:
 displayErr();
$err_msg = 'The size was too large according to '.
'the MAX_FILE_SIZE hidden field in the upload form.';
case UPLOAD_ERR_OK:
if ($image['size'] > $max_photo_size) {
     displayErr();
$err_msg = 'The size of the image is too large, '.
"it can not be more than $max_photo_size bytes.";
}
break 2;
default:
 displayErr();
$err_msg = "An unknown error occurred, ".
"please try again <a href='{$upload_page}'>here</a>.";
}

/* Now we check for the mime type to be correct, we allow
 * JPEG and PNG images */
 
if (!in_array(
$image['type'],
array ('image/jpeg', 'image/pjpeg', 'image/png')
)) {

    displayErr();
$err_msg = "You need to upload a PNG or JPEG image, ".
"please do so <a href='{$upload_page}'>here</a>.";
break;
}
} while (0);


/* If no error occurred we move the file to our upload directory */

if (!$err_msg) {
if (!@move_uploaded_file(
$image['tmp_name'],
$upload_dir . $image['name']
)) {
     displayErr();
$err_msg = "Error moving the file to its destination, ".
"please try again <a href='{$upload_page}'>here</a>.";
}
}

    
    if($err!=1)
    {
    $objIni = new Initializer();
    $order_to = $objIni->getPhotographerIn($location);
    
    $objIni->addOrder($number,$order_to,$userId,date('m-d-y'),$location,$quantity,$totalPrice);

    $from = "From: mrena@gmail.com";


    $query = "SELECT email_address FROM Photographers WHERE operating_area = '$location'";
    
    $objCon = new Connector();
    if($objCon->connect())
    {
    $result = $objCon->runSelectQuery($query);
    
    
 while($row = mysql_fetch_array($result))
 {
    
      @mail($row[0],"Image to print from PrintP","
    <table>
    <tr><td>Image:</td><td><img src='fileupl/".$image['name']."' /></td></tr>
        <tr><td>Quantity:</td><td>$quantity</td></tr>
        <tr><td><hr /></td><td><hr /></td></tr>
        <tr><td>Name:</td><td> $name </td></tr>
        <tr><td>Phone Number:</td><td> $number </td></tr>
        <tr><td>Location:</td><td> $location</td></tr>
        <tr><td>Address:</td><td>$address</td></tr>
        <tr><td>Directions:</td><td>$directions</td></tr>
    </table>",$from);
   
 }


    $objCon->disconnect();


      }

      $err_msg = "Your order has been submitted successfully. Here are it details.";

} 






    ?>
    <!DOCTYPE html>
<html>
<head>
<title>PrintP</title>
    <link rel="stylesheet" href="../css/jquery.ui.all.css">
    <link rel="stylesheet" href="../css/jquery.ui.button.min.css">
    <link rel="stylesheet" href="../css/mainStyle.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">

    <style type="text/css">
        .ui-menu { width: 150px; }
        
    </style>

   
    
    
<script type="text/javascript">
</script>
</head>
<body>
    <header>
<h1 class="ui-state-highlight">PrintP</h1>

<h4>Send your image for printing. We will deliver you a high quality print-out right to your door step. Payment on delivery.</h4>
   
    </header>
<div id="page" class="ui-widget-content ui-corner-all">
    
<?php
if($err!=1)
{
echo $err_msg."<br />

    
    <table>
    <tr><td>Image:</td><td><img src='../fileupl/".$image['name']."' alt='photo' /></td></tr>
        <tr><td>Quantity:</td><td> $quantity </td></tr>
        <tr><td><hr /></td><td><hr /></td></tr>
        <tr><td>Name:</td><td> $name </td></tr>
        <tr><td>Phone Number:</td><td> $number </td></tr>
        <tr><td>Location:</td><td> $location </td></tr>
        <tr><td>Address:</td><td> $address </td></tr>
        <tr><td>Directions:</td><td> $directions </td></tr>
        <tr><td>Price:</td><td>R$totalPrice </td></tr>
   </table>";
}
else
  echo "Could not process you order. Please press the back button and try again."; 
    ?>
   </div>
    <footer>
    
    <div style="text-align: center">Developed By Khulekani Ngongoma</div>
        </footer>
</body>
</html>
    <?php

   
 
    
?>
  