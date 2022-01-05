<?php
session_start();

require_once('../config.php');	

require_once('captcha/captcha.php');
	
if(isset($_SESSION['uid'])=="" )
header("Location: ../index.php");


$userid=$_SESSION['uid'];

$ID=$_GET['id'];
	
	
	
if($_POST['testimonial_update']=="Update")		
{  
	if($_POST['captcha']!='')
	{
	
		if(captcha_validate())
		{	
		
		
			$pagename = $_POST['page_name'];
            $filename = $_POST['file_name'];
            $metatitle = $_POST['meta_title'];
			$metakey = $_POST['meta_key'];
			$desc = $_POST['description'];
			
			$contents = $_POST['content'];
			
			
		if($ID != "") {
			
            mysql_query("update tbl_custpages set page_name='".mysql_real_escape_string($pagename)."',file_name='".mysql_real_escape_string($filename)."',meta_title='".mysql_real_escape_string($metatitle)."',meta_key='".mysql_real_escape_string($metakey)."',description='".mysql_real_escape_string($desc)."',content='".mysql_real_escape_string($contents)."' where id='$ID'");
			
		} else {				
				
			mysql_query("insert into tbl_custpages set page_name='".mysql_real_escape_string($pagename)."',file_name='".mysql_real_escape_string($filename)."',meta_title='".mysql_real_escape_string($metatitle)."',meta_key='".mysql_real_escape_string($metakey)."',description='".mysql_real_escape_string($desc)."',content='".mysql_real_escape_string($contents)."'");			
			
		}
			
			if($_GET['id'] == "") {	
			
				$file = '../custom_pages.php';	
				
				$newfile="../".$_POST['file_name'].".php";	
				
				if (!copy($file, $newfile)) {       
					echo "failed to copy $file...\n";
					exit;
				}	
				
				
				$mfile = '../mobile/custom_pages.php';	
				
				$mnewfile="../mobile/".$_POST['file_name'].".php";	
				
				if (!copy($mfile, $mnewfile)) {     
					echo "failed to copy $file...\n";
					exit;      
				}		
			}	
			
            header("Location:updatepages.php");
			
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47104613-18', 'auto');
  ga('send', 'pageview');
  
</script>

<script>

function escapeRegExp(str) {
  return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
}

function replaceAll(find, replace, str) {
  return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

function validate(){
	var pagename = document.getElementById('page_name').value;
	if (pagename == ''){
		alert('Please enter page name');
		return false;
	}
	
	var filename = document.getElementById('file_name').value;
	if (filename == ''){
		filename = pagename;
	}

	pagename = pagename.toLowerCase();
	var replaced = replaceAll(' ','',pagename.trim());
	replaced = replaceAll('.','',replaced.trim());
	replaced = replaceAll(',','',replaced.trim());
	replaced = replaceAll('/','',replaced.trim());
	document.getElementById('file_name').value = replaced; 
}
</script>
<script>

function RemoveSpecialChar(file_name) {
if (file_name.value != '' && file_name.value.match(/^[\w ]+$/) == null) {
file_name.value = file_name.value.replace(/[\W]/g, '');
}
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


function submitmyform(){
		
	 var pagename = document.forms["testimonials"]["page_name"].value;

	if(pagename=='' || pagename == null)
	{
		alert("Page Name Cannot be empty");
		document.testimonials.page_name.focus();
		return false;
	}
		
	var filename=document.getElementById("file_name").value;

	var customid=document.getElementById("custmid").value;

	if(customid==''){
			
	$.ajax({  
		type: "POST",  
		url: "filenamevalidation.php",
		data: "filename="+encodeURIComponent(filename)+"&customid="+encodeURIComponent(customid),
		beforeSend: function() {

		$('html, body').animate({scrollBottom:0}, 'slow');
		$("#response").html('<div class="prev_box"><img src="../images/ajax-loader.gif" align="absmiddle"> Loading...<br clear="all"><br clear="all">');
		
		}, success: function(response)	{	
		
			if(response==0) {
				
				 var x = document.forms["testimonials"]["captcha"].value;	
				 
				if (x == null || x == "") {
					
					alert("Please Enter Your Captcha and Try Again.");
					document.testimonials.captcha.focus();
					return false;
					
				} else { 
				
					document.getElementById('testimonials').submit();
					return true; 
				}
			
			} else {
				document.testimonials.file_name.focus();
				alert("File name already exist");
				return false;
			}
		}
	});	 

	} else {
		
		 var x = document.forms["testimonials"]["captcha"].value;	
		 
		if (x == null || x == "") {
			
			alert("Please Enter Your Captcha and Try Again.");
			document.testimonials.captcha.focus();
			return false;
			
		} else { 
		
			document.getElementById('testimonials').submit();
			return true; 
		}		
	}
}
</script>
</head>

<body>


<form enctype="multipart/form-data" name="testimonials" id="testimonials" method="POST">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?php include_once("header.php");?></td></tr>
  
  <tr>
    <td><table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
        <?php $resultarray1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_user 
	   WHERE id ='".$userid."'")); 
		 
		  ?>
      <tr>
        <td><div align="center"><em>You Are Currently Logged In As: <strong>
		<?php echo $resultarray1['name']; ?></strong> (<a href="../logout.php">Log Out</a>)</em></div></td>
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
            <tr>
              <td width="280"><strong>Page Name:</strong></td>
              <td colspan="3"><strong>File Name: </strong>
			  
			  <span class="gray size12">(Must Use All Small Cases, No Special Characters &amp; No Spaces)</span></td>
            </tr>
			<?php
			$results=mysql_fetch_array(mysql_query("SELECT * FROM tbl_custpages where id='$ID' "));
			?>
			<tr>
			<?php
					if($_POST['page_name']=="")
						$txt_results_value=$results['page_name'];
					else
						$txt_results_value=$_POST['page_name'];
					?>
              <td colspan="4"><img src="../images/t.gif" width="10" height="4" /></td>
            </tr>
            <tr>
              <td>			  				  

			  <?php if($_GET['id']==""){ ?>

			  <input name="page_name" Onkeyup="return validate();" Onchange="return validate();" type="text" id="page_name" style="width: 85%" value="<?php echo $txt_results_value?>" />			

			  <?php } else  { ?>				  

			  <input name="page_name" type="text" id="page_name" style="width: 85%" value="<?php echo $txt_results_value?>" />
			  
			  <?php } ?>		

			  </td>
				  
                  <td width="281">				  	

				  <?php if($_GET['id']==""){	
				  ?>		

				  <input name="file_name" type="text" id="file_name" style="width: 85%" value="<?php echo $results['file_name'] ?>" onkeyup="javascript:RemoveSpecialChar(this)" />  	

				  <?php } else	{?>				  		

				  <input name="file_name" type="text" readonly="true" id="file_name" style="width: 85%" value="<?php echo $results['file_name'] ?>" onkeyup="javascript:RemoveSpecialChar(this)"  />		

				  <?php } ?>								

				  <input name="custmid" type="hidden" id="custmid" value="<?php echo $_GET['id'];?>"/> 
				  
				  </td>
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
              <td>&nbsp;</td>
            </tr>
			<?
					if($_POST['meta_title']=="")
						$txt_meta_title_value=$results['meta_title'];
					else
						$txt_meta_title_value=$_POST['meta_title'];
			?>
            <tr>
              <td colspan="4"><img src="../images/t.gif" width="10" height="4" /></td>
            </tr>
            <tr>
              <td><input name="meta_title" type="text" id="meta_title" style="width: 85%"  value="<?php echo $txt_meta_title_value ?>"/></td>
			  <?
					if($_POST['meta_key']=="")
						$txt_meta_key_value=$results['meta_key'];
					else
						$txt_meta_key_value=$_POST['meta_key'];
					?>
              <td><input name="meta_key" type="text" id="meta_key" style="width: 85%"
			  value="<?php echo $txt_meta_key_value ?>"  /></td>
			   <?
					if($_POST['description']=="")
						$txt_description_value=$results['description'];
					else
						$txt_description_value=$_POST['description'];
					?>
              <td><input name="description" type="text" id="description" style="width: 85%"  value="<?php echo $txt_description_value ?>"/></td>
              <td>&nbsp;</td>
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
			<?
					if($_POST['content']=="")
						$txt_content_value=$results['content'];
					else
						$txt_content_value=$_POST['content'];
					?>
            <tr>
              <td colspan="4"><textarea name="content" rows="15" id="content" style="width: 98%"><?php echo $txt_content_value ?></textarea></td>
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
			<td>
		  
		  <input type="hidden" name="testimonial_update" id="testimonial_update" value="Update" />
		  
		  <input type="button" name="tmnialupdate" onclick="return submitmyform();" id="tmnialupdate" value="Update" />
		  
		   <input type="button" name="button2" id="button2" value="Cancel" onclick="window.location.href='updatepages.php'"/>
		   
		   </td>
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
