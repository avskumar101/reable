<?php
	session_start();
	require_once('../config.php');
	require_once('captcha/captcha.php');
	if(isset($_SESSION['uid'])=="" )
	  header("Location: ../index.php");
	$userid=$_SESSION['uid'];
	if($_POST['upload']=="Upload File")
	{
    if($_POST['captcha']!=''){
    if(captcha_validate()){
	$target = "../uploaded_files/";
			$target = $target . basename( $_FILES['fileField']['name']);
			$name=$_POST['filename'];
			$original_name=basename( $_FILES['fileField']['name']);
            $date=date("y.m.d");
			$qry="INSERT INTO `tbl_upload` (file_name,original_file_name,date,del_status) VALUES ('$name', '$original_name','$date','0')";
			
			mysql_query($qry);
			if(move_uploaded_file($_FILES['fileField']['tmp_name'], $target))
			{
			?><script>alert("The file has been uploaded, and your information has been added to the directory");</script><?php
			}
			else
			{
			?><script>alert("Sorry, there was a problem uploading your file.");</script><?php
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
  
	function select_allimages()
	{
        var selall = document.getElementById('selectallimage').checked;
        var chkbox;
        var form_name = document.getElementById('uploadfiles');
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
		var form_name = document.getElementById('uploadfiles');
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
				PopupWindow=window.open("global_deletepage.php?pageflag=upload&deleteids="+hidalldeleteid,"CustomPopUp",settings);   
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
<form enctype="multipart/form-data" name="uploadfiles" id="uploadfiles" method="POST">
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
        <td><div align="center"><em>You Are Currently Logged In As: <strong><?php echo $resultarray['name']; ?></strong> (<a href="../logout.php">Log Out</a>)</em></div></td>
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
        <td><h2>UPLOAD FILES</h2>
          <table width="1122" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="285"><strong>File Name:</strong></td>
              <td width="22">&nbsp;</td>
              <td width="815"><strong>Upload A FIle:</strong></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="20" height="3" /></td>
            </tr>
            <tr>
              <td><input name="filename" type="text" id="filename" style="width: 85%" /></td>
              <td>&nbsp;</td>
              <td><input type="file" name="fileField" id="fileField" /></td>
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
                      <td><div align="center" class="style8"><strong><?php print'<img id="mainimage" src="captcha_demo.php?image" width="160" height="36" alt="CAPTCHA image">'; ?></strong></div></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><img src="../images/t.gif" width="10" height="4" /></td>
                </tr>
                <tr>
                  <td class="style23"><span><?php print'<a href="captcha_demo.php?audio">Listen</a> &nbsp;<span class="style16"> |</span> &nbsp; <a href="#" onclick="document.getElementById(\'mainimage\').src=\'../captcha_demo.php?image=\' + new Date; return false;">New Letters</a>'; ?></span></td>
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
                  <td><input type="submit" name="upload" id="upload" value="Upload File" />
                    <input type="button" name="button2" id="button2" onclick="window.location.href='uploadfiles.php';" value="Cancel" /></td>
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
              <td colspan="3"><img src="../images/t.gif" width="10" height="8" /></td>
            </tr>
            <tr>
              <td colspan="3"><div align="right">
                <input type="submit" name="button3" id="button3" value="Delete Selected" onclick="confirm_user_delete();" />
              </div></td>
            </tr>
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="8" /></td>
            </tr>
            <tr>
              <td colspan="3"><table width="1122" border="0" cellpadding="8" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                  <td width="656" bgcolor="#CCCCCC"><strong>File Name</strong></td>
                  <td width="120" bgcolor="#CCCCCC"><div align="center"><strong>UPLOAD DATE</strong></div></td>
                  <td width="110" bgcolor="#CCCCCC"><div align="center"><strong>DOWNLOAD</strong></div></td>
                  <td width="100" bgcolor="#CCCCCC"><div align="center"><strong>FILE PATH</strong></div></td>
                  <td width="50" bgcolor="#CCCCCC"><div align="center">
                    <input type="checkbox" name="selectallimage" id="selectallimage" onClick="return select_allimages();" />
                  </div></td>
                </tr>
                <?php 
                	$data = mysql_query("SELECT * FROM tbl_upload where del_status = '0' ORDER BY id desc");
					$i=1;
					while($info = mysql_fetch_array( $data ))
					{
						if($i%2==0)
							$bgcolor="#F8F7E0";
						else
							$bgcolor="#CAE1F7";
				?>
                
	                <tr bgcolor="<?php echo $bgcolor; ?>">
	                  <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $info['file_name'];?></td>
	                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><?php echo $info['date'];?></div></td>
	                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="../uploaded_files/<?php echo $info['original_file_name']; ?>" target="blank" >Download</a></div></td>
	                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="path.php?id=<?php echo $info['id']; ?>" value="" name="pop" id="pop" onclick="javascript:void window.open('path.php?id=<?php echo $info['id']; ?>','','width=400,height=50,toolbar=0,menubar=0,location=0,status=0,scrollbars=0,resizable=no,left=300,top=300');return false;" >View</a></div></td>
	                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
	                    <input type="checkbox" name="chk_delete[]" id="chk_delete" value="<?php echo $info['id']; ?>" />
	                  </div></td>
	                </tr>
				<?php
						$i=$i+1;
					}
				?> 	
				<input type="hidden" name="total_count" id="total_count" value="<? echo $i-1; ?>">
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
</table>
</body><?php require_once('googletagmanager.php'); ?>
</html>
