<?php
	session_start();
	require_once('../config.php');
	require_once('captcha/captcha.php');	
	 if(isset($_SESSION['uid'])=="" )
	  header("Location: ../index.php");
	$userid=$_SESSION['uid'];
	
	if($_POST['btn_person']=="Update")		
	{
			if($_POST['captcha']!='')
		{
			if(captcha_validate())
			{
		
				$content = mysql_real_escape_string($_POST['content']);
			
				if (mysql_num_rows(mysql_query("select * from   tbl_personpage"))<=0)
				{
					
					mysql_query("insert   tbl_personpage set content='".$content."'");
					
				}
				else
				{
					mysql_query("update    tbl_personpage set content='".$content."'");
				}            
				header("Location: updatepages.php");
			
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
			$sql = "UPDATE tbl_team_person SET order_status=".$featureorderids[$x]." WHERE id=".$featureids[$x];
			mysql_query($sql);
		}
		header("Location: updatepages-ourteam.php");
	}

	
			$opt_row=mysql_fetch_array(mysql_query("select * from   tbl_personpage"));
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
  function add_person()
	{
		window.location.href="add-ourteam.php";
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
function select_allperson()
	{
        var selall = document.getElementById('selectallimage').checked;
        var chkbox;
        var form_name = document.getElementById('cabrea_team');
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
	
	function confirm_person_delete()
	{
		var form_name = document.getElementById('cabrea_team');
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
				PopupWindow=window.open("global_deletepage.php?pageflag=team_person&deleteids="+hidalldeleteid,"CustomPopUp",settings);   
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
<form enctype="multipart/form-data" name="cabrea_team" id="cabrea_team" method="POST">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
        <td><h2>UPDATE PAGES &gt; MEET THE TEAM</h2>
          <p>
             <input type="button" name="button2" id="button2" value="Add New Person"  onclick="add_person();" />
            <input type="submit" name="btnupd" id="btnupd" value="Update Rank Order" />
              <input type="button" name="button" id="button" value="Delete Selected" onclick="confirm_person_delete();" /> 
          </p>
          <table width="1122" border="0" cellpadding="8" cellspacing="1" bgcolor="#FFFFFF">
            <tr>
              <td width="728" bgcolor="#CCCCCC"><strong>USER</strong></td>
              <td width="125" bgcolor="#CCCCCC"><div align="center"><strong>Order</strong></div></td>
              <td width="125" bgcolor="#CCCCCC"><div align="center"><strong>MODIFY</strong></div></td>
              <td width="75" bgcolor="#CCCCCC"><div align="center">
                      <input type="checkbox" name="selectallimage" id="selectallimage"  onClick="return select_allperson();"/>
                  </div></td>
            </tr>
			<?php $data = mysql_query("select * from tbl_team_person where delete_status=0 order by order_status");
				$i=1;
				while($info = @mysql_fetch_array( $data )) 
					{ 
						if($i%2==0)
							$bgcolor="#CAE1F7"; 
						else
							$bgcolor="#F8F7E0";
				?>
            <tr>
                  <td bgcolor="<?php echo $bgcolor; ?>"><?php echo $info['name']; ?></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
                    <input name="textorder[]" type="text" id="textorder" value="<?php echo $info['order_status'];?>" size="3" />
                  </div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center"><a href="updatepages-ourteam-modify.php?id=<?php echo $info['id']?>">Modify</a></div></td>
                  <td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
                      <div align="center">
                        <input type="checkbox" name="chk_delete[]" id="chk_delete" value="<?php echo $info['id']; ?>" />
                      </div>
                  </div></td>
				  <input type="hidden" name="txtid[]" id="txtid" value="<? echo $info['id']; ?>" size="2" />
                </tr>
                <?php
					$i=$i+1;
					}
					 ?>
					 <input type="hidden" name="total_count" id="total_count" value="<? echo $i-1; ?>">            </tr>
          </table>
          <br />
          <table width="1122" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="1122"><strong>Main Page Content:</strong></td>
            </tr>
            <tr>
              <td><img src="../images/t.gif" width="10" height="4" /></td>
            </tr>
            <tr>
              <td><textarea name="content" rows="15" id="content" style="width: 98%"><?php echo stripslashes($opt_row['content']);?></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
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
                  <td><img src="../images/t.gif" width="10" height="8" /></td>
                </tr>
                <tr>
                  <td><input type="submit" name="btn_person" id="btn_person" value="Update" />
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
