<?php
session_start();

require_once('../config.php');	

require_once('captcha/captcha.php');

if(isset($_SESSION['uid'])=="" )
header("Location: ../index.php");
$userid=$_SESSION['uid'];
	
		
if($_POST['Update_home']=="Update")		
{
	if($_POST['captcha']!='')
	{
	
		if(captcha_validate())
		{
		
			//print_r ($_POST);	
			$pagename = $_POST['page_name'];
            
            $metatitle = $_POST['meta_title'];
			$metakey = $_POST['meta_key'];
			$desc = $_POST['description'];
			$heading = $_POST['heading'];
			$heading1 = $_POST['heading1'];
			$contents = $_POST['content'];
			$noevents = $_POST['noevents'];
			
	if (mysql_num_rows(mysql_query("select * from tbl_homepage"))<=0) {
					
		mysql_query("insert tbl_homepage set page_name='".mysql_real_escape_string($pagename)."',meta_title='".mysql_real_escape_string($metatitle)."',meta_key='".mysql_real_escape_string($metakey)."',meta_desc='".mysql_real_escape_string($desc)."',heading='".mysql_real_escape_string($heading)."',heading1='".mysql_real_escape_string($heading1)."', content='".mysql_real_escape_string($contents)."', noevents='".$noevents."' where id = 1");
					
	} else {
					
					
		$updatesql = "update tbl_homepage set page_name='".mysql_real_escape_string($pagename)."',meta_title='".mysql_real_escape_string($metatitle)."',meta_key='".mysql_real_escape_string($metakey)."',meta_desc='".mysql_real_escape_string($desc)."',heading='".mysql_real_escape_string($heading)."',heading1='".mysql_real_escape_string($heading1)."', content='".mysql_real_escape_string($contents)."', noevents='".$noevents."' where id = 1";
				
		mysql_query($updatesql);	
	}
				
	header("Location: updatepages.php");
			
	} else {
		
		echo "<script>alert('You were not successful in typing in the correct image verification, please try again.')</script>";
		$msg='<p style="color:red">Failure! You entered the wrong code!</p>';
	
	}  
	
	} else {
		
		echo "<script>alert('You were not successful in typing in the correct image verification, please try again.')</script>";
		$msg='<p style="color:red">Failure! Please Enter the code</p>';
	}
	
}

$opt_row=mysql_fetch_array(mysql_query("select * from  tbl_homepage"));

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
 <form enctype="multipart/form-data" name="home_page" id="home_page" method="POST">
 
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
        <td><h2>UPDATE PAGES &gt; HOME</h2>
          <table width="1122" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="280"><strong>Page Name:</strong></td>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4"><img src="../images/t.gif" width="10" height="4" /></td>
            </tr>
            <tr>
              <td><input name="page_name" type="text" id="page_name" style="width: 85%" value="<?php echo $opt_row['page_name'];?>" /></td>
              <td width="281">&nbsp;</td>
              <td width="281">&nbsp;</td>
              <td width="280">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
			
            <tr>
              <td><strong>Meta Title:</strong></td>
              <td><strong>Meta Keywords:</strong></td>
              <td><strong>Meta Description:</strong></td>
              <td><strong>Number OF Events:</strong></td>
            </tr>
			
            <tr>
              <td colspan="4"><img src="../images/t.gif" width="10" height="4" /></td>
            </tr>
           
		   <tr>
             
			 <td><input name="meta_title" type="text" id="meta_title" style="width: 85%" value="<?php echo $opt_row['meta_title'];?>" /></td>
             
			 <td><input name="meta_key" type="text" id="meta_key" style="width: 85%" 
			  value="<?php echo $opt_row['meta_key'];?>" /></td>
             
			 <td><input name="description" type="text" id="description" style="width: 85%" value="<?php echo $opt_row['meta_desc'];?>" /></td>
			
			<td>
			
			<select id="noevents" name="noevents" style="padding-left:12px;padding-right:12px;">
			
			<?php 
			for($i=1;$i<=50;$i++){
				
				echo "<option value='".$i."'>".$i."</option>";
			}
			?>		
			
			</select>
			
<script>document.getElementById('noevents').value="<?php echo $opt_row['noevents'];?>";</script>

			</td>
          
            </tr>
           
		   <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
			
            <tr>
              <td colspan="2"><strong>Heading #1 (H1)</strong></td>
              <td colspan="2"><strong>Heading #2 (H3)</strong></td>
              </tr>
            <tr>
              <td colspan="4"><img src="../images/t.gif" width="10" height="4" /></td>
            </tr>
            <tr>
              <td colspan="2"><input name="heading" type="text" id="heading" style="width: 92%"  value="<?php echo $opt_row['heading'];?>" /></td>
              <td colspan="2"><input name="heading1" type="text" id="heading1" style="width: 92%"  value="<?php echo $opt_row['heading1'];?>" /></td>
              </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4"><strong>Page Content:</strong></td>
            </tr>
            <tr>
              <td colspan="4"><img src="../images/t.gif" width="10" height="4" /></td>
            </tr>
            <tr>
              <td colspan="4"><textarea name="content" rows="15" id="content" style="width: 98%"> <?php echo $opt_row['content'];?></textarea></td>
                               
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
							<td align="left"><?php print'<img id="mainimage" src="captcha_demo.php?image" width="160" height="36" alt="CAPTCHA image">'; ?></td>
						</tr>
						<tr>
							<td align="left"><span><?php print'<a href="captcha_demo.php?audio">Listen</a> &nbsp;<span class="style16"> |</span> &nbsp; <a href="#" onclick="document.getElementById(\'mainimage\').src=\'../captcha_demo.php?image=\' + new Date; return false;">New Letters</a>'; ?></span></td>
						</tr>
						<tr>
							<td align="left"><input type="text" name="captcha" id="captcha" /></td>
						</tr>
					</table>
				   </td>
				    
                </tr>
				<tr>
                  <td><input type="submit" name="Update_home" id="Update_home" value="Update" />
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
</body><?php require_once('googletagmanager.php'); ?>
</html>
