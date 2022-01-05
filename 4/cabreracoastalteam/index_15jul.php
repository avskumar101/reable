<?php
	session_start();
	require_once('config.php');
	$res_page_content=mysql_fetch_array(mysql_query("select *  from tbl_homepage"));

	//echo $res_page['heading'];


    $search_hometext = $_SESSION['HOMESEARCHTEXT'];
    if($search_hometext == null){
		$search_hometext = "";
	}
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="keywords" content="<?php echo $res_page_content['meta_key']; ?>" />
<meta http-equiv="description" content="<?php echo $res_page_content['meta_desc']; ?>" />
<meta name="robots" content="index, follow" />
<title><?php echo $res_page_content['meta_title']; ?></title>
<link href="styles.css" rel="stylesheet" type="text/css">
<link rel="SHORTCUT ICON" href="images/cabrera.ico">
<link rel="stylesheet" type="text/css" href="slider_style.css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<link rel="stylesheet" href="nivo/nivo-slider.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jcarousellite.js"></script>
<script>
$(function() {
    $(".anyClass").jCarouselLite({
        btnNext: ".next",
        btnPrev: ".prev"
    });
});

</script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47104613-18', 'cabrerateam.com');
  ga('send', 'pageview');
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<script type="text/javascript">
	function slideSwitch() 
	{
	    var $active = $('#slideshow IMG.active');
	    if ( $active.length == 0 ) $active = $('#slideshow IMG:last');
	
	    // use this to pull the images in the order they appear in the markup
	    var $next =  $active.next().length ? $active.next()
	        : $('#slideshow IMG:first');
	
	    // uncomment the 3 lines below to pull the images in random order
	    
	    // var $sibs  = $active.siblings();
	    // var rndNum = Math.floor(Math.random() * $sibs.length );
	    // var $next  = $( $sibs[ rndNum ] );

	    $active.addClass('last-active');
	
	    $next.css({opacity: 0.0})
	        .addClass('active')
	        .animate({opacity: 0.9}, 200, function() {
	            $active.removeClass('active last-active');
	        });
	}
	
	$(function() {
	    setInterval( "slideSwitch()", 5000 );
	});
	
</script>
<script>

function validate(a){
	document.getElementById('search_active_sold').value =a;
	if(a == 'active'){
		document.getElementById('searchhometext').value =document.getElementById('searchactivehometext').value;
	}else{
		document.getElementById('searchhometext').value =document.getElementById('searchsoldhometext').value;
	}
	
	document.homepage.submit();
	return true;
}
function openLogin()
{
	
var myWindow = window.open("wlogin.php","Login","toolbar=no, location = no, scrollbars=no, addressbar=no, titlebar=no, toolbar=no, resizable=no, top=200, left=450,width=350,height=370");
}

</script>

<style>
.searchBox{
	border:2px solid #FFFFFF;
	border-radius:10px;
	height: 24px;
	width: 527px;
	margin-left:5px;
}
</style>

</head>

