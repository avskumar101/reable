<?php
	session_start();
	require_once('../config.php');
	if(isset($_SESSION['uid'])=="" )
	  header("Location: ../index.php");
	$userid=$_SESSION['uid'];
	

	
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
 function adduser()
{
window.location.href="updatepages-custom-generic.php";
}
function select_allimages()
	{
        var selall = document.getElementById('selectallimage').checked;
        var chkbox;
        var form_name = document.getElementById('update_page');
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
	
	function confirm_page_delete()
	{
		var form_name = document.getElementById('update_page');
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
				PopupWindow=window.open("global_deletepage.php?pageflag=delete_page&deleteids="+hidalldeleteid,"CustomPopUp",settings);   
				PopupWindow.focus();
				return true;
			} 
			else 
			{
				return false;
			}
	    }
	}

function opencust(a,b){
	
	newWin = window.open('../'+a+'?id='+b,'newWin','location=no,toolbar=yes,menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes'); 
	return false;
}	  
</script>
</head>

<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <form enctype="multipart/form-data" name="update_page" id="update_page" method="POST">
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
            <td><div align="center" class="white"><a href="index.php" class="whitelink">USER ACCOUNTS</a> &nbsp; | &nbsp; <a href="soldproperties.php" class="whitelink">SOLD PROPERTIES</a> &nbsp; | &nbsp; <a href="updatepages.php" class="whitelink">UPDATE PAGES</a> &nbsp; | &nbsp; <a href="uploadfiles.php" class="whitelink">UPLOAD FILES</a> &nbsp; | &nbsp; <a href="sitetemplate.php" class="whitelink">SITE TEMPLATE</a>  &nbsp; | &nbsp; <a href="storeddata.php" class="whitelink">STORED DATA</a></div></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="../images/t.gif" width="10" height="12" /></td>
      </tr>
      <tr>
        <td><h2>UPDATE PAGES</h2>
          <table width="1122" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2"><table width="1122" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                  <td width="888" bgcolor="#CCCCCC"><div align="left"><strong>Page Name</strong></div></td>
                  <td width="100" bgcolor="#CCCCCC"><div align="center"><strong>Preview</strong></div></td>
                  <td width="100" bgcolor="#CCCCCC"><div align="center"><strong>Action</strong></div></td>
                </tr>
                <tr>
                  <td bgcolor="#F8F7E0"><div align="left">HOME</div></td>
                  <td bgcolor="#F8F7E0"><div align="center"><a href="../index.php" target="_blank">View</a></div></td>
                  <td bgcolor="#F8F7E0"><div align="center"><a href="updatepages-home.php">Modify</a></div></td>
                </tr>				
				<tr bgcolor="#CAE1F7">     
				<td><div align="left">SALES > LIST YOUR PROPERTY</div></td>                  <td><div align="center"><a href="../listsales.php" target="_blank">View</a></div></td>                
				<td><div align="center"><a href="update_pages.php?id=2">Modify</a></div></td>                
				</tr>
				
				
				<tr>                
				<td bgcolor="#F8F7E0"><div align="left">SALES > REAL ESTATE RESOURCES</div></td>             
				<td bgcolor="#F8F7E0"><div align="center"><a href="../resources.php" target="_blank">View</a></div></td>               
				<td bgcolor="#F8F7E0"><div align="center"><a href="update_pages.php?id=3">Modify</a></div></td>               
				</tr>		

				<tr bgcolor="#CAE1F7">       
				<td><div align="left">SALES > JOIN THE TEAM</div></td>     
				<td><div align="center"><a href="../jointheteam.php" target="_blank">View</a></div></td>               
				<td><div align="center"><a href="update_pages.php?id=4">Modify</a></div></td>               
				</tr>	

				<tr>                
				<td bgcolor="#F8F7E0"><div align="left">SEARCH TOWNS / EVENTS > CAPE MAY</div></td>        
				<td bgcolor="#F8F7E0"><div align="center"><a href="../capemayrealestate.php" target="_blank">View</a></div></td>          
				<td bgcolor="#F8F7E0"><div align="center"><a href="update_pages.php?id=5">Modify</a></div></td>           
				</tr>	

				<tr bgcolor="#CAE1F7">         
				<td><div align="left">SEARCH TOWNS / EVENTS > WILDWOOD CREST</div></td>                 
				<td><div align="center"><a href="../wildwoodcrestproperties.php" target="_blank">View</a></div></td>        
				<td><div align="center"><a href="update_pages.php?id=6">Modify</a></div></td>              
				</tr>	

				<tr>       
				<td bgcolor="#F8F7E0"><div align="left">SEARCH TOWNS / EVENTS > WILDWOOD</div></td>        
				<td bgcolor="#F8F7E0"><div align="center"><a href="../wildwoodrealestate.php" target="_blank">View</a></div></td>      
				<td bgcolor="#F8F7E0"><div align="center"><a href="update_pages.php?id=7">Modify</a></div></td>        
				</tr>	

				<tr bgcolor="#CAE1F7">       
				<td><div align="left">SEARCH TOWNS / EVENTS > WEST WILDWOOD</div></td>                 
				<td><div align="center"><a href="../westwildwoodhomes.php" target="_blank">View</a></div></td>   
				<td><div align="center"><a href="update_pages.php?id=8">Modify</a></div></td>                
				</tr>			

				<tr>   
				<td bgcolor="#F8F7E0"><div align="left">SEARCH TOWNS / EVENTS > NORTH WILDWOOD</div></td>             
				<td bgcolor="#F8F7E0"><div align="center"><a href="../northwildwoodproperties.php" target="_blank">View</a></div></td>       
				<td bgcolor="#F8F7E0"><div align="center"><a href="update_pages.php?id=9">Modify</a></div></td>          
				</tr>		

				<tr bgcolor="#CAE1F7">         
				<td><div align="left">SEARCH TOWNS / EVENTS > DIAMOND BEACH</div></td>                 
				<td><div align="center"><a href="../diamondbeachproperties.php" target="_blank">View</a></div></td>       
				<td><div align="center"><a href="update_pages.php?id=10">Modify</a></div></td>              
				</tr>		

				<tr>            
				<td bgcolor="#F8F7E0"><div align="left">SEARCH TOWNS / EVENTS > LOWER TOWNSHIP</div></td>        
				<td bgcolor="#F8F7E0"><div align="center"><a href="../lowertownshiprealestate.php" target="_blank">View</a></div></td>      
				<td bgcolor="#F8F7E0"><div align="center"><a href="update_pages.php?id=11">Modify</a></div></td>          
				</tr>	

				<tr bgcolor="#CAE1F7">      
				<td><div align="left">SEARCH TOWNS / EVENTS > MIDDLE TOWNSHIP</div></td>                
				<td><div align="center"><a href="../middletownshiphomes.php" target="_blank">View</a></div></td>    
				<td><div align="center"><a href="update_pages.php?id=12">Modify</a></div></td>               
				</tr>		

				<tr bgcolor="#F8F7E0">           
				<td><div align="left">SEARCH TOWNS / EVENTS > AVALON</div></td>                  <td><div align="center"><a href="../middletownshiphomes.php" target="_blank">View</a></div></td>          
				<td><div align="center"><a href="update_pages.php?id=21">Modify</a></div></td>                </tr>		

				<tr bgcolor="#CAE1F7">        
				<td><div align="left">SEARCH TOWNS / EVENTS > STONE HARBOR</div></td>         
				<td><div align="center"><a href="../middletownshiphomes.php" target="_blank">View</a></div></td>          
				<td><div align="center"><a href="update_pages.php?id=20">Modify</a></div></td>            
				</tr>		

				<tr>          
				<td bgcolor="#F8F7E0"><div align="left">RENTALS > LIST FOR RENT</div></td>                
				<td bgcolor="#F8F7E0"><div align="center"><a href="../listrental.php" target="_blank">View</a></div></td>       
				<td bgcolor="#F8F7E0"><div align="center"><a href="update_pages.php?id=13">Modify</a></div></td>          
				</tr>	

				<tr bgcolor="#CAE1F7">          
				<td><div align="left">RENTALS > VACATION RENTAL POLICY</div></td>                  <td><div align="center"><a href="../vacationrentalpolicy.php" target="_blank">View</a></div></td>          
				<td><div align="center"><a href="update_pages.php?id=14">Modify</a></div></td>                
				</tr>			

				<tr bgcolor="#F8F7E0">          
				<td><div align="left">RENTALS > VACATION RENTALS</div></td>           
				<td><div align="center"><a href="../vacationrentals.php" target="_blank">View</a></div></td>          
				<td><div align="center"><a href="update_pages.php?id=22">Modify</a></div></td>
				</tr>		

				<tr bgcolor="#CAE1F7">          
				<td><div align="left">LET US HELP</div></td>           
				<td><div align="center"><a href="../letushelp.php" target="_blank">View</a></div></td>
				<td><div align="center"><a href="update_pages.php?id=23">Modify</a></div></td>
				</tr>	

				<tr>          
				<td bgcolor="#F8F7E0"><div align="left">PROPERTY MANAGEMENT > PROPERTY MANAGEMENT</div></td>          
				<td bgcolor="#F8F7E0"><div align="center"><a href="../propertymanagement.php" target="_blank">View</a></div></td>        
				<td bgcolor="#F8F7E0"><div align="center"><a href="update_pages.php?id=15">Modify</a></div></td>            
				</tr>	

				<tr bgcolor="#CAE1F7">         
				<td><div align="left">PROPERTY MANAGEMENT > HOME REPAIR</div></td>                  <td><div align="center"><a href="../homerepair.php" target="_blank">View</a></div></td>             
				<td><div align="center"><a href="update_pages.php?id=16">Modify</a></div></td>             
				</tr>	

				
                <tr bgcolor="#F8F7E0">
                  <td><div align="left">MEET OUR TEAM</div></td>
                  <td><div align="center"><a href="../team.php" target="_blank">View</a></div></td>
                  <td><div align="center"><a href="updatepages-ourteam.php">Modify</a></div></td>
                </tr>
               
                <tr bgcolor="#CAE1F7">
                  <td><div align="left">CONTACT US</div></td>
                  <td><div align="center"><a href="../contact.php" target="_blank">View</a></div></td>
                  <td><div align="center"><a href="update_pages.php?id=17">Modify</a></div></td>
                </tr>
               
                <tr bgcolor="#F8F7E0">
                  <td><div align="left">WEATHER</div></td>
                  <td><div align="center"><a href="../weather.php" target="_blank">View</a></div></td>
                  <td><div align="center"><a href="update_pages.php?id=18">Modify</a></div></td>
                </tr>
               
                <tr bgcolor="#CAE1F7">
                  <td><div align="left">EVENTS</div></td>
                  <td><div align="center"><a href="../events.php" target="_blank">View</a></div></td>
                  <td><div align="center"><a href="updatepages-events.php">Modify</a></div></td>
                </tr>				
               
                <tr bgcolor="#F8F7E0">
                  <td><div align="left">EMAIL ALERTS</div></td>
                  <td><div align="center"><a href="../emailalerts.php" target="_blank">View</a></div></td>
                  <td><div align="center"><a href="update_pages.php?id=19">Modify</a></div></td>
                </tr>						
				<tr bgcolor="#CAE1F7">           
				<td><div align="left">TESTIMONIALS</div></td>                 

				<td><div align="center"><a href="../testimonials.php" target="_blank">View</a></div></td>            
				<td><div align="center"><a href="updatepages-generic.php">Modify</a></div></td>             
				</tr>
              </table></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" bgcolor="#CCCCCC"><img src="../images/t.gif" width="10" height="1" /></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td width="487" align="left" class="style7"><strong>CUSTOM PAGES</strong></td>
              <td width="635" align="right"><input type="button" name="button" id="button" value="Add New Page" onclick="adduser();" />
                <input type="button" name="button2" id="button2" value="Delete Selected" onclick="confirm_page_delete();" /></td></td>
            </tr>
				
            <tr>
              <td colspan="2"><img src="../images/t.gif" width="10" height="5" /></td>
            </tr>
            <tr>
              <td colspan="2">
			  
			  
			  <table width="1122" border="0" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
                <tr>
                  <td width="827" bgcolor="#CCCCCC"><div align="left"><strong>Page Name</strong></div></td>
                  <td width="100" bgcolor="#CCCCCC"><div align="center"><strong>Preview</strong></div></td>
                  <td width="100" bgcolor="#CCCCCC"><div align="center"><strong>Action</strong></div></td>
                  <td width="50" bgcolor="#CCCCCC"><div align="center">
                    
					<input type="checkbox" name="selectallimage" id="selectallimage" onClick="return select_allimages();" />
					
                  </div></td>
                </tr>
				
		<?php
			$result=@mysql_query("SELECT * FROM tbl_custpages where delete_status!=1");
			
		   $i=1;
		   while($resultarray = @mysql_fetch_array($result))
		   {
			$filename = $resultarray['file_name'];
			$id = $resultarray['id'];
				if($i%2==0)
					$bgcolor="#CAE1F7";
				else
					$bgcolor="#F8F7E0";
		
			?>
	<tr>
	<td bgcolor="<?php echo $bgcolor; ?>" ><div align="left"><?php echo $resultarray['page_name'] ?></div></td>
	
	<td bgcolor="<?php echo $bgcolor; ?>" ><div align="center">
	
	<a href="../<?php echo $filename?>.php" target="_blank">View</a></div></td>
	
	<td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
	
	<a href="updatepages-custom-generic.php?id=<?php echo $resultarray['id'] ?>">Modify</a>
	
	</div></td>
	
	<td bgcolor="<?php echo $bgcolor; ?>"><div align="center">
	
	<input type="checkbox" name="chk_delete[]" id="chk_delete" value="<?php echo $resultarray['id']; ?>"  />
	
	</div></td>
	</tr>


					<?php
					$i=$i+1;
				
					}
					?>
					 <input type="hidden" name="total_count" id="total_count" value="<? echo $i-1; ?>">
                    

                  </table></td>
                </tr>
              </table>              
              </td>
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
</body>
</html>
