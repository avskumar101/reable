<?php
	session_start();
	require_once('../config.php');
	require_once('simpleimage.php');
	require_once('captcha/captcha.php');
	if(isset($_SESSION['uid'])=="" )
	  header("Location: ../index.php");
	$userid=$_SESSION['uid'];
	
	//$qry=mysql_query("update  tbl_events set deletestatus=1 WHERE DATE_FORMAT(NOW(),'%m/%d/%Y') > DATE_FORMAT(FROM_UNIXTIME(customdate),'%m/%d/%Y') and customdate != ''");

	$ID=$_GET['id'];
	$select_event_details['eventdate']=time();
	 $eventdate=mktime(0, 0, 0, $_POST['event_month'], $_POST['event_day'], $_POST['event_year']);

	
	if(ID!="" && $_GET[del]=='1')
	{
		$qry="update `tbl_events` set deletestatus = '1' where id='$ID' ";	
		mysql_query($qry);	
		header("Location: updatepages-events.php");	
	}
	if($_POST['update']!='')
	{
	
      if($_POST['captcha']!='')
		{
			if(captcha_validate())
			{
			
				$eventname=$_POST['event_name'];
				$event_desc=$_POST['event_desc'];
				$custdate=$_POST['customdate'];
				$custdateobj = explode("/",$custdate);
				$custdatemonth = $custdateobj[0];
				$custdateday = $custdateobj[1];
				$custdateyear = $custdateobj[2];
				//$cusdate=mktime(0, 0, 0, $custdatemonth, $custdateday, $custdateyear);
				$cusdate=$custdate;
				$eventcity=$_POST['event_city'];
				if($eventcity == "Custom City"){
					$eventcity = $_POST['Custom_City'];
					$customcity = $_POST['Custom_City'];
				}else{
					$customcity = "";
				}
				//$Custom_City=$_POST['Custom_City'];
				
				if($_POST['autodelete']=='on')
			   	{
					$autodelete=1;	
					//$eventdate = $cusdate;
					$custdateobj = explode("-",$custdate);
					if($custdateobj[1] != ""){
						$eventdate = $custdateobj[1];
					}else{
						$eventdate = $custdateobj[0];
					}
					$eventdate = strtotime($eventdate);
									
			   	}
			   	else
			   	{
					$autodelete=0;
					$cusdate = "";
			   	}
			   
				
				if($ID=="")
				{
				
				mysql_query("insert into tbl_events set eventname='".mysql_real_escape_string($eventname)."',eventdate='".mysql_real_escape_string($eventdate)."',usecustdate='".$autodelete."',event_desc='".mysql_real_escape_string($event_desc)."',city='".mysql_real_escape_string($eventcity)."',Custom_City='".mysql_real_escape_string($customcity)."',customdate='".mysql_real_escape_string($cusdate)."',deletestatus=0");
				
				
				
						
				
				}
				if($ID!="")
				{
				
					mysql_query("update tbl_events set eventname='".mysql_real_escape_string($eventname)."',eventdate='".mysql_real_escape_string($eventdate)."',usecustdate='".$autodelete."',event_desc='".mysql_real_escape_string($event_desc)."',city='".mysql_real_escape_string($eventcity)."',Custom_City='".mysql_real_escape_string($customcity)."',customdate='".mysql_real_escape_string($cusdate)."' where id='$ID'" );	
				
				}					
				
			header("Location: updatepages-events.php");	
			
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
	if($_POST['cancel']!='')
	{
	header("Location: events.php");	
	}
	$qry=mysql_query("update  tbl_events set deletestatus=1 WHERE DATE_FORMAT(NOW(),'%m/%d/%Y') > DATE_FORMAT(FROM_UNIXTIME(eventdate),'%m/%d/%Y') and eventdate != ''");
	
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



function eventdelete(delid){
		hidalldeleteid = delid;
    	if(confirm('Are you sure you would like to delete?'))
		{
			var PopupWindow=null;
			settings='width=500,height=250,left=100,top=100,directories=no,menubar=no,toolbar=no,status=no,scrollbars=yes,resizable=no,dependent=no';
			PopupWindow=window.open("global_deletepage.php?pageflag=delete_event&deleteids="+hidalldeleteid,"CustomPopUp",settings);   
			PopupWindow.focus();
			return true;
		} 
	
}


function showcustomcity(a){
	custcity = document.getElementById('event_city').value;
	document.eventform.event_city.selectedindex = 1;
	if(custcity == "Custom City"){
		document.getElementById('custcitytext').style.display="block";
		document.getElementById('custcitytextvalue').style.display="block";
	}else{
		document.getElementById('custcitytext').style.display="none";
		document.getElementById('custcitytextvalue').style.display="none";
	}
	
}

function submitvalidate(){
	custdatecheck = document.getElementById('autodelete').checked;
	custdatevalue = document.getElementById('customdate').value;
	cityvalue = document.getElementById('event_city').value;
	custcityvalue = document.getElementById('Custom_City').value;
	if(custdatecheck == true){
		if(custdatevalue == ""){
			alert('Custom date field should not be empty');
			return false;
		}
	}
	if(cityvalue == 'Custom City'){
		if(custcityvalue == ""){
			alert('Custom city field should not be empty');
			return false;
		}
	}
	return true;
}

</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form name="eventform" id="eventform" method="post" action="#" enctype='multipart/form-data' onsubmit="return submitvalidate()">  
<tr>
    <td><?php include_once("header.php");?></td></tr>
  
  <tr>
    <td><table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <tr>
        <?php $resultarray = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id ='".$userid."'")); 
		 
		  ?>
            <td><div align="center" class="style9"><em>You Are Currently Logged In As: <strong><?php echo $resultarray['name']; ?></strong> (<a href="../logout.php">Log Out</a>)</em></div></td>
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
        <td><h2>UPDATE PAGES &gt; MODIFY</h2>
          <table width="1122" border="0" cellspacing="0" cellpadding="0">
		  <?
			$select_event_details=mysql_fetch_array(mysql_query("select * from tbl_events where id='$ID'"));
			
			if(!isset($select_event_details['eventdate']))
			  {
				$select_event_details['eventdate']=time();
			  }
			  ?>
            <tr>
              <td><strong>Event Name:</strong></td>
              <td>&nbsp;</td>
              <td><strong>Event Description:</strong></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="20" height="3" /></td>
            </tr>
			  <?
					if($_POST['event_name']=="")
						$txt_event_name_value=stripslashes($select_event_details['eventname']);
					else
						$txt_event_name_value=$_POST['event_name'];
					?>
           
					 <tr>
              <td><input name="event_name" type="text" id="event_name" style="width: 85%"   value="<?php echo $txt_event_name_value; ?>"/></td>
              <td>&nbsp;</td>
			   <?
					if($_POST['event_desc']=="")
						$txt_event_desc_value=stripslashes($select_event_details['event_desc']);
					else
						$txt_event_desc_value=$_POST['event_desc'];
					?>
              <td><input name="event_desc" type="text" id="event_desc" style="width: 85%"    value="<?php echo $txt_event_desc_value; ?>"/></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
           <tr>
                  <td width="285"><strong>Date:</strong></td>
                  <td width="22">&nbsp;</td>
                  <td width="815"><strong>
				  <?php 
				 
				  if($select_event_details['usecustdate']=="1")
				  {
				 
				  $checkeds="checked";
				  }
				  else
				  {
				 
				  $checkeds="";
				  
				  }
				  
				  
				  ?>
                    <input name="autodelete" type="checkbox" id="autodelete" <?php echo $checkeds; ?> />
                    Use A Custom Date:</strong> <span class="style2">(Event Date Will Still Control When The Event Is Deleted From The System And Where It Displays. Example Format:Aug 17th 2014 (or) August 7th 2014 - August 10th 2014)</span></td>
                </tr>
                <tr>
                  <td colspan="3"><img src="../images/t.gif" width="20" height="3" /></td>
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
						for($year=2010;$year<=2030;$year++)
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
				  <?php
					if($_POST['customdate']==""){
						if($select_event_details['customdate'] !=""){
							$txt_customdate_value=$select_event_details['customdate'];
						}else{
							$txt_customdate_value= "";
						}
					}
					else{
						$txt_customdate_value=$_POST['customdate'];
					}
						
				?>
                  <td><input name="customdate" type="text" id="customdate" style="width: 45%" value="<? echo $txt_customdate_value; ?>"/></td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
  
            <tr>
              <td><strong>Select City:</strong></td>
              <td>&nbsp;</td>
              <td><div id="custcitytext" name="custcitytext" style="display:none;"><strong>Type In A Custom City Here: </strong></div></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="20" height="3" /></td>
            </tr>
            <tr>
			<?php 
				if($select_event_details['city']=="Cape May")
				{
				
				$city1="selected";
				}
				elseif($select_event_details['city']=="Diamond Beach")
				{
			
				$city2="selected";
				}
				elseif($select_event_details['city']=="Wildwood Crest")
				{
				$city3="selected";
				}
				elseif($select_event_details['city']=="Wildwood")
				{
				$city4="selected";
				}
				elseif($select_event_details['city']=="West Wildwood")
				{
				$city5="selected";
				}
				elseif($select_event_details['city']=="North Wildwood")
				{
				$city6="selected";
				}
				elseif($select_event_details['city']=="Lower Township")
				{
				$city7="selected";
				}
				elseif($select_event_details['city']=="Middle Township")
				{
				$city8="selected";
				}
				elseif($select_event_details['city']=="Avalon")
				{
				$city9="selected";
				}
				elseif($select_event_details['city']=="Stone Harbor")
				{
				$city10="selected";
				}
				else
				{
				$city11="selected";
				}
				?>
              <td><select name="event_city" id="event_city" class="style23" onchange="return showcustomcity(this.value);">
                <option value="Cape May" <?php echo $city1; ?>>Cape May</option>
                <option value="Diamond Beach" <?php echo $city2; ?>>Diamond Beach</option>
                <option value="Wildwood Crest" <?php echo $city3; ?>>Wildwood Crest</option>
                <option value="Wildwood" <?php echo $city4; ?>>Wildwood</option>
                <option value="West Wildwood" <?php echo $city5; ?>>West Wildwood</option>
                <option value="North Wildwood" <?php echo $city6; ?>>North Wildwood</option>
                <option value="Lower Township" <?php echo $city7; ?>>Lower Township</option>
                <option value="Middle Township" <?php echo $city8; ?>>Middle Township</option>
                <option value="Avalon" <?php echo $city9; ?>>Avalon</option>
                <option value="Stone Harbor" <?php echo $city10; ?>>Stone Harbor</option>
                <option value="Custom City" <?php echo $city11; ?>>Custom City</option>
              </select></td>
              <td>&nbsp;</td>
			   <?php
			  		if($_POST['Custom_City']=="")
						$txt_event_desc_city=$select_event_details['Custom_City'];
					else
						$txt_event_desc_city=$_POST['Custom_City'];
						?>
              <td><div id="custcitytextvalue" name="custcitytextvalue" style="display:none;"><input name="Custom_City" type="text" id="Custom_City" style="width: 45%" value="<?php echo $txt_event_desc_city; ?>" /></div></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
            <td>
            <table width="270" border="0" cellspacing="2" cellpadding="1">
						<tr>
							<td width="231" align="left"><strong>Image Verification </strong><span class="graytext">(Type Below)</span></td>
						</tr>
						<tr>
							<td align="left"><?php print'<img id="mainimage" src="captcha_demo.php?image" width="160" height="36" alt="CAPTCHA image">'; ?></td>
						</tr>
						<tr>
							<td align="left"><span><?php print'<a href="captcha_demo.php?audio">Listen</a> &nbsp;<span class="style16"> |</span> &nbsp; <a href="#" onclick="document.getElementById(\'mainimage\').src=\'../captcha_demo.php?image=\' + new Date; return false;">New Letters</a>'; ?></span></td>
						</tr>
						<tr>
							<td align="left"><input type="text" name="captcha" id="captcha" /></td>
						</tr>
					</table>           <tr>
                  <td><img src="../images/t.gif" width="10" height="8" /></td>
                </tr>
                <tr>
                  <td><input type="submit" name="update" id="update" value="Update Event" />
                    <input type="submit" name="button2" id="button2" value="Cancel" /></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" bgcolor="#CCCCCC"><img src="../images/t.gif" width="10" height="1" /></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3"><table width="1122" border="0" cellpadding="8" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                  <td width="506" bgcolor="#CCCCCC"><strong>Event Name</strong></td>
                  <td width="175" bgcolor="#CCCCCC"><div align="center"><strong>DATE</strong></div></td>
                  <td width="175" bgcolor="#CCCCCC"><div align="center"><strong>LOCATION</strong></div></td>
                  <td width="90" bgcolor="#CCCCCC"><div align="center"><strong>MODIFY</strong></div></td>
                  <td width="90" bgcolor="#CCCCCC"><div align="center"><strong> DELETE </strong></div></td>
                </tr>
			<?php $result=mysql_query("select * from tbl_events where deletestatus=0 order by eventdate");
					 $i = 1;
                   while($templates = @mysql_fetch_array($result))
				   {
				   if($i%2==0)
						$bgcolor="#CAE1F7";
					    else
						$bgcolor="#F8F7E0";
						?>

                <tr>
                   <td bgcolor="<?php echo $bgcolor; ?>"><div align="left"><?php echo stripslashes($templates['eventname']) ?></div></td>
				 <?php
				 if($templates['usecustdate'] == '1'){
				 ?>
				 	<td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><?php echo $templates['customdate']; ?></div></td>
				 <?php
				 }else{
				 ?>
				 	<td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><?php echo date('F jS Y', $templates['eventdate']) ?></div></td>
				 <?php
				 }
				 ?>
                  
				   <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><?php echo $templates['city']; ?></div></td>
                      <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="updatepages-events.php?id=<?php echo $templates['id']; ?>">Modify</a></div></td>
                      <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="#" onclick="return eventdelete(<?php echo $templates['id']; ?>);">Delete</a></div></td>
                    </tr>
					 <?php
					$i=$i+1;
				
					}
					?>
                 
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
</form>
<?php
$customcityval = $select_event_details['city'];
if($customcityval == ""){
	$customcityval = "Cape May";
?>
	<script>
		document.eventform.event_city.selectedIndex = 0;
	</script>
<?php
}
?>
<script>
showcustomcity('<?php echo $customcityval;?>');
</script>
</table>
</body><?php require_once('googletagmanager.php'); ?>
</html>
