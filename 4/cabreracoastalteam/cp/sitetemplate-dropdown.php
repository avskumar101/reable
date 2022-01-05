<?php
	session_start();
	
	require_once('../config.php');
	require_once('captcha/captcha.php');
	
	$baseurl= "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/cabrerateam";
	
	if(isset($_SESSION['uid'])=="" )
		header("Location: ../index.php");
	$userid=$_SESSION['uid'];
		
	$ID = $_GET['id'];
		 
	if($_POST['addlink']=="Add Link")		
	{
		if($_POST['captcha']!='')
		{
		   if(captcha_validate())
		   {
			$page_name = $_POST['txt_name'];
            $page_link = $_POST['txt_url'];
			$under = $_POST['select_under'];
			
			if($ID == ""){
			mysql_query("insert into tbl_web_subpage (pagename,pagelink,main_link,delete_status) values ('".mysql_real_escape_string($page_name)."','".mysql_real_escape_string($page_link)."','".mysql_real_escape_string($under)."','0')");
			$lastid = mysql_insert_id();
			$result= mysql_fetch_array(mysql_query("SELECT max(id) as orderstatus FROM tbl_web_subpage where id=".$lastid));
			$orderid = 	$result['orderstatus']+1; 
            mysql_query("UPDATE tbl_web_subpage SET orderstatus='".$orderid."' WHERE id ='".$lastid."'");
			echo "<script>window.location.href='sitetemplate-dropdown.php'</script>";
			} else {
			mysql_query("UPDATE tbl_web_subpage SET pagename='".$page_name."',pagelink='".$page_link."',main_link='".$under."'   WHERE id ='".$ID."'");
			echo "<script>window.location.href='sitetemplate-dropdown.php'</script>";
			}
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

//update order	
	if($_POST['btnrankorder']!='')
	{
		//SALES
		$featureids = $_POST['txtsalesid'];
		$featureorderids = $_POST['textsalesorder'];	
		for($x=0; $x<count($featureids); $x++)
		{
			$sql = "UPDATE tbl_web_subpage SET orderstatus=".$featureorderids[$x]." WHERE id=".$featureids[$x];		
			mysql_query($sql);	
		}
		//RENTALS
		$rentalsids = $_POST['txtrentalsid'];
		$rentalsorderids = $_POST['txtrentalsorder'];	
		for($x=0; $x<count($rentalsids); $x++)
		{
			$sql = "UPDATE tbl_web_subpage SET orderstatus=".$rentalsorderids[$x]." WHERE id=".$rentalsids[$x];		
			mysql_query($sql);	
		}
		//MEET THE TEAM
		$meetteamids = $_POST['txtmeetteamid'];
		$meetteamorderids = $_POST['txtmeetteamorder'];	
		for($x=0; $x<count($meetteamids); $x++)
		{
			$sql = "UPDATE tbl_web_subpage SET orderstatus=".$meetteamorderids[$x]." WHERE id=".$meetteamids[$x];		
			mysql_query($sql);	
		}
		//PROPERTY MANAGEMENT
		$managementids = $_POST['txtmanagementsid'];
		$managementorderids = $_POST['txtmanagementsorder'];	
		for($x=0; $x<count($managementids); $x++)
		{
			$sql = "UPDATE tbl_web_subpage SET orderstatus=".$managementorderids[$x]." WHERE id=".$managementids[$x];		
			mysql_query($sql);	
		}
		//CAPE MAY COUNTY
		$capmaycountyids = $_POST['txtcapmaycountyid'];
		$capmaycountyorderids = $_POST['txtcapmaycountyorder'];	
		for($x=0; $x<count($capmaycountyids); $x++)
		{
			$sql = "UPDATE tbl_web_subpage SET orderstatus=".$capmaycountyorderids[$x]." WHERE id=".$capmaycountyids[$x];		
			mysql_query($sql);	
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
function select_all()
	{
        var selall = document.getElementById('delete_all').checked;
        var chkbox;
        var form_name = document.getElementById('template-dropdownpage');
		
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
	
	function confirm_suites_delete()
	{
		var form_name = document.getElementById('template-dropdownpage');
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
	    	alert("No Files Have Been Selected To Delete");
	    	exit;
	    }
	    else
	    {
	    	if(confirm('Are you sure you would like to delete the subpages?'))
			{
				var PopupWindow=null;
				settings='width=500,height=250,left=100,top=100,directories=no,menubar=no,toolbar=no,status=no,scrollbars=yes,resizable=no,dependent=no';
				PopupWindow=window.open("global_deletepage.php?pageflag=dropdowntemplate&deleteids="+hidalldeleteid,"CustomPopUp",settings);   
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
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form name="template-dropdownpage" id="template-dropdownpage" method="POST" enctype='multipart/form-data'>
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
            <td><div align="center" class="white"><a href="index.php" class="whitelink">USER ACCOUNTS</a> &nbsp; | &nbsp; <a href="soldproperties.php" class="whitelink">SOLD PROPERTIES</a> &nbsp; | &nbsp; <a href="updatepages.php" class="whitelink">UPDATE PAGES</a> &nbsp; | &nbsp; <a href="uploadfiles.php" class="whitelink">UPLOAD FILES</a> &nbsp; | &nbsp; <a href="sitetemplate.php" class="whitelink">SITE TEMPLATE</a>  &nbsp; | &nbsp; <a href="storeddata.php" class="whitelink">STORED DATA</a></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <tr>
        <td><h2>SITE TEMPLATE &gt; DROP DOWN NAVIGATION</h2>
          <table width="1122" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="301"><strong>Link Name:</strong></td>
              <td width="16">&nbsp;</td>
              <td width="805"><strong>Include The Pages URL: </strong><span class="gray">(Example: http://www.cabrerateam.com/pagename.php)</span></td>
            </tr>
			<?php $dispalys = mysql_fetch_array(mysql_query("SELECT * FROM tbl_web_subpage WHERE id ='".$ID."'")); 
			?>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="5" /></td>
            </tr>
            <tr>
              <td><input name="txt_name" type="text" id="txt_name" style="width: 95%" value="<?php echo $dispalys['pagename'];?>"/></td>
              <td>&nbsp;</td>
              <td><input name="txt_url" type="text" id="txt_url" style="width: 95%" value="<?php echo $dispalys['pagelink'];?>"/></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3"><strong>Display Under:</strong></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="5" /></td>
            </tr>
            <tr>
				<?php 
					if($dispalys['main_link']=='SALES')
					{
					$under1 = "selected";
					}
					else if($dispalys['main_link']=='RENTALS')
					{
					$under2 = "selected";
					}
					else if($dispalys['main_link']=='MEET THE TEAM')
					{
					$under3 = "selected";
					}
					else if($dispalys['main_link']=='PROPERTY MANAGEMENT')
					{
					$under4 = "selected";
					}
					else if($dispalys['main_link']=='CAPE MAY COUNTY')
					{
					$under5 = "selected";
					}
					?>
				<td colspan="3"><select name="select_under" id="select_under">
                <option <?php echo $under1 ?>>SALES</option>
                <option <?php echo $under2 ?>>RENTALS</option>
                <option <?php echo $under3 ?>>MEET THE TEAM</option>
                <option <?php echo $under4 ?>>PROPERTY MANAGEMENT</option>
                <option <?php echo $under5 ?>>CAPE MAY COUNTY</option>
				</select></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3"><table width="246" border="0" cellspacing="0" cellpadding="0">
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
              <td class="style23"><span><?php print'<a href="captcha_demo.php?audio">Listen</a> &nbsp;<span class="style16"> |</span> &nbsp; <a href="#" onclick="document.getElementById(\'mainimage\').src=\'captcha_demo.php?image=\' + new Date; return false;">New Letters</a>'; ?></span></td>
            </tr>
            <tr>
              <td><img src="../images/t.gif" width="10" height="8" /></td>
            </tr>
            <tr>
              <td><input type="text" name="captcha" id="captcha" style="width: 60%" /></td>
            </tr>
                <tr>
                  <td><img src="../images/t.gif" width="10" height="8" /></td>
                </tr>
                <tr>
                  <td><input type="submit" name="addlink" id="addlink" value="Add Link" />
                    <input type="button" name="button4" id="button5" onclick="window.location.href='sitetemplate.php'" value="Cancel" /></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="3" align="right"><input type="submit" name="btnrankorder" id="btnrankorder" value="Update Rank Order" />
                <input type="button" name="delete_subpages" id="delete_subpages" value="Delete Selected" onclick="confirm_suites_delete();"/></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="8" /></td>
            </tr>
            <tr>
              <td colspan="3"><table width="1122" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                  <td width="746" bgcolor="#CCCCCC"><strong>SALES</strong></td>
                  <td width="100" bgcolor="#CCCCCC"><div align="center"><strong>Page Link</strong></div></td>
                  <td width="85" bgcolor="#CCCCCC"><div align="center"><strong>Rank</strong></div></td>
                  <td width="85" bgcolor="#CCCCCC"><div align="center"><strong>Modify</strong></div></td>
                  <td width="50" bgcolor="#CCCCCC"><div align="center">
                    <input type="checkbox" name="delete_all" id="delete_all" onClick="return select_all();" />
                  </div></td>
                </tr>
				<?php $resultarrays = mysql_query("SELECT * FROM tbl_web_subpage WHERE main_link ='SALES' and delete_status!=1 order by orderstatus"); 
						  $i=1;
						  $count = 1;
						    while($info = @mysql_fetch_array($resultarrays))
								{
					if($i%2==0)
							$bgcolor="#F8F7E0";
						else
							$bgcolor="#CAE1F7";
                 
					?>
                <tr>
                  <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $info['pagename']; ?></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="<?php echo $info['pagelink']; ?>" target="_blank">View</a></div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
                    <input name="textsalesorder[]" type="text" id="textsalesorder" value="<?php echo $info['orderstatus']; ?>" size="3" />
                  </div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="sitetemplate-dropdown.php?id=<?php echo $info['id']; ?>">Modify</a></div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
                    <input type="checkbox" name="chk_delete[]" id="chk_delete" value="<?php echo $info['id']; ?>"/>
                  </div></td>
				   <input type="hidden" name="txtsalesid[]" id="txtsalesid" value="<? echo $info['id']; ?>" size="2" />
                </tr>
				<?php
					$i=$i+1;
					}
					?>
              </table></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="8" /></td>
            </tr>
            <tr bgcolor="#CCCCCC">
              <td colspan="3"><img src="../images/t.gif" width="10" height="1" /></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="8" /></td>
            </tr>
            <tr>
              <td colspan="3"><table width="1122" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                  <td width="746" bgcolor="#CCCCCC"><strong>RENTALS</strong></td>
                  <td width="100" bgcolor="#CCCCCC"><div align="center"><strong>Page Link</strong></div></td>
                  <td width="85" bgcolor="#CCCCCC"><div align="center"><strong>Rank</strong></div></td>
                  <td width="85" bgcolor="#CCCCCC"><div align="center"><strong>Modify</strong></div></td>
                  <td width="50" bgcolor="#CCCCCC"><div align="center">
                    <input type="checkbox" name="checkbox9" id="checkbox9" />
                  </div></td>
                </tr>
				<?php $resultarrays = mysql_query("SELECT * FROM tbl_web_subpage WHERE main_link ='RENTALS' and delete_status!=1 order by orderstatus"); 
						  $i=1;
						    while($info = @mysql_fetch_array($resultarrays))
								{
					if($i%2==0)
							$bgcolor="#F8F7E0";
						else
							$bgcolor="#CAE1F7";
                 
					?>
                <tr>
                  <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $info['pagename']; ?></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="<?php echo $info['pagelink']; ?>" target="_blank">View</a></div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
                    <input name="txtrentalsorder[]" type="text" id="txtrentalsorder" value="<?php echo $info['orderstatus']; ?>" size="3" />
                  </div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="sitetemplate-dropdown.php?id=<?php echo $info['id']; ?>">Modify</a></div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
                    <input type="checkbox" name="chk_delete[]" id="chk_delete" value="<? echo $info['id']; ?>"/>
                  </div></td>
				  <input type="hidden" name="txtrentalsid[]" id="txtrentalsid" value="<? echo $info['id']; ?>" size="2" />
                </tr>
				<?php
					$i=$i+1;
					}
					?>
              </table></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="8" /></td>
            </tr>
            <tr bgcolor="#CCCCCC">
              <td colspan="3"><img src="../images/t.gif" width="10" height="1" /></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="8" /></td>
            </tr>
            <tr>
              <td colspan="3"><table width="1122" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                  <td width="746" bgcolor="#CCCCCC"><strong>MEET THE TEAM</strong></td>
                  <td width="100" bgcolor="#CCCCCC"><div align="center"><strong>Page Link</strong></div></td>
                  <td width="85" bgcolor="#CCCCCC"><div align="center"><strong>Rank</strong></div></td>
                  <td width="85" bgcolor="#CCCCCC"><div align="center"><strong>Modify</strong></div></td>
                  <td width="50" bgcolor="#CCCCCC"><div align="center">
                    <input type="checkbox" name="checkbox10" id="checkbox17" />
                  </div></td>
                </tr>
				<?php $resultarrays = mysql_query("SELECT * FROM tbl_web_subpage WHERE main_link ='MEET THE TEAM' and delete_status!=1 order by orderstatus"); 
						  $i=1;
						    while($info = @mysql_fetch_array($resultarrays))
								{
					if($i%2==0)
							$bgcolor="#F8F7E0";
						else
							$bgcolor="#CAE1F7";
                 
					?>
                <tr>
                  <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $info['pagename']; ?></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="<?php echo $info['pagelink']; ?>" target="_blank">View</a></div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
                    <input name="txtmeetteamorder[]" type="text" id="txtmeetteamorder" value="<?php echo $info['orderstatus']; ?>" size="3" />
                  </div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="sitetemplate-dropdown.php?id=<?php echo $info['id']; ?>">Modify</a></div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
                    <input type="checkbox" name="chk_delete[]" id="chk_delete" value="<? echo $info['id']; ?>"/>
                  </div></td>
				  <input type="hidden" name="txtmeetteamid[]" id="txtmeetteamid" value="<? echo $info['id']; ?>" size="2" />
                </tr>
				<?php
					$i=$i+1;
					}
					?>
              </table></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="8" /></td>
            </tr>
            <tr bgcolor="#CCCCCC">
              <td colspan="3"><img src="../images/t.gif" width="10" height="1" /></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="8" /></td>
            </tr>
            <tr>
              <td colspan="3"><table width="1122" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                  <td width="746" bgcolor="#CCCCCC"><strong>PROPERTY MANAGEMENT</strong></td>
                  <td width="100" bgcolor="#CCCCCC"><div align="center"><strong>Page Link</strong></div></td>
                  <td width="85" bgcolor="#CCCCCC"><div align="center"><strong>Rank</strong></div></td>
                  <td width="85" bgcolor="#CCCCCC"><div align="center"><strong>Modify</strong></div></td>
                  <td width="50" bgcolor="#CCCCCC"><div align="center">
                    <input type="checkbox" name="checkbox11" id="checkbox25" />
                  </div></td>
                </tr>
               <?php $resultarrays = mysql_query("SELECT * FROM tbl_web_subpage WHERE main_link ='PROPERTY MANAGEMENT' and delete_status!=1 order by orderstatus"); 
						  $i=1;
						    while($info = @mysql_fetch_array($resultarrays))
								{
					if($i%2==0)
							$bgcolor="#F8F7E0";
						else
							$bgcolor="#CAE1F7";
                 
					?>
                <tr>
                  <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $info['pagename']; ?></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="<?php echo $info['pagelink']; ?>" target="_blank">View</a></div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
                    <input name="txtmanagementsorder[]" type="text" id="txtmanagementsorder" value="<?php echo $info['orderstatus']; ?>" size="3" />
                  </div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="sitetemplate-dropdown.php?id=<?php echo $info['id']; ?>">Modify</a></div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
                    <input type="checkbox" name="chk_delete[]" id="chk_delete" value="<? echo $info['id']; ?>"/>
                  </div></td>
				  <input type="hidden" name="txtmanagementsid[]" id="txtmanagementsid" value="<? echo $info['id']; ?>" size="2" />
                </tr>
				<?php
					$i=$i+1;
					}
					?>
              </table></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="8" /></td>
            </tr>
            <tr bgcolor="#CCCCCC">
              <td colspan="3"><img src="../images/t.gif" width="10" height="1" /></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="8" /></td>
            </tr>
            <tr>
              <td colspan="3"><table width="1122" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                  <td width="746" bgcolor="#CCCCCC"><strong>CAPE MAY COUNTY</strong></td>
                  <td width="100" bgcolor="#CCCCCC"><div align="center"><strong>Page Link</strong></div></td>
                  <td width="85" bgcolor="#CCCCCC"><div align="center"><strong>Rank</strong></div></td>
                  <td width="85" bgcolor="#CCCCCC"><div align="center"><strong>Modify</strong></div></td>
                  <td width="50" bgcolor="#CCCCCC"><div align="center">
                    <input type="checkbox" name="checkbox12" id="checkbox33" />
                  </div></td>
                </tr>
                <?php $resultarrays = mysql_query("SELECT * FROM tbl_web_subpage WHERE main_link ='CAPE MAY COUNTY' and delete_status!=1 order by orderstatus"); 
						  $i=1;
						    while($info = @mysql_fetch_array($resultarrays))
								{
					if($i%2==0)
							$bgcolor="#F8F7E0";
						else
							$bgcolor="#CAE1F7";
                 
					?>
                <tr>
                  <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $info['pagename']; ?></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="<?php echo $info['pagelink']; ?>" target="_blank">View</a></div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
                    <input name="txtcapmaycountyorder[]" type="text" id="txtcapmaycountyorder" value="<?php echo $info['orderstatus']; ?>" size="3" />
                  </div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="sitetemplate-dropdown.php?id=<?php echo $info['id']; ?>">Modify</a></div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
                    <input type="checkbox" name="chk_delete[]" id="chk_delete" value="<? echo $info['id']; ?>"/>
                  </div></td>
				  <input type="hidden" name="txtcapmaycountyid[]" id="txtcapmaycountyid" value="<? echo $info['id']; ?>" size="2" />
                </tr>
				<?php
					$i=$i+1;
					}
					$count = mysql_num_rows(mysql_query("select * from tbl_web_subpage where delete_status!=1"));
					?>
              </table></td>
            </tr>
          </table></td>
      </tr>
	  <input type="hidden" name="total_count" id="total_count" value="<? echo $count; ?>"/>
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
