<?php
	session_start();
	require_once('../config.php');	
	
	require_once('captcha/captcha.php');
	require_once('simpleimage.php');
	 if(isset($_SESSION['uid'])=="" )
	  header("Location: ../index.php");
	$userid=$_SESSION['uid'];
	 
		$ID=$_GET['id'];
						
	
	
	if($_POST['btnadd']=="Upload File")		
	{
		if($_POST['captcha']!='')
		{ 
			if(captcha_validate())
			{
				if($_GET['id'] !="")
				{
					$up_id=$_GET['id'];
					$target = "../homepageimages/"; 
					$target = $target . basename( $_FILES['fileField']['name']); 
					$name=$_POST['Name']; 
					$original_name=basename( $_FILES['fileField']['name']);
		 
					if($name=="")
					{
						echo "inside name is  ".$name;
						?><script>alert("Please enter file name.");</script><?php
				
					}
					if($original_name=="")
					{
						if($_POST['hidefile']!='' || $_POST['hidefile']!=0)
						{
							$filename = $_POST['hidefile'];
						}
						else
						{
							$filename = "";
							?><script>alert("Please select a file to upload.");</script><?php
						}
					}else
					{
						$filename = $original_name;
						$image = new SimpleImage();
						$image->load($_FILES['fileField']['tmp_name']);
						$image->resize(1121,260);
						$image->save($target);
					}
					$date=date("d.m.y");
					$qry="UPDATE tbl_homepageupload_images SET imagename='$name', image_filename='$filename' where id='$up_id'";
					mysql_query($qry);
					header("Location: sitetemplate-home.php");
				} 
				if($_GET['id'] =="")
				{
					$target = "../homepageimages/"; 
					
					$target = $target . basename( $_FILES['fileField']['name']); 
					$name=$_POST['Name']; 
					$original_name=basename( $_FILES['fileField']['name']);
					$date=date("y.m.d");
					$ordercount = mysql_fetch_array(mysql_query("select max(order_value) as navflag from tbl_homepageupload_images where del_status=0"));
					$ordervalue = $ordercount['navflag']+1;
					$qry="INSERT INTO `tbl_homepageupload_images` (imagename,image_filename,order_value,created_by,del_status) VALUES ('$name', '$original_name', $ordervalue,'$username',0)";
					 
					mysql_query($qry);
					
					$image = new SimpleImage();	
					$image->load($_FILES['fileField']['tmp_name']);
					$image->resize(1121,260);
					$image->save($target);
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
		
	if($_POST['btnupd']=="Update Rank Order")
	{
		$featureids = $_POST['txtid'];
		$featureorderids = $_POST['textorder'];
		
		for($x=0; $x<count($featureids); $x++)
		{
			$sql = "UPDATE tbl_homepageupload_images SET order_value=".$featureorderids[$x]." WHERE id=".$featureids[$x];
			mysql_query($sql);
		}
		header("Location: sitetemplate-home.php");
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
	function validate(){
		var name = uploadfiles.Name.value;
		if (name==''){
			alert('File Name should not be blank');
			return false;
		}
	}
	
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
	
	function confirm_image_delete()
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
				PopupWindow=window.open("global_deletepage.php?pageflag=uploadhomeimage&deleteids="+hidalldeleteid,"CustomPopUp",settings);   
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
var _validFileExtensions = [".jpg", ".jpeg", ".png"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
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
        <td><h2>SITE TEMPLATE &gt; HOME PAGE SLIDE SHOW</h2>
          <table width="1122" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="320"><strong>Picture Name:</strong></td>
              <td width="18">&nbsp;</td>
              <td width="784"><strong>Select A Picture To Upload:</strong><span class="gray size13"> (1121 px width by 260 px height)</span></td>
            </tr>
            <?php 
            	$info = mysql_fetch_array(mysql_query("SELECT * FROM tbl_homepageupload_images where id='$ID'")); 
            ?>
            <input type="hidden" name="hidefile" id="hidefile" value="<? echo $info['image_filename']; ?>" size="2" />
            <tr>
              <td colspan="3"><img src="../images/t.gif" width="10" height="4" /></td>
            </tr>
            <tr>
            <?
				if($_POST['Name']=="")
				{
					$txt_Name_value=$info['imagename'];
					
				}
				else
				{
					if($ID == ""){
						$txt_Name_value="";	
					}else{
						$txt_Name_value=$_POST['Name'];
					}
				}
			?>
              <td><input name="Name" id="Name" type="text" value="<?php echo $txt_Name_value;?>" style="width: 95%" /></td>
              <td>&nbsp;</td>
              <td><input type="file" name="fileField" accept=".pdf,.docx,.txt,.xls,.xlsx,.doc" onchange="ValidateSingleInput(this);" id="fileField" /><?php echo $info['image_filename']; ?></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3"><table width="246" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><strong>Image Verification</strong> (Type Below)</td>
                </tr>
                <tr>
                  <td><img src="../images/t.gif" width="10" height="4" /></td>
                </tr>
                <tr>
                  <td><table width="150" border="0" cellpadding="10" cellspacing="0" bgcolor="#CCCCCC">
                    <tr>
                      <td><div align="center"><?php print'<img id="mainimage2" src="captcha_demo.php?image" width="160" height="36" alt="CAPTCHA image">'; ?></div></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><img src="../images/t.gif" width="10" height="4" /></td>
                </tr>
                <tr>
                  <td><span><?php print'<a href="captcha_demo.php?audio">Listen</a> &nbsp;<span class="style16"> |</span> &nbsp; <a href="#" onclick="document.getElementById(\'mainimage2\').src=\'../captcha_demo.php?image=\' + new Date; return false;">New Letters</a>'; ?></span></td>
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
                  <td><input type="submit" name="btnadd" id="btnadd" onclick="return validate();" value="Upload File" />
				 <input type="button" name="button2" id="button2" onclick="window.location.href='sitetemplate.php'" value="Cancel" /></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
			<td>
			 <input type="submit" name="btnupd" id="btnupd" value="Update Rank Order" />
			  <input type="button" name="button2" id="button2" value="Delete Selected" onclick="confirm_image_delete();" />
			  
			 </td>
			 <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3"><table width="1122" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                  <td width="761" bordercolor="#E7E7E7" bgcolor="#CCCCCC"><strong>Picture Name</strong></td>
                  <td width="85" bordercolor="#E7E7E7" bgcolor="#CCCCCC"><div align="center"><strong>Image</strong></div></td>
                  <td width="85" bordercolor="#E7E7E7" bgcolor="#CCCCCC"><div align="center"><strong>Rank</strong></div></td>
                  <td width="85" bordercolor="#E7E7E7" bgcolor="#CCCCCC"><div align="center"><strong>Modifyss</strong></div></td>
                  <td width="50" bordercolor="#E7E7E7" bgcolor="#CCCCCC"><div align="center">
                    <input type="checkbox" name="selectallimage" id="selectallimage" onClick="return select_allimages();" />
                  </div></td>
                </tr>
                <?php
					$data = mysql_query("SELECT * FROM tbl_homepageupload_images where del_status=0 order by order_value");
					$i=1;
					
					while($info = @mysql_fetch_array( $data )) 
					{ 
						if($i%2==0)
							$bgcolor="#CAE1F7"; 
						else
							$bgcolor="#F8F7E0";
                		
				?>
			                
                <tr bgcolor="<?php echo $bgcolor; ?>">
                  <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $info['imagename']; ?></td>
                  <td><div align="center"><a href="../homepageimages/<?php echo $info['image_filename']; ?>" target="blank" >View </a></div></td>
                  <td><div align="center">
                    <input name="textorder[]" type="text" id="textorder" value="<?php echo $info['order_value'];?>" size="3" />
                  </div></td>
                  <td><div align="center"><a href="sitetemplate-home.php?id=<?php echo $info['id']; ?>">Modify</a></div></td>
                  <td><div align="center">
                    <input type="checkbox" name="chk_delete[]" id="chk_delete" value="<?php echo $info['id']; ?>" />
                  </div></td>
                  <input type="hidden" name="txtid[]" id="txtid" value="<? echo $info['id']; ?>" size="2" />
                </tr>
                <?php
						$i=$i+1;
					} ?>
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
