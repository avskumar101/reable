<?php

session_start();

require_once('../config.php');	


$id = "";

if(isset($_GET['id'])!=""){

	$id = $_GET['id'];

	$resultarray=mysql_fetch_array(mysql_query("SELECT * FROM tbl_storeddata where id ='".$id."'"));

}

echo "Name : ";

echo $resultarray['name'];

echo '<br>';echo '<br>';

echo "Email Id : ";

echo $resultarray['emailid'];

echo '<br>';echo '<br>';

if($resultarray['people']!="" && $resultarray['people']!="0"){

echo "Number of People Including Children : ";

echo $resultarray['people'];

echo '<br>';echo '<br>';

}

if($resultarray['checkin']!="" && $resultarray['checkin']!="0000-00-00"){

echo "Check In Date : ";

echo $resultarray['checkin'];

echo '<br>';echo '<br>';

}

if($resultarray['checkout']!="" && $resultarray['checkout']!="0000-00-00"){

echo "Check Out Date : ";

echo $resultarray['checkout'];

echo '<br>';echo '<br>';

}

if($resultarray['town']!=""){

echo "Towns Interested In Vacationing To : ";

echo $resultarray['town'];

echo '<br>';echo '<br>';

}

if($resultarray['frd_name']!=""){

echo "Friend Name : ";

echo $resultarray['frd_name'];

echo '<br>';echo '<br>';

}

if($resultarray['frd_email']!=""){
	
echo "Friend_Email : ";

echo $resultarray['frd_email'];

echo '<br>';echo '<br>';

}

if($resultarray['pagename']!=""){

echo "Page Name : ";

echo $resultarray['pagename'];

echo '<br>';echo '<br>';

}


if($resultarray['adderss1']!=""){
	
echo "Address : ";

echo $resultarray['adderss1'];

echo '<br>';echo '<br>';

}

if($resultarray['adderss2']!=""){

echo "Address  : ";

echo $resultarray['adderss2'];

echo '<br>';echo '<br>';

}


if($resultarray['homephone']!=""){

echo "Home Phone : ";

echo $resultarray['homephone'];

echo '<br>';echo '<br>';

}

if($resultarray['busphone']!=""){

echo "Business Phone : ";

echo $resultarray['busphone'];

echo '<br>';echo '<br>';

}

if($resultarray['busphone1']!=""){

echo "Business Phone : ";

echo $resultarray['busphone1'];

echo '<br>';echo '<br>';

}

if($resultarray['adderss3']!=""){

echo "Address : ";

echo $resultarray['adderss3'];

echo '<br>';echo '<br>';

}

if($resultarray['city']!=""){

echo "City : ";

echo $resultarray['city'];

echo '<br>';echo '<br>';

}

if($resultarray['state']!=""){

echo "State : ";

echo $resultarray['state'];

echo '<br>';echo '<br>';

}

if($resultarray['zip']!=""){

echo "ZIP : ";

echo $resultarray['zip'];

echo '<br>';echo '<br>';

}

if($resultarray['createon']!=""){

echo "Created On : ";

echo $resultarray['createon'];

echo '<br>';echo '<br>';

}

if($resultarray['comment']!=""){

echo "Comments : ";

echo $resultarray['comment'];

echo '<br>';echo '<br>';

}

if($resultarray['mailtext']!=""){

echo "<strong><u>Mail Text</u> :</strong><br>";

echo $resultarray['mailtext'];

}

?>