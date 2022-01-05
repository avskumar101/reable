<?php
	session_start();
	
	require_once('../config.php');
	require_once('captcha/captcha.php');
	if(isset($_SESSION['uid'])=="" )
		header("Location: ../index.php");
	$userid=$_SESSION['uid'];
	if(isset($_POST['button'])=="Add Agent"){
	
		$agent_firstname=$_POST['select'];
		
		$agent_lastname=$_POST['select'];
		$agentname = explode("~",$agent_firstname);
	
		$agentfirst = $agentname[0];
		$agentlast = $agentname[1];

		
		$qry="insert into tbl_listingsagent(agent_firstname,agent_lastname,delete_status) values ('".$agentfirst."','".$agentlast."','0')";
		
		mysql_query($qry);
					
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

  function eventdelete(delid){
		hidalldeleteid = delid;
    	if(confirm('Are you sure you would like to delete?'))
		{
			var PopupWindow=null;
			settings='width=500,height=250,left=100,top=100,directories=no,menubar=no,toolbar=no,status=no,scrollbars=yes,resizable=no,dependent=no';
			PopupWindow=window.open("global_deletepage.php?pageflag=delete_agent&deleteids="+hidalldeleteid,"CustomPopUp",settings);   
			PopupWindow.focus();
			return true;
		} 
	
}
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form name="user" method="post">
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
        <td><h2>SITE TEMPLATE &gt; AGENTS FOR CABRERA LISTINGS</h2>
          <p>SELECT AN AGENT: 
		  <?php
					$result=@mysql_query("SELECT `agent_firstname`,`agent_lastname`FROM `tbl_listings` WHERE agent_firstname is not null  and agent_lastname is not null group by agent_firstname");
					
					?>
            <select name="select" id="select">
			<?php while($resultarray = @mysql_fetch_array($result)) {  ?>
              <option selected="selected" value="<?php echo $resultarray['agent_firstname'];?>~<?php echo $resultarray['agent_lastname'];?>"><?php echo $resultarray['agent_firstname'];?> <?php echo $resultarray['agent_lastname'];?> </option>
			  <?php
			  }
			  ?>   
            </select>
            <input type="submit" name="button" id="button" value="Add Agent" />
          </p>
          <table width="1122" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
            <tr>
              <td bgcolor="#CCCCCC"><strong>Displaying Properties Listed By:</strong>           			  <div align="center"></div></td>
              </tr>
			   <?php
					$result=@mysql_query("SELECT * FROM tbl_listingsagent where delete_status!=1");
					
				   $i=1;
                   while($resultarray = @mysql_fetch_array($result))
				   {
				   ?>
            <tr>
              <td bgcolor="#CAE1F7" class="lrgspacing"><?php echo $resultarray['agent_firstname'];?> <?php echo $resultarray['agent_lastname'];?>(<a href="#" onclick="return eventdelete(<?php echo $resultarray['id']; ?>);">x</a>)<br />
               </td>
			   <?php
			   }
			   ?>
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
</table>
</body><?php require_once('googletagmanager.php'); ?>
</html>
