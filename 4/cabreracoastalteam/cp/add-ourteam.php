<?php
	session_start();
	require_once('../config.php');	
	require_once('captcha/captcha.php');
	require_once('simpleimage.php');
	 if(isset($_SESSION['uid'])=="" )
	  header("Location: ../index.php");
	$userid=$_SESSION['uid'];
	
	if($_POST['add_persons']=="Update")		
	{
		if($_POST['captcha']!='')
		{ 
			if(captcha_validate())
			{
				
					$target = "../team_person/"; 
					
					$target = $target . basename( $_FILES['fileField']['name']); 
					$name=$_POST['Name']; 
					$personname=$_POST['person_name']; 
					$title=$_POST['person_title']; 
					$email=$_POST['person_email']; 
					$phone=$_POST['person_phone']; 					$descriptions = mysql_real_escape_string($_POST['description']);
					$original_name=basename( $_FILES['fileField']['name']);
					$date=date("y.m.d");
					$ordercount = mysql_fetch_array(mysql_query("select max(order_value) as navflag from  tbl_team_person where del_status=0"));
					$ordervalue = $ordercount['navflag']+1;
					$qry="INSERT INTO `tbl_team_person`(upload_picture,image_filename,name,title,email,phone,description,order_status) VALUES ('$name', '$original_name','$personname','$title','$email','$phone','$descriptions',$ordervalue)";
					
					 
					mysql_query($qry);
					
					header("Location: updatepages-ourteam.php");
					
					$image = new SimpleImage();	
					$image->load($_FILES['fileField']['tmp_name']);
					$image->resize(156,191);
					$image->save($target);
				
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
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form enctype="multipart/form-data" name="team_person" id="team_person" method="POST">
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
        <td><h2>UPDATE PAGES &gt; MEET OUR TEAM &gt; ADD / MODIFY</h2>
          <table width="1122" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="280"><strong>Name:</strong></td>
              <td><strong>Title: </strong><span class="style2"></span></td>
              <td><strong>Email: </strong><span class="style2"></span></td>
			    <td><strong>Phone: </strong><span class="style2"></span></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4"><img src="../images/t.gif" width="10" height="4" /></td>
            </tr>
            <tr>
              <td><input name="person_name" type="text" id="person_name" style="width: 85%" /></td>
              <td width="281"><input name="person_title" type="text" id="person_title" style="width: 85%" /></td>
              <td width="281"><input name="person_email" type="text" 
			  id="person_email" style="width: 85%" /></td>
			   <td width="281"><input name="person_phone" type="text" 
			  id="person_phone" style="width: 85%" /></td>
			  
			  

              <td width="280">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="5"><strong>Upload Picture</strong> <span class="gray size12">(Recommended Size: 156 w by 191 h)</span></td>
            </tr>
            <tr>
              <td colspan="5"><img src="../images/t.gif" width="10" height="4" /></td>
            </tr>
            <tr>
              <td colspan="5"><input type="file" accept=".png,.jpg,.jpeg" onchange="ValidateSingleInput(this);" name="fileField" id="fileField" /></td>
            </tr>
            <tr>
              <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="5"><strong>Profile / Description:</strong></td>
            </tr>
            <tr>
              <td colspan="5"><img src="../images/t.gif" width="10" height="4" /></td>
            </tr>
            <tr>
              <td colspan="5"><textarea name="description" rows="15" 
			  id="description" style="width: 98%"></textarea></td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
             <tr>
				   <td>
					<table width="270" border="0" cellspacing="2" cellpadding="1">
						<tr>
							<td width="231" align="left"><strong>Image Verification </strong><span class="graytext">(Type Below)</span></td>
						</tr>
						<tr>
							<td align="left"><?php print'<img id="mainimage2" src="captcha_demo.php?image" width="160" height="36" alt="CAPTCHA image">'; ?></td>
						</tr>
						<tr>
							<td align="left"><span><?php print'<a href="captcha_demo.php?audio">Listen</a> &nbsp;<span class="style16"> |</span> &nbsp; <a href="#" onclick="document.getElementById(\'mainimage2\').src=\'../captcha_demo.php?image=\' + new Date; return false;">New Letters</a>'; ?></span></td>
						</tr>
						<tr>
							<td align="left"><input type="text" name="captcha" id="captcha" /></td>
						</tr>
					</table>
				   </td>
                </tr>   <tr>
                  <td><input type="submit" name="add_persons" id="add_persons" value="Update" />
                    <input type="submit" name="button4" id="button5" value="Cancel" /></td>
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
</body><?php require_once('googletagmanager.php'); ?>
</html>
