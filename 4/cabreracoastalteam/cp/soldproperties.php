<?php

	session_start();
	require_once('../config.php');
	if(isset($_SESSION['uid'])=="" )
	header("Location: ../index.php");
	$userid=$_SESSION['uid'];
	define('DEF_PAGE_SIZE',20);
	$pagesize=20;
	@extract($_POST);
	@extract($_GET);
	ob_start();
	if($_POST['list_all']=="List All"){
	}
	require_once("sold_query.php");
	
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
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function addsold()
{
window.location.href="soldproperties-add.php";
}
function generateexcel()
{

	document.sold_data.action="soldexportexcel.php";
	return true;
}
function listall()
{
	document.sold_data.submit();
	return true;
}
function select_allimages()
	{
        var selall = document.getElementById('selectallimage').checked;
        var chkbox;
        var form_name = document.getElementById('sold_data');
        var totalcnt = document.getElementById('total_count').value;
    
        if(totalcnt == '1')
        {
            if(selall)
            {
                form_name.chk_delete.checked = true;
            } 
            else 
            {
                form_name.chk_delete.checked = false;
            }
        } 
        else 
        {
            var chkboxArray = form_name.chk_delete.length;
            
            if(selall)
            {
                for(i=0; i<chkboxArray; i++)
                {
                    form_name.chk_delete[i].checked = true;
                }
            } 
            else 
            {
                for(i=0; i<chkboxArray; i++)
                {
                    form_name.chk_delete[i].checked = false;
                }
            }
        }
    }
	function confirm_user_delete()
	{
		var form_name = document.getElementById('sold_data');
		var chkboxArray = form_name.chk_delete.length;
		var totalcnt = document.getElementById('total_count').value;
    	var hidalldeleteid = "";
    	var flagvalue = 0;
    	
    	if(totalcnt == '1')
        {
            if(form_name.chk_delete.checked == true)
            {
           		hidalldeleteid = form_name.chk_delete.value;
				flagvalue = 1;
            }
            else
            	flagvalue = 0;
        }
        else 
        {
        	for(i=0; i<chkboxArray; i++)
	        {
	        	if(form_name.chk_delete[i].checked == true)
	            {
	            	if(hidalldeleteid=="")
	        			hidalldeleteid += form_name.chk_delete[i].value;
    	    		else
        				hidalldeleteid += "~" + form_name.chk_delete[i].value;
        				
        			flagvalue = 1;
	            }
	        }
    	}
    	
    	if(flagvalue == 0)
	    {
	    	alert("No Features Have Been Selected To Delete");
	    	exit;
	    }
	    else
	    {
	    	if(confirm('Are you sure you would like to delete?'))
			{
				var PopupWindow=null;
				settings='width=500,height=250,left=100,top=100,directories=no,menubar=no,toolbar=no,status=no,scrollbars=yes,resizable=no,dependent=no';
				PopupWindow=window.open("global_deletepage.php?pageflag=solddata&deleteids="+hidalldeleteid,"CustomPopUp",settings);   
				PopupWindow.focus();
				return true;
			} 
			else 
			{
				return false;
			}
	    }
	}
	

