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

	require_once("query.php");

	

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

</script>

<script type="text/javascript">

function confirm_field_delete()

	{

		var form_name = document.getElementById('store_data');

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

				PopupWindow=window.open("global_deletepage.php?pageflag=storeddata&deleteids="+hidalldeleteid,"CustomPopUp",settings);   

				PopupWindow.focus();

				return true;

			} 

			else 

			{

				return false;

			}

	    }

	}

	

function select_allfields()

	{

        var selall = document.getElementById('selectallfields').checked;

        var chkbox;

        var form_name = document.getElementById('store_data');

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

function generateexcel()

{

	document.store_data.action="exportexcel.php";

	return true;

}

function listall()

{

	document.store_data.submit();

	return true;

}

</script>

</head>



<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<form enctype="multipart/form-data" name="store_data" id="store_data" method="POST">

<tr>

    <td><?php include_once("header.php");?></td></tr>

  

  <tr>

    <td><table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">

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

            <td><div align="center" class="white"><a href="index.php" class="whitelink">USER ACCOUNTS</a> &nbsp; | &nbsp; <a href="soldproperties.php" class="whitelink">SOLD PROPERTIES</a> &nbsp; | &nbsp; <a href="updatepages.php" class="whitelink">UPDATE PAGES</a> &nbsp; | &nbsp; <a href="uploadfiles.php" class="whitelink">UPLOAD FILES</a> &nbsp; | &nbsp; <a href="sitetemplate.php" class="whitelink">SITE TEMPLATE</a>  &nbsp; | &nbsp; <a href="storeddata.php" class="whitelink">STORED DATA</a></div></td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td><img src="../images/t.gif" width="10" height="12" /></td>

      </tr>

      <tr>

        <td><h2>STORED DATA</h2>

          <table width="1122" border="0" align="center" cellpadding="0" cellspacing="0">

            <tr>

              <td width="570" align="left"> 

              	<select name="select_feature" id="select_feature">

                <option selected="selected">All Features</option>

                <option value="02" <?php echo $selectfeature2; ?>>SALES > MLS SEARCH</option>

                <option value="03" <?php echo $selectfeature3; ?>>SALES > MAP SEARCH</option>

                <option value="04" <?php echo $selectfeature4; ?>>SEND PROPERTY TO A FRIEND</option>

                <option value="05" <?php echo $selectfeature5; ?>>LIST RENTAL</option>

                <option value="06" <?php echo $selectfeature6; ?>>LIST SALES</option>

                <option value="07" <?php echo $selectfeature7; ?>>FIND RENTAL</option>        

				<option value="08" <?php echo $selectfeature8; ?>>LOCATE</option>
				
				<option value="09" <?php echo $selectfeature9; ?>>RENTAL REQUEST</option>
				
				<option value="10" <?php echo $selectfeature10; ?>>LET US HELP</option>
				
				<option value="11" <?php echo $selectfeature11; ?>>CITY PAGE FORMS</option>
				
				</select>

                <input type="submit" name="sort_data" id="sort_data" value="Sort Data" /></td>

              <td width="552" align="right"><input type="submit" onclick="return listall()" name="list_all" id="list_all" value="List All" />

               <input type="button" name="button2" id="button2" value="Delete Selected" onclick="confirm_field_delete();"/>

             <input name="button2" type="submit" id="button2" onclick="return generateexcel();" value="Export Data To Excel" />

             </td>

            </tr>

            <tr>

              <td colspan="2"><img src="../images/t.gif" width="10" height="5" /></td>

            </tr>

            <tr>

              <td colspan="2"><table width="1122" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">

                <tr>

                  <td width="235" bgcolor="#CCCCCC"><strong>Name</strong></td>

                  <td width="325" bgcolor="#CCCCCC"><strong>Email Address</strong></td>

                  <td width="270" bgcolor="#CCCCCC"><strong>Feature</strong></td>

                  <td width="125" bgcolor="#CCCCCC"><div align="center"><strong>Submited Date</strong></div></td>

                  <td width="60" bgcolor="#CCCCCC"><div align="center"><strong>Data</strong></div></td>

                  <td width="40" bgcolor="#CCCCCC"><div align="center">

                   <input type="checkbox" name="selectallfields" id="selectallfields" onClick="return select_allfields();" />

				  <?php	

				

					 $i=1;

					while ($boatrow=mysql_fetch_array($result))

					{				 			   

					if($i%2==0)

						$bgcolor="#CAE1F7";

					else

						$bgcolor="#F8F7E0"; ?> <tr bgcolor="<?php echo $bgcolor; ?>">

                    

		<td bgcolor="<?php echo $bgcolor; ?>"><span class="style23"> <?php echo $boatrow['name'];?></span></td>

        	

	<td bgcolor="<?php echo $bgcolor; ?>"><span class="style23"> <?php echo $boatrow['emailid'];?></span></td>

    	

		<td bgcolor="<?php echo $bgcolor; ?>"><span class="style23"> <?php echo $boatrow['pagename'];?></span></td>

        	

	<td bgcolor="<?php echo $bgcolor; ?>"><div align="center"> <?php echo $boatrow['createon'];?></div></td>	

    

		<td bgcolor="<?php echo $bgcolor; ?>"><div align="center"> <a href="data.php?id=<?php echo $boatrow['id'];?>" target="_blank">View</a></div></td>

        

	<td bgcolor="<?php echo $bgcolor; ?>"><div align="center">

    

<input type="checkbox" name="chk_delete[]" id="chk_delete" value="<?php echo $boatrow['id']; ?>" />

                </div></td> </tr>

<input type="hidden" name="txtid[]" id="txtid" value="<? echo $boatrow['id']; ?>" size="2" />



			  <input type="hidden" name="total_count" id="total_count" value="<? echo $i-1; ?>">

			 

			 <?php $i=$i+1; } ?> 

               

              </table></td>  </tr>   <tr>

                </tr>

                          <tr>

              <td colspan="2"><img src="../images/t.gif" width="10" height="5" /></td>

            </tr>

            <tr>

              <td align="left"><em class="style2">Displaying <?=$start+1 ?> - 

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

</form>

</table>

</body><?php require_once('googletagmanager.php'); ?>

</html>