<body onload="MM_preloadImages('images/recentlysold2.png')">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form name="homepage" id="homepage" action="results.php" method="post">
  <tr>
    <td><?php include_once("header.php");?></td>
  </tr>
  <tr>
    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">
      <tr>
        <td>
               <?php
               $list_rescount=mysql_fetch_array(mysql_query("select count(*) listcount from tbl_listings where status='ACTIVE'"));
               $activelistcount = number_format($list_rescount['listcount']);
               ?>
        <table width="1121" border="0" cellspacing="0" cellpadding="0"  >
          <tr>
            <td>
			<input type="hidden" id="search_properties" name="search_properties" value="search_mlshome" />
			 <input type="hidden" id="search_active_sold" name="search_active_sold" value="" />
			 <input type="hidden" id="searchhometext" name="searchhometext" value="" />
			 <div id="forsalediv" name="forsalediv" style="margin-top:0px;display:none;">
				<table style="position:absolute;margin-left:256px;margin-top:70px;" width="609" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="3"><img src="images/homesearchtop.png" width="609" height="12" /></td>
               </tr>
              <tr>
                <td width="12" rowspan="2" background="images/fadedblue.png"><img src="images/t.gif" width="12" height="96" /></td>
                <td width="585" valign="top" background="images/fadedblue.png" class="size18 white">SEARCH <?php echo $activelistcount; ?> ACTIVE LISTINGS ON THE CAPE MAY COUNTY MLS</td>
                <td width="12" rowspan="2" background="images/fadedblue.png"><img src="images/t.gif" width="12" height="96" /></td>
              </tr>
              <tr>
                <td valign="bottom" background="images/fadedblue.png"><table width="585" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2"><table width="585" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="22"><img src="images/t.gif" width="22" height="10" /></td>
                        <td width="80"><img src="images/forsale.png" width="80" height="24" /></td>
                        <td width="7"><img src="images/t.gif" width="7" height="10" /></td>
                        <td width="120"><a href="#" onclick="return searchchange('recentsoldval');" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('recentlysold','','images/recentlysold2.png',1)"><img src="images/recentlysold.png" alt="Recently Sold Properties In Cape May County" width="120" height="24" id="recentlysold" /></a></td>
                        <td width="356" align="right" class="size13"><a href="mls.php" class="whitelink"><strong>ADVANCED SEARCH &gt;</strong></a></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="536" background="images/searchbox.png"><input type="text" id="searchactivehometext" name="searchactivehometext" placeholder="ENTER A CITY, ADDRESS OR MLS NUMBER TO SEARCH" class="searchBox" style="color:#AAAAAA;"></td>
                    <td width="49">
                    
                    <a href="#" onclick="return validate('active')"><input type="image" src="images/search.png" alt="Search" width="49" height="39" id="search_properties" name="search_properties" value="search_mlshome"/></a>
                    
                    </td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/homesearchbottom.png" width="609" height="12" /></td>
                </tr>
            </table>
		</div>            

			 <div id="recentsolddiv" name="recentsolddiv" style="margin-top:0px;display:none;">
				<table style="position:absolute;margin-left:256px;margin-top:70px;" width="609" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="3"><img src="images/homesearchtop.png" width="609" height="12" /></td>
               </tr>
              <tr>
                <td width="12" rowspan="2" background="images/fadedblue.png"><img src="images/t.gif" width="12" height="96" /></td>
                <td width="585" valign="top" background="images/fadedblue.png" class="size18 white">SEARCH <?php echo $activelistcount; ?> ACTIVE LISTINGS ON THE CAPE MAY COUNTY MLS</td>
                <td width="12" rowspan="2" background="images/fadedblue.png"><img src="images/t.gif" width="12" height="96" /></td>
              </tr>
              <tr>
                <td valign="bottom" background="images/fadedblue.png"><table width="585" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2"><table width="585" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="22"><img src="images/t.gif" width="22" height="10" /></td>
                        <td width="80">
                        <a href="#" onclick="return searchchange('forsaleval');" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('forsale','','images/forsale.png',1)"><img src="images/forsale2.png" alt="For Sale Properties In Cape May County" id="forsale" /></a>
                        </td>
                        <td width="7"><img src="images/t.gif" width="7" height="10" /></td>
                        <td width="120">
                        <img src="images/recentlysold2.png" width="120" height="24" />
                        </td>
                        <td width="356" align="right" class="size13"><a href="mls.php" class="whitelink"><strong>ADVANCED SEARCH &gt;</strong></a></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="536" background="images/searchbox.png"><input type="text" id="searchsoldhometext" name="searchsoldhometext" class="searchBox" placeholder="ENTER A CITY, ADDRESS OR MLS NUMBER TO SEARCH" class="searchBox" style="color:#AAAAAA;"></td>
                    <td width="49">
                    <a href="#" onclick="return validate('sold');"><input type="image" src="images/search.png" alt="Search" width="49" height="39" id="search_properties" name="search_properties" value="search_mlshome"/></a>
                    </td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="3"><img src="images/homesearchbottom.png" width="609" height="12" /></td>
                </tr>
            </table>
		</div>            

		<div id="slideshow" style="width:15;height:600;">
		<? 
		$result = mysql_query("SELECT * FROM tbl_homepageupload_images where del_status=0 order by order_value");
		$i=0;
		while($resultarray1 = mysql_fetch_array($result))
		{
			if ($i<=0)
			{
				$i=1;
		?>
			<img src="homepageimages/<? echo $resultarray1['image_filename']; ?>" style="border-radius:15px;" alt="Slideshow Image 1" class="active" />
		<? } 
			else
			{
		?>
			<img src="homepageimages/<? echo $resultarray1['image_filename']; ?>" style="border-radius:15px;" alt="Slideshow Image 1"  />
		<?php
			}
		}
		?>
		</div>
			</td>
          </tr>
          <tr>
            <td><img src="images/t.gif" width="10" height="70" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="1121" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="3"><h1><?php echo $res_page_content['heading']; ?></h1>
              <h3><?php echo $res_page_content['heading1']; ?></h3></td>
            </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
            </tr>
          <tr>
            <td width="820" valign="top"><span class="spacing"><?php echo $res_page_content['content']; ?>
              </span>
              
              <h2 class="spacing">FEATURED REAL ESTATE &amp; PROPERTIES FOR SALE IN CAPE MAY COUNTY</h2>
              <table width="820" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="23" align="left" valign="middle"><a href="#"><img src="images/arrowleft.png" width="23" height="23" class="prev"/></a></td>
				 
                  <td width="10"><img src="images/t.gif" width="10" height="10" /></td>
                  <td width="181" align="center" valign="top"><table width="179" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td>
					   <div class="anyClass" >
			  <ul >
				<?php
					$list_res=mysql_query("select * from tbl_listings where Org_Name = 'Long & Foster Real Estate Inc - Wc' and agent_firstname='Jeanine' and agent_lastname='Cabrera' order by Original_Price desc");
					while($data=mysql_fetch_array($list_res))
					{
						if ($data['mainimg']!='')
						$image=$data['mainimg'];
						else
						$image="images/nopicture.png";
				?>
				<li ><table width="100" border="0" cellspacing="0" cellpadding="2">
                        <tr>
                          <td bgcolor="#195CAB"><a href="property.php?MLSNo=<?php echo $data['MLSNo'];?>"><img src="<?php echo $image;?>" width="175" height="110" /></a></td>
						  <td><img src="images/t.gif" width="10" height="5" />
						  </td>
                        </tr>
						 <tr>
                      <td><img src="images/t.gif" width="10" height="5" /></td>
                    </tr>
                    <tr>
                      <td align="center" nowrap> <a href="property.php?MLSNo=<?php echo $data['MLSNo'];?>"><strong><?php echo $data['Address'];?></strong></a></td>
                    </tr>
                    
					  <tr>
                      <td align="center"><?php echo $data['City']?></td>
                    
                    </tr>
                    <tr>
                      <td align="center"><?php echo $data['Bedrooms']?> Bedrooms &nbsp; <?php echo $data['Full_Baths']?> Bathrooms</td>
                    </tr>
					<tr>
                      <td><img src="images/t.gif" width="10" height="5" /></td>
                    </tr>
                    <tr>
                      <td align="center" class="size16 green"><strong>$<?php echo number_format($data['Original_Price']);?></strong></td>
                    </tr>
					
                      </table></li>
					  
			    <?php
					}
				?>
			  </ul>
			  </div></td>
					  
                   
                   
                  </table></td>
                  

                  <td width="23" align="right" valign="middle"><a href="#"><img src="images/arrowright.png" width="23" height="23" class="next"/></a></td>
                </tr>
              </table></td>
              
            <td width="18">&nbsp;</td>
            <td width="283" valign="top"><table width="283" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td background="images/jerseyshoreevents.jpg"><table width="283" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="20"><img src="images/t.gif" width="20" height="33" /></td>
                    <td width="243" align="center" valign="middle" class="size17"><a href="events.php" class="whitelink">CAPE MAY COUNTY EVENTS</a></td>
                    <td width="20"><img src="images/t.gif" width="20" height="33" /></td>
                  </tr>
                  </table></td>
              </tr>
              <tr>
                <td><table width="283" border="0" cellspacing="3" cellpadding="0" bgcolor="#195CAB">
                  <tr>
                    <td bgcolor="#D1DEEE"><table width="277" border="0" cellspacing="13" cellpadding="0">
                    <?php
                    $eventsobj = mysql_query("select * from tbl_events where deletestatus != 1 order by eventdate limit 7");
                    while($eventobject = mysql_fetch_array($eventsobj)){
					
					$eventdatevalue=date('F jS Y',$eventobject['eventdate']);
                    ?>
                      <tr>
                        <td><strong><?php echo $eventobject['eventname']?></strong><br />
                          <span class="size13"><?php echo $eventdatevalue;?> - <?php echo $eventobject['city'];?></span></td>
                      </tr>
                      <tr bgcolor="#A9C1E0">
                        <td><img src="images/t.gif" width="15" height="1" /></td>
                      </tr>
                    <?php
                    }
                    ?>
                      
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td background="images/eventsfooter.jpg"><table width="283" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="10"><img src="images/t.gif" width="10" height="22" /></td>
                    <td width="263" align="center" valign="top"><a href="events.php" class="whitelink size13">- ADDITIONAL FAMILY FRIENDLY EVENTS -</a></td>
                    <td width="10"><img src="images/t.gif" width="10" height="22" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/t.gif" width="10" height="8" /></td>
      </tr>
      <tr>
        <td bgcolor="#195CAB"><img src="images/t.gif" width="10" height="2" /></td>
      </tr>
      <tr>
        <td bgcolor="#1E8BCC"><table width="1147" border="0" align="center" cellpadding="8" cellspacing="0">
          <tr>
            <td align="center" class="size12 lightblue"><em><?php include("footer.php")?></em></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#195CAB"><img src="images/t.gif" width="10" height="2" /></td>
      </tr>
      <tr>
        <td><img src="images/t.gif" width="10" height="8" /></td>
      </tr>
      <tr>
        <td><table width="220" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="30"><a href="https://www.youtube.com/channel/UCAnsRSon87T8_4vhjcOs-eg" target="_blank"><img src="images/youtube-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://twitter.com/CabreraTeam" target="_blank"><img src="images/twitter-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://plus.google.com/u/0/117240634238969765951/posts" target="_blank"><img src="images/googleplus-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://www.facebook.com/CabreraCoastalTeam" target="_blank"><img src="images/facebook-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="https://www.linkedin.com/company/cabrera-coastal-team" target="_blank"><img src="images/linkedin-bottom.jpg" width="30" height="30" /></a></td>
            <td width="8"><img src="images/t.gif" width="8" height="30" /></td>
            <td width="30"><a href="http://www.pinterest.com/cabrerateam/" target="_blank"><img src="images/pinterest-bottom.jpg" width="30" height="30" border="0" /></a></td>
          </tr>
        </table></td>
		
      </tr>
      <tr>
        <td><img src="images/t.gif" width="10" height="8" /></td>
      </tr>
	  <tr>
        <td><img src="images/t.gif" width="10" height="8" /></td>
      </tr>
	  <tr>
        <td><img src="images/t.gif" width="10" height="8" /></td>
      </tr>
	  	<tr>
            <td><div align="center"></span><span ><a href="#"  onclick= "openLogin()">Login</a></span></div></td>
          </tr>
    </table></td>
  </tr>
<script>
function searchchange(a){
	if(a == "recentsoldval"){
		document.getElementById('recentsolddiv').style.display = "block";
		document.getElementById('forsalediv').style.display = "none";
	}else{
		document.getElementById('forsalediv').style.display = "block";
		document.getElementById('recentsolddiv').style.display = "none";
	}
	return false;
}
searchchange('forsaleval');
</script>
</form>
</table>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="nivo/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="nivo/jquery.nivo.slider.pack.js"></script>

<script type="text/javascript" src="js/jcarousellite.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#slider').nivoSlider({ effect: 'fade', startSlide: 0, pauseTime: 5000, animSpeed: 500, pauseOnHover: false, captionOpacity: 1, directionNavHide: false });
});

</script>
<?php
    $_SESSION['HOMESEARCHACTIVESOLDTEXT'] ="";
    $_SESSION['HOMESEARCHTEXT'] ="";
?>
</body><?php require_once('googletagmanager.php'); ?>

</html>