</script>
<script>
function uploadexcel()
	{
		var form_name = document.getElementById('sold_data');
		var chkboxArray = form_name.chk_delete.length;
		
    	var hidalldeleteid = "";
    	var flagvalue = 0;  
    	if(flagvalue == 0)
	    {	
				var PopupWindow=null;
				settings='width=500,height=250,left=100,top=100,directories=no,menubar=no,toolbar=no,status=no,scrollbars=yes,resizable=no,dependent=no';
				PopupWindow=window.open("uploadexcel.php?pageflag=upload&deleteids="+hidalldeleteid,"CustomPopUp",settings);   
				PopupWindow.focus();
				return true;	
			
		}
	    
	}
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form enctype="multipart/form-data" name="sold_data" id="sold_data" method="POST">
<tr>
    <td><?php include_once("header.php");?></td></tr>
  
  <tr>
    <td><table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">
	<form enctype="multipart/form-data" name="sold" id="sold" method="POST">
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
        <td><h2>SOLD PROPERTIES</h2>
          <table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="423" align="left"><select name="select_feature" id="select_feature">
                <option selected="selected">All Locations</option>
                <option value="02" <?php echo $selectfeature2;  ?>>Cape May</option>
                <option value="03" <?php echo $selectfeature3;  ?>>Diamond Beach</option>
                <option value="04" <?php echo $selectfeature4;  ?>>Wildwood Crest</option>
                <option value="05" <?php echo $selectfeature5;  ?>>Wildwood</option>
                <option value="06" <?php echo $selectfeature6;  ?>>West Wildwood</option>
                <option value="07" <?php echo $selectfeature7;  ?>>North Wildwood</option>
                <option value="08" <?php echo $selectfeature8;  ?>>Lower Township</option>
                <option value="09" <?php echo $selectfeature9;  ?>>Middle Township</option>
                <option value="10" <?php echo $selectfeature10; ?>>Avalon</option>
                <option value="11" <?php echo $selectfeature11; ?>>Stone Harbor</option>
              </select>
               <input type="submit" name="sort_data" id="sort_data" value="Sort Data"/td>
              <td width="699" align="right"><a href="sample_solddata_importfile_template.xlsx"><input type="button" name="button5" id="button5" value="SOLD_DATA TEMPLATE"></a>
              	<input type="button" name="button5" id="button5" value="Upload Sold Properties" onclick=" uploadexcel();">
                <input type="submit" onclick="return listall()" name="list_all" id="list_all" value="List All" />
                <input type="button" name="button2" id="button2" value="Delete Selected" onclick="confirm_user_delete();" />
                 <input name="button2" type="submit" id="button2" onclick="return generateexcel();" value="Export Data To Excel" />
            </tr>
          </table>
          <br />
		  
          <table width="1122" border="0" cellspacing="1" cellpadding="6">
            <tr>
              <td width="77" bgcolor="#CCCCCC"><strong>SOLD DATE</strong></td>
              <td width="77" bgcolor="#CCCCCC"><strong>DOM</strong></td>
              <td width="220" bgcolor="#CCCCCC"><strong>ADDRESS</strong></td>
              <td width="210" bgcolor="#CCCCCC"><strong>CITY</strong></td>
              <td width="165" bgcolor="#CCCCCC"><strong>STYLE</strong></td>
              <td width="65" bgcolor="#CCCCCC"><strong>MLS</strong></td>
              <td width="100" bgcolor="#CCCCCC"><strong>ASKING PRICE</strong></td>
              <td width="105" bgcolor="#CCCCCC"><strong>SOLD PRICE</strong></td>
              <td width="20" bgcolor="#CCCCCC"><input type="checkbox" name="selectallimage" id="selectallimage" onClick="return select_allimages();" /></td>
            </tr>
			 <?php
					//$result=@mysql_query("SELECT * FROM tbl_sold where delete_status!=1 ");
					
				   $i=1;
                   while($resultarray = @mysql_fetch_array($result))
				   {
					if($i%2==0)
							$bgcolor="#CAE1F7";
						else
							$bgcolor="#F8F7E0";
                 
					?>
            <tr>
               <td bgcolor="<?php echo $bgcolor; ?>"><div align="left"><?php echo $resultarray['date'] ?></div></td>
              <td bgcolor="<?php echo $bgcolor; ?>"><div align="left"><?php echo $resultarray['market'] ?> Days
              <td bgcolor="<?php echo $bgcolor; ?>"><div align="left"><?php echo $resultarray['address'] ?>
              <td bgcolor="<?php echo $bgcolor; ?>"><div align="left"><?php echo $resultarray['city'] ?>
              <td bgcolor="<?php echo $bgcolor; ?>"><div align="left"><?php echo $resultarray['style'] ?>
             <td bgcolor="<?php echo $bgcolor; ?>"><div align="left"><?php echo $resultarray['mls_no'] ?>
             <td bgcolor="<?php echo $bgcolor; ?>"><div align="left">$<?php echo  number_format($resultarray['asking_price']) ?>
             <td bgcolor="<?php echo $bgcolor; ?>"><div align="left">$<?php echo  number_format($resultarray['soldprice']) ?>
             <td  bgcolor="<?php echo $bgcolor; ?>" "><div align="left">
             <input type="checkbox" name="chk_delete[]" id="chk_delete" value="<?php echo $resultarray['id']; ?>" />
            </tr>
            <?php
					$i=$i+1;
				
					}
					?>
					<input type="hidden" name="total_count" id="total_count" value="<? echo $i-1; ?>">
      </table></td>
      </tr>
      <tr>
        <td><table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="2"><img src="../images/t.gif" width="10" height="5" /></td>
          </tr>
          <tr>
            <td width="570" align="left"><em class="gray size13">Displaying <?=$start+1 ?> - 
            <?=($reccnt<=$start+$pagesize)?($reccnt):($start+$pagesize) ?>
			  of  <?=$reccnt ?></em></td>
             <td width="772"><div align="right"> <span class="style23">
				<?php include_once("paging.inc.php");?>
                </span></div></td>
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
</body><?php require_once('googletagmanager.php'); ?>
</html>
