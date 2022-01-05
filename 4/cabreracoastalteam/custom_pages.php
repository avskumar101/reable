<?php	

session_start();
require_once('config.php');	

 $directoryURI =basename($_SERVER['SCRIPT_NAME']);	
 $filename= explode('.',$directoryURI);
 
 
 
 ?>
 
 <?php
 if($_GET['Mobile']=='') {

 $url =$_SERVER['HTTP_REFERER'];
 $query = parse_url($url, PHP_URL_QUERY);
 parse_str($query);	parse_str($query, $arr);
 $request = $_SERVER['HTTP_REFERER'];
 $urlname=explode('?',$request);	
 $urlname= $urlname[1];	if($urlname=='Mobile=Off' || $Mobile=='Off')	
 {
 echo "<script>window.location='$filename[0].php?Mobile=Off';</script>";	 
 exit;	
 }}
 
 
 if($_GET['Mobile']=='') {
 
 $useragent=$_SERVER['HTTP_USER_AGENT'];
 
 
 if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

 echo "<script>window.location.href='mobile/$filename[0].php';</script>";		

 }
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><?php $resultarraymeta = mysql_fetch_array(mysql_query("select * from tbl_custpages where file_name='".$filename[0]."'"));   ?> 
<meta http-equiv="keywords" content="<?php echo $resultarraymeta['meta_key'] ?>" />
<meta http-equiv="description" content="<?php echo $resultarraymeta['description'] ?>" />
<title><?php echo $resultarraymeta['meta_title'] ?></title>
<link href="styles.css" rel="stylesheet" type="text/css">
<link rel="SHORTCUT ICON" href="images/avalon.ico">
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-19645834-50', 'auto');
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
function liclick(navid)
	{
		if(navid == "2")
		{
			
			var stylevalue=document.getElementById('salesul').style.display;
			
			if(stylevalue=="")
			{
			document.getElementById('salesul').style.display='none';
			}
			if(stylevalue=="block")
			{
			document.getElementById('salesul').style.display='none';
			}
			if(stylevalue=="none")
			{
			
			document.getElementById('salesul').style.display='block';
			}
	}
	if(navid == "3")
		{
			
			var stylevalue=document.getElementById('rentalsul').style.display;
			
			if(stylevalue=="")
			{
			document.getElementById('rentalsul').style.display='none';
			}
			if(stylevalue=="block")
			{
			document.getElementById('rentalsul').style.display='none';
			}
			if(stylevalue=="none")
			{
			
			document.getElementById('rentalsul').style.display='block';
			}
	}
	if(navid == "4")
		{
			
			var stylevalue=document.getElementById('avalonul').style.display;
			
			if(stylevalue=="")
			{
			document.getElementById('avalonul').style.display='none';
			}
			if(stylevalue=="block")
			{
			document.getElementById('avalonul').style.display='none';
			}
			if(stylevalue=="none")
			{
			
			document.getElementById('avalonul').style.display='block';
			}
	}
	if(navid == "5")
		{
			
			var stylevalue=document.getElementById('stoneul').style.display;
			
			if(stylevalue=="")
			{
			document.getElementById('stoneul').style.display='none';
			}
			if(stylevalue=="block")
			{
			document.getElementById('stoneul').style.display='none';
			}
			if(stylevalue=="none")
			{
			
			document.getElementById('stoneul').style.display='block';
			}
	}
	if(navid == "6")
		{
			
			var stylevalue=document.getElementById('aboutul').style.display;
			
			if(stylevalue=="")
			{
			document.getElementById('aboutul').style.display='none';
			}
			if(stylevalue=="block")
			{
			document.getElementById('aboutul').style.display='none';
			}
			if(stylevalue=="none")
			{
			
			document.getElementById('aboutul').style.display='block';
			}
	}
	}

function liout(navid)
	{
		
		if(navid == "2")
		{
		document.getElementById('salesul').style.display='';
		}
		if(navid == "3")
		{
		document.getElementById('rentalsul').style.display='';
		}
		if(navid == "4")
		{
		document.getElementById('avalonul').style.display='';
		}
		if(navid == "5")
		{
		document.getElementById('stoneul').style.display='';
		}
		if(navid == "6")
		{
		document.getElementById('aboutul').style.display='';
		}
		
}

function liover(navid)
	{
	
		if(navid == "2")
		{
		
		document.getElementById('salesul').style.display='block';
		}
		if(navid == "3")
		{
		
		document.getElementById('rentalsul').style.display='block';
		}
		if(navid == "4")
		{
		
		document.getElementById('avalonul').style.display='block';
		}
		if(navid == "5")
		{
		
		document.getElementById('stoneul').style.display='block';
		}
		if(navid == "6")
		{
		
		document.getElementById('aboutul').style.display='block';
		}
}

</script>
</head>

<body onload="MM_preloadImages('images/recentlysold2.png')">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?php include("header.php")?></td></tr>
  
	<tr>
    <td class="pagebg"><table width="1120" border="0" align="center" cellpadding="0" cellspacing="15" class="medspacing">
      <tr>
        <td width="655" height="300px"align="left" valign="top" style="margin-top:20px;">
		
		<?php 
							$editortext = stripslashes($resultarraymeta['content']);
							
					
						echo $editortext;
				?>
		</td>
        
      </tr>
    </table></td>
  </tr>             
                  
                
              
    
 
  
     
      <tr>
        <td bgcolor="#195CAB"><img src="images/t.gif" width="10" height="2" /></td>
      </tr>
      
	  <tr>
        <td bgcolor="#1E8BCC">
		<table width="1147" border="0" align="center" cellpadding="8" cellspacing="0">
          <tr>
            <td align="center" class="size12 lightblue"><em><?php include("footer.php")?></em></td>
          </tr>
        </table></td>
      
	  </tr>
      <tr>
        <td bgcolor="#195CAB"><img src="images/t.gif" width="10" height="2" /></td>
      </tr>
      
	  </td>
  
</table>
</body><?php require_once('googletagmanager.php'); ?>
</html>

  	 