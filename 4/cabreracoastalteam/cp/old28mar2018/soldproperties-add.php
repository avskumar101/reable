<?php
session_start();
require_once('../config.php');
require_once('captcha/captcha.php');
	
	if(isset($_SESSION['uid'])=="" )
	header("Location: ../index.php");
	$userid=$_SESSION['uid'];
  
$select_event_details['eventdate']=time();
 $date=mktime(0, 0, 0, $_POST['event_month'], $_POST['event_day'], $_POST['event_year']);
if($_POST['button']=="Update Event")		
{  
 if($_POST['captcha']!='')
 {
   if(captcha_validate())
   {
 	
	$market=$_POST['market'];
	$address=$_POST['address'];
	$city=$_POST['cities'];
	$style=$_POST['style'];
	$bedrooms=$_POST['bedrooms'];
	$bathroom=$_POST['bathrooms'];
	$soldprice=$_POST['price'];
    $soldprice = str_replace(",","",$soldprice);
    mysql_query("insert into tbl_sold(date,market,address,city,style,bedrooms,bathroom,soldprice,mls_no) values('".$date."','".$market."','".$address."','".$city."','".$style."','".$bedrooms."','".$bathroom."','".$soldprice."','0')");
    header("Location:soldproperties.php");
       }
			else
			{
				echo "<script>alert('You were not successful in typing in the correct image verification, please try again.')</script>";
				$msg='<p style="color:red">Failure! You entered the wrong code!</p>';
			
			}  
		}
		else
		{
			echo "<script>alert('You were not successful in typing in the correct image verification, please try again.')</script>";
			$msg='<p style="color:red">Failure! Please Enter the code</p>';
		
		
		}
	
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title>Cabrera Team Control Panel</title>
<link href="../styles.css" rel="stylesheet" type="text/css">
<link rel="SHORTCUT ICON" href="../images/cabrera.ico">
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47104613-18', 'auto');
  ga('send', 'pageview');
  
</script>
<script>
function submitvalidate(){

	var numbers = /^(([0-9]+)(,(?=[0-9]))?)+$/;
    var txt = document.getElementById('price');
    if (txt.value.match(numbers)) {
    }
    else {
        alert('Price field should be numeric or numeric with comma');
        return false;
    }
	}
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form name="soldform" id="soldform" method="post" action="#" enctype='multipart/form-data'   onsubmit="return submitvalidate()">  
<tr>
    <td><?php include_once("header.php");?></td></tr>
  
  <tr>
    <td><table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <?php $resultarray = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user 
	   WHERE id ='".$userid."'")); 
		 
		  ?>
      <tr>
        <td><div align="center"><em>You Are Currently Logged In As: <strong>
		<?php echo $resultarray['name']; ?></strong> (<a href="../logout.php">Log Out</a>)</em></div></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <tr>
        <td bgcolor="#1E8BCC"><table width="1122" border="0" cellspacing="12" cellpadding="0">
          <tr>
            <td><div align="center" class="white"><a href="index.php" class="whitelink">USER ACCOUNTS</a> &nbsp; | &nbsp; <a href="soldproperties.php" class="whitelink">SOLD PROPERTIES</a> &nbsp; | &nbsp; <a href="updatepages.php" class="whitelink">UPDATE PAGES</a> &nbsp; | &nbsp; <a href="uploadfiles.php" class="whitelink">UPLOAD FILES</a> &nbsp; | &nbsp; <a href="sitetemplate.php" class="whitelink">SITE TEMPLATE</a> &nbsp; | &nbsp; <a href="storeddata.php" class="whitelink">STORED DATA</a></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <tr>
        <td><h2>SOLD PROPERTIES &gt; ADD PROPERTY</h2>
          <table width="1122" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><strong>Sold Date:</strong></td>
              <td>&nbsp;</td>
              <td><strong>Days On Market:</strong></td>
              <td>&nbsp;</td>
              <td><strong>Street Address:</strong></td>
              <td>&nbsp;</td>
              <td><strong>City:</strong></td>
            </tr>
            <tr>
              <td colspan="7"><img src="../images/t.gif" width="20" height="3" /></td>
            </tr>
            <?php
                      $selmonth=array();
                      
	                  for($i=1;$i<=12;$i++)
    	              {
    	              	   if($i==date('m',$select_event_details['eventdate']))
						   {
						     $selmonth[$i]="selected";	
						   }
						   else
						   {
								$selmonth[$i]="";
						   }
						  		   	
					  
					  }
                      ?>
            <tr>
              <td><select name="event_month" class="style23">
             <option value="1" <?php if($_POST['event_month']==1) echo "selected"; else echo $selmonth[1];?>  >Jan</option>
                      <option value="2" <?php if($_POST['event_month']==2) echo "selected"; else echo $selmonth[2];?> >Feb</option>
                      <option value="3" <?php if($_POST['event_month']==3) echo "selected"; else echo $selmonth[3];?> >Mar</option>
                      <option value="4" <?php if($_POST['event_month']==4) echo "selected"; else echo $selmonth[4];?> >Apr</option>
                      <option value="5" <?php if($_POST['event_month']==5) echo "selected"; else echo $selmonth[5];?>  >May</option>
                      <option value="6"  <?php if($_POST['event_month']==6) echo "selected"; else echo $selmonth[6];?>>Jun</option>
                      <option value="7"  <?php if($_POST['event_month']==7) echo "selected"; else echo $selmonth[7];?> >Jul</option>
                      <option value="8" <?php if($_POST['event_month']==8) echo "selected"; else echo $selmonth[8];?>  >Aug</option>
                      <option value="9" <?php if($_POST['event_month']==9) echo "selected"; else echo $selmonth[9];?> >Sep</option>
                      <option value="10" <?php if($_POST['event_month']==10) echo "selected"; else echo $selmonth[10];?> >Oct</option>
                      <option value="11" <?php if($_POST['event_month']==11) echo "selected"; else echo $selmonth[11];?>>Nov</option>
                      <option value="12" <?php if($_POST['event_month']==12) echo "selected"; else echo $selmonth[12];?>>Dec</option>
              </select>
                &nbsp;
                <select name="event_day" class="style23">
                  	<?php
						for($day=1;$day<=31;$day++)
						{
							if($day==date('d',$select_event_details['eventdate']))
							 {
							  $selday='selected';	
							 }
							 else
							 {
							  $selday='';	
							 }
						?>
						<option value='<?php echo $day;?>' <?php if($_POST['event_day']==$day) echo "selected"; else echo $selday;?> ><?php echo $day;?></option>
						<?php
						}
						?>
                </select>
                &nbsp;
                <select name="event_year" class="style23">
				<?php
                for($year=2014;$year<=2035;$year++)
						{
							if($year==date('Y',$select_event_details['eventdate']))
							 {
							  $selyear='selected';	
							 }
							 else
							 {
							  $selyear='';	
							 }
						    	
						?>
						<option value='<?php echo $year;?>' <?php if($_POST['event_year']==$year) echo "selected"; else echo $selyear;?> ><?php echo $year;?></option>
						<?php
						}
						?>
                </select></td>
              <td>&nbsp;</td>
              <td width="265"><input name="market" type="text" id="market" style="width: 50%" /> 
                Days</td>
              <td width="14">&nbsp;</td>
              <td width="265"><input name="address" type="text" id="address" style="width: 90%" /></td>
              <td width="14">&nbsp;</td>
              <td width="285"><select name="cities" id="cities" class="style23">
                <option selected="selected">Cape May</option>
                <option>Diamond Beach</option>
                <option>Wildwood Crest</option>
                <option>Wildwood</option>
                <option>West Wildwood</option>
                <option>North Wildwood</option>
                <option>Lower Township</option>
                <option>Middle Township</option>
                <option>Avalon</option>
                <option>Stone Harbor</option>
                <option>Custom City</option>
              </select></td>
            </tr>
            <tr>
              <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
              <td width="265"><strong>Style:</strong></td>
              <td width="14">&nbsp;</td>
              <td><strong>Bedrooms:</strong></td>
              <td>&nbsp;</td>
              <td><strong>Bathrooms:</strong></td>
              <td>&nbsp;</td>
              <td><strong>Sold Price:</strong></td>
            </tr>
            <tr>
              <td colspan="7"><img src="../images/t.gif" width="20" height="3" /></td>
            </tr>
            <tr>
              <td><input name="style" type="text" id="style" style="width: 90%" /></td>
              <td>&nbsp;</td>
              <td><select name="bedrooms" id="bedrooms" class="style23">
                <option value="1" selected="selected">Studio</option>
                <option value="1">1</option>
                <option value='2'  >2</option>
                <option value='3'  >3</option>
                <option value='4'  >4</option>
                <option value='5'  >5</option>
                <option value='6'  >6</option>
                <option value='7'  >7</option>
                <option value='8'  >8</option>
                <option value='9'  >9</option>
                <option value='10'  >10</option>
</select></td>
              <td>&nbsp;</td>
              <td><select name="bathrooms" id="bathrooms" class="style23">
                <option value="0" selected="selected">0</option>
                <option value="1">1</option>
                <option value='2'  >2</option>
                <option value='3'  >3</option>
                <option value='4'  >4</option>
                <option value='5'  >5</option>
                <option value='6'  >6</option>
                <option value='7'  >7</option>
                <option value='8'  >8</option>
                <option value='9'  >9</option>
                <option value='10'  >10</option>
              </select></td>
              <td>&nbsp;</td>
              <td><input name="price" type="text" id="price" style="width: 90%" /></td>
            </tr>
            <tr>
              <td colspan="7">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="7"><table width="246" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="style23"><strong>Image Verification</strong> (Type Below)</td>
                </tr>
                <tr>
                  <td><img src="../images/t.gif" width="10" height="4" /></td>
                </tr>
                <tr>
                  <td><table width="150" border="0" cellpadding="10" cellspacing="0" bgcolor="#CCCCCC">
                    <tr>
                      <td><div align="center" class="style8"><?php print'<img id="mainimage" src="captcha_demo.php?image" width="160" height="36" alt="CAPTCHA image">'; ?></div></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><img src="../images/t.gif" width="10" height="4" /></td>
                </tr>
                <tr>
                  <td class="style23"><a href="#"><?php print'<a href="captcha_demo.php?audio">Listen</a> &nbsp;<span class="style16"> |</span> &nbsp; <a href="#" onclick="document.getElementById(\'mainimage\').src=\'../captcha_demo.php?image=\' + new Date; return false;">New Letters</a>'; ?></td>
                </tr>
                <tr>
                  <td><img src="../images/t.gif" width="10" height="8" /></td>
                </tr>
                <tr>
                  <td><input name="captcha" type="text" id="captcha" style="width: 60%" /></td>
                </tr>
                <tr>
                  <td><img src="../images/t.gif" width="10" height="8" /></td>
                </tr>
                <tr>
                  <td><input type="submit" name="button" id="button" value="Update Event" />
                    <input type="submit" name="button2" id="button2" value="Cancel" /></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="../images/t.gif" width="10" height="8" /></td>
      </tr>
      <tr>
        <td bgcolor="#195CAB"><img src="../images/t.gif" width="10" height="2" /></td>
      </tr>
      <tr>
        <td bgcolor="#1E8BCC"><table width="1147" border="0" align="center" cellpadding="8" cellspacing="0">
          <tr>
            <td align="center" class="size12 lightblue"><em><?php include("../footer.php"); ?></em></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#195CAB"><img src="../images/t.gif" width="10" height="2" /></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="8" /></td>
      </tr>
      <tr>
        <td><table width="182" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="30"><a href="https://www.youtube.com/channel/UCAnsRSon87T8_4vhjcOs-eg" target="_blank"><img src="../images/youtube-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://twitter.com/CabreraTeam" target="_blank"><img src="../images/twitter-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://plus.google.com/u/0/117240634238969765951/posts" target="_blank"><img src="../images/googleplus-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://www.facebook.com/CabreraCoastalTeam" target="_blank"><img src="../images/facebook-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="../images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://www.linkedin.com/company/cabrera-coastal-team" target="_blank"><img src="../images/linkedin-bottom.jpg" width="30" height="30" /></a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="8" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
