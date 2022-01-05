<?php
	session_start();
	require_once('config.php');
	if(isset($_GET['id'])!="")
	{
    	$ID = $_GET['id'];
    }
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $resultarraymeta = mysql_fetch_array(mysql_query("SELECT * FROM tbl_custpages where id='".$ID."'"));   ?>
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
    <td class="pagebg"><table width="1120" border="0" align="center" cellpadding="0" cellspacing="15">
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

  	 