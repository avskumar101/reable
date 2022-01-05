<?php

	session_start();

	require_once('../config.php');	

	

	require_once('captcha/captcha.php');

	require_once('simpleimage.php');

	 if(isset($_SESSION['uid'])=="" )

	  header("Location: ../index.php");

	$userid=$_SESSION['uid'];

			
	 	if($_POST['mlsno']!="" && $_POST['youtube']!="")		
	// if($_POST['Submit'] == "Submit")		
	{
	
	
			
			
			$mlsno=$_POST['mlsno'];
			
			$tour_url="";
			
			$youtube=$_POST['youtube']; 
			
			$proptype=$_POST['proptype'];
			
			
			
			
			if($_GET['id']=='')
			{
				
				
				$q="INSERT INTO tbl_custom_tourlink (MLSNo,Address,property_type,tour_url,youtube,newtab) Select tbl_listings.MLSNo,tbl_listings.Address,'$proptype','$tour_url','$youtube','0' from tbl_listings WHERE MLSNo=$mlsno";
				mysql_query($q);
					
				
			} 
			else{
				
				
						
				$stmt1 = "UPDATE tbl_custom_tourlink SET property_type='$proptype',tour_url='$tour_url',youtube='$youtube' WHERE MLSNo='$mlsno'";
				
				
				mysql_query($stmt1);
			
		
			} 
			
			$stmt2 = "UPDATE tbl_listings SET cust_url='$youtube' WHERE MLSNo='$mlsno'";
			
			mysql_query($stmt2);
			
		

			
		
	}

	if($_POST['btncancel']=="Cancel")		
	{
		header("Location:sitetemplate.php");
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

<script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
<script>

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');



  ga('create', 'UA-47104613-18', 'auto');

  ga('send', 'pageview');
</script>
<script>
  function propertyshow(id)
{
		
	$.ajax({  

		type: "POST",  

		url: "text_ajax.php",  

		data: "mlsno="+id,

		beforeSend: function()	{
			
			$('html, body').animate({scrollBottom:0}, 'slow');
			$("#response1").html('<img src="images/loading.gif" alt="Loading..." width="15px" height="15px">');
		},  
		success: function(response)	{		
				
		$("#youtube").val(response); 
		}
	});	
}

</script>

<script type="text/javascript">

	$(function () {		

	$('.btnGetAll').click(function () {

	if ($('.chkNumber:checked').length) {

	var chkId = '';	

	$('.chkNumber:checked').each(function () {

	chkId += $(this).val() + ",";  });		  		  

	chkId = chkId.slice(0, -1);	
	
		if(confirm('Are you sure you would like to delete?')) {	

		var url = "global_deletepage.php?pageflag=custlink&deleteids=" + chkId;

		window.open(url, "PartySearch", "width=530,height=500,left=220,top=100"); } 

		else { return false; }	
		
	} else { alert('No File Have Been Selected To Delete'); } });	

	$('.chkSelectAll').click(function () {

	$('.chkNumber').prop('checked', $(this).is(':checked')); });

	$('.chkNumber').click(function () {

	if ($('.chkNumber:checked').length == $('.chkNumber').length){

	$('.chkSelectAll').prop('checked', true); }

	else { $('.chkSelectAll').prop('checked', false); }

	});

});

</script>
</head>



<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

    <td><?php include_once("header.php");?></td></tr>

  

  <tr>

    <td><table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td><img src="../images/t.gif" width="10" height="12" /></td>

      </tr>

      <tr>

      <?php 

      	$resultarray = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user WHERE id ='".$userid."'")); 

	  ?>

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

        <td>

         
	<table width="1000" border="0" cellspacing="0" cellpadding="0">
		<form name="mlsform" id="mlsform" method="post">
		<tr>
            <td colspan="2"><img src="../images/t.gif" width="15" height="15" alt="" /></td>
        </tr>
		
		<tr>
		<td colspan="2">
		<h1>Customize MLS Listings</h1>
		</td>
		</tr>
		
		<tr>
            <td colspan="2"><img src="../images/t.gif" width="15" height="15" alt="" /></td>
        </tr>
		
		<?php
		
		if($_GET['id']!='')
		{
			 $lststmt = mysql_query("SELECT MLSNo FROM tbl_listings where active=1"); 

			
		}
		else{
			 $lststmt = mysql_query("SELECT MLSNo FROM tbl_listings where active=1 and MLSNo NOT IN (SELECT MLSNo from tbl_custom_tourlink where delete_status=0) GROUP BY MLSNo"); 

		
		} 

		

		$i=0;
			
		?>
		
		<tr>
            <td style="width: 210px;"><strong>MLS Number</strong></td>
			<td><select name="mlsno" id="mlsno" style="width: 194px;padding:10px;" onchange="propertyshow(this.value);">
			<option value=""><strong>Select MLS Number</strong></option>
			<?php
			
		
			while ($lstresult=mysql_fetch_array($lststmt))
			
			{
				
			?>
		
			<option value="<?php echo $lstresult['MLSNo'];?>"><?php echo $lstresult['MLSNo'];?></option>
		
		<?php }	?>
		</select>
		<?php
		
	
		
		$sql = mysql_query("SELECT * FROM tbl_custom_tourlink where id='".$_GET['id']."' and delete_status=0 "); 
		
		$lstupdateresult=mysql_fetch_array($sql);

		
		
		if($_GET['id']!='')
		{
			
			$mlsvalue=$lstupdateresult['MLSNo'];
			
			$youtube=$lstupdateresult['youtube'];
						
			$tour_url=$lstupdateresult['tour_url']; 
			
			$proptype=$lstupdateresult['property_type'];
			
			$virtualtour=$lstupdateresult['virtual_tour'];
			
			$link=$lstupdateresult['youtube'];
			
		}
		else{
			
			$mlsvalue="";
		
			$youtube="";
			
			$tour_url=""; 
			
			$proptype="";
		} 
		?>
		
		<script>document.getElementById("mlsno").value="<?php echo $mlsvalue; ?>";</script>
			
			</td>
        </tr>
		
		<tr>
            <td colspan="2"><img src="../images/t.gif" width="15" height="15" alt="" /></td>
        </tr>
		<tr>
		<td colspan="2">
		<table width="1000" border="0" cellspacing="0" cellpadding="0" >
		
		<tr>
		<td style="width: 210px;" ><strong>Virtual Tour Link</strong></td>
		<td>
		<input type="text" name="youtube" id="youtube" value="<?php echo $link; ?>" style="padding:10px;width: 700px;">
			
		</td>
        </tr>
		
		<tr>
            <td colspan="2"><img src="../images/t.gif" width="15" height="15" alt="" /></td>
        </tr>
		
		
		</table>
		
		</td>
		</tr>
		<tr>
		<td colspan="2">		
        
		<div class="g-recaptcha" data-sitekey="<?php echo $sitekey;?>"></div>
		
		</td>
		</tr>
		
		<tr>
            <td colspan="2"><img src="../images/t.gif" width="15" height="15" alt="" /></td>
        </tr>
		
		<tr>
            <td colspan="2"> <div align="left">
			<input type="hidden" name="btnSubmit" id="btnSubmit" value="Submit" />
			<input type="submit" name="Submit" id="Submit" value="Submit" onclick="return validateForm();" />&nbsp;&nbsp;&nbsp;
			<input type="submit" name="btncancel" id="btncancel" value="Cancel" />
			</div>
		
			</td>
        </tr>
		<tr>
            <td colspan="2"><img src="../images/t.gif" width="15" height="15" alt="" /></td>
        </tr>
		</form>
		</table>
		<tr>
            <td>
	<table width="1122" border="0" cellpadding="8" cellspacing="1" bgcolor="#FFFFFF">
		<tr>
		<td colspan="5" align="right">
		<input type="button" name="button2" id="button2" class="btnGetAll"   value="Delete Selected" /></td>
		</tr>
		
		<tr>

		  <td width="150" bgcolor="#CCCCCC"><strong>MLSNo</strong></td>

		  <td width="300" bgcolor="#CCCCCC"><div align="center"><strong>Address</strong></div></td>

		
		  
		  <td width="115" bgcolor="#CCCCCC"><div align="center"><strong>Modify</strong></div></td>
		  
		  <td width="50" bgcolor="#CCCCCC"><div align="center"><input type="checkbox" name="selectallimage" id="selectallimage" class="chkSelectAll"/></div></td>
		</tr>
		
		<?php
		
		$STMk = mysql_query("SELECT * FROM tbl_custom_tourlink where delete_status=0 and MLSNo IN (select MLSNo from tbl_listings where active=1)");

	

		$i=1;
		
		while ($dsngj=mysql_fetch_array($STMk))
		
		{ 
			if($i%2==0)
				$bgcolor="#F9FADA"; 
			else
				$bgcolor="#F1F0F0";
			
		?>
		
		<tr>

		  <td width="150" bgcolor="<?php echo $bgcolor; ?>"><?php echo $dsngj["MLSNo"]; ?></td>

		  <td width="300" bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="../property.php?MLSNo=<?php echo $dsngj["MLSNo"]; ?>"><?php echo $dsngj["Address"]; ?></a></div></td>

		  <!--<td width="200" bgcolor="<?php //echo $bgcolor; ?>"><div align="center"><?php //echo $dsngj["property_type"]; ?></td>-->

		  <td width="115" bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="tourlink.php?id=<?php echo $dsngj["id"]; ?>">Modify</a></div></td>
		  
		 <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><input type="checkbox" name="chk_delete[]" id="chk_delete"  class="chkNumber" value="<?php echo $dsngj["MLSNo"]; ?>"  /></div></td>

		</tr>
		
		<?php	
			$i=$i+1;
		}
		?>
		<input type="hidden" name="total_count" id="total_count" value="<?php echo $i-1; ?>">   
		</table>
		
		</td>
        </tr>
		
		</table>
		  </td>

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

</body><?php require_once('googletagmanager.php'); ?>

</html>

