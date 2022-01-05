<?php

if($_GET['Mobile']=='') {
	
	if($_POST['Mobile']==''){
		
		$url =$_SERVER['HTTP_REFERER'];
		$query = parse_url($url, PHP_URL_QUERY);
		parse_str($query);
		parse_str($query, $arr);
		$request = $_SERVER['HTTP_REFERER'];
		$urlname=explode('?',$request);
		$urlname= $urlname[1];
		if($urlname=='Mobile=Off' || $Mobile=='Off') {
			
			echo "<script>window.location='mls.php?Mobile=Off&".$_SERVER['QUERY_STRING']."';</script>";
			exit;
		}
	 }
  } 

if($_GET['Mobile']=='') {
	
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
	
 echo "<script>window.location='mobile/search.php';</script>"; 

}

session_start();

require_once('config.php');
	
	
if($_POST['btnsubmit']=='listsubmit') {	


	$umcnd .="Mls=Search";
	
	// PROPERTIES TOWN 
	
	$propertytown = $_POST['pSearch'];
	
	$prpcount = count($_POST['pSearch']);
	
	if($propertytown[0] != ""){
		
		for($k=0;$k<$prpcount; $k++){			

			if($k == $prpcount-1){
				
				$amcndt .= "$propertytown[$k]";
				
			} else {
				
				$amcndt .= "$propertytown[$k],";							
			}
		}	
	}	
	if($amcndt!=''){
		
		$umcnd .="&Town=".$amcndt;
		
	} else {
		
		$umcnd .="&Town=All";
	}
	
	// PROPERTIES TYPE 
	
	$propertytype = $_POST['propertycheckbox'];
	
	$propcount = count($_POST['propertycheckbox']);
	
	if($propertytype[0] != ""){
		
		for($p=0;$p<$propcount; $p++){			

			if($p == $propcount-1){
				
				$amcnd .= "$propertytype[$p]";
				
			} else {
				
				$amcnd .= "$propertytype[$p],";							
			}
		}	
	}
	
	if($amcnd!=''){
		
		$umcnd .="&Type=".$amcnd;
	}	
	if($_POST['MinPrice']!=0){
		
		$umcnd .="&MinPrice=".$_POST['MinPrice'];
	}	
	if($_POST['MaxPrice']!=99999999){
		
		$umcnd .="&MaxPrice=".$_POST['MaxPrice'];
	}	
	if($_POST['selbedsmin']!=''){
		
		$umcnd .="&BedsMin=".$_POST['selbedsmin'];
	}	
	if($_POST['selbedsmax']!=''){
		
		$umcnd .="&BedsMax=".$_POST['selbedsmax'];
	}
	if($_POST['foreclosure']!=''){
		
		$umcnd .="&FC=".$_POST['foreclosure'];
	}	
	if($_POST['sortby']!=''){
		
		$umcnd .="&OB=".$_POST['sortby'];
	}
	
	
	header("Location:results.php?$umcnd");
	
}	

    $search_minprice = $_GET['MinPrice'];

    if($search_minprice == null){

		$search_minprice = "0";
	}
    $search_maxprice = $_GET['MaxPrice'];

    if($search_maxprice == null){

		$search_maxprice = "99999999";
	}
    $selbedsmin = $_GET['BedsMin'];

    if($selbedsmin == null){

		$selbedsmin = "";
	}
    $selbedsmax = $_GET['BedsMax'];

    if($selbedsmax == null){

		$selbedsmax = "";
	}
    $search_foreclosure = $_GET['FC'];

    if($search_foreclosure == null){

		$search_foreclosure = "";
	}
    $search_sortby = $_GET['OB'];

    if($search_sortby == null){

		$search_sortby = "desc";
	}
    $search_properties1 = $_GET['Type'];

    if($search_properties1 == null){

		$search_properties1 = "0";
	}
    $search_towns = $_GET['Town'];

    if($search_towns == null){

		$search_towns = "0";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="keywords" content="Advanced Search, MLS Search, Cape May County Properties, For Sale, Properties For Sale," />

<meta http-equiv="description" content="Search for properties listed in the Cape May County MLS." />

<meta name="robots" content="index, follow" />

<meta name="google-translate-customization" content="d7ce69365b51aedc-3957c26e6dd9722c-g0825b9517a50493e-1a"></meta>

<title>Cape May County Properties For Sale - MLS Advanced Search</title>

<link rel="alternate" href="http://cabreracoastalteam.com/mobile/search.php"/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<link href="styles.css" rel="stylesheet" type="text/css">

<link rel="SHORTCUT ICON" href="images/cabrera.ico">

<script>

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-47104613-18', 'auto');

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

function submitform(){

document.mls.btn_submit.click();

return true; }

function listbox_move(listID,direction) {

    var listbox=document.getElementById(listID);

    var selIndex=listbox.selectedIndex;

    if(-1==selIndex){alert("Please select an option to move.");return;}

    var increment=-1;

    if(direction=='up')

        increment=-1;

    else

        increment=1;

    if((selIndex+increment)<0||(selIndex+increment)>(listbox.options.length-1)){return;}

     

    var selValue=listbox.options[selIndex].value;

    var selText=listbox.options[selIndex].text;

    listbox.options[selIndex].value=listbox.options[selIndex+increment].value;

    listbox.options[selIndex].text=listbox.options[selIndex+increment].text;

    listbox.options[selIndex+increment].value=selValue;

    listbox.options[selIndex+increment].text=selText;

    listbox.selectedIndex=selIndex+increment;

}



function listbox_moveacross(sourceID,destID) {
	
    var src=document.getElementById(sourceID);

    var dest=document.getElementById(destID);    

    var picked1 = false;
	
    for(var count=0;count<src.options.length;count++) {

        if(src.options[count].selected==true){
			
			picked1=true;
		}
    }

    if(picked1==false){ 
	
	alert("Please select an option to move.");return;

	} 

    for(var count=0;count<src.options.length;count++) {

        if(src.options[count].selected==true){
			
			var option=src.options[count];

            var newOption=document.createElement("option");

            newOption.value=option.value;

            newOption.text=option.text;

            newOption.selected=true;

            try{dest.add(newOption,null);

            src.remove(count,null);
        }

		catch(error){dest.add(newOption);src.remove(count);

        }

        count--;

        }

    }

	if(sourceID =='pSearch[]' || sourceID =='pSearch1[]'){

	    	for(var count=0;count<src.options.length;count++) {

	        	src.options[count].selected=true;

	    	}

	    }
	} 

function listbox_selectall(listID,isSelect){

	var listbox=document.getElementById(listID);

	for(var count=0;count<listbox.options.length;count++){

	listbox.options[count].selected=isSelect;

	}
}

function submitform() {
	
	document.forms["mls"].submit();
	
	return true;
}
</script>

</head>

<body onload="MM_preloadImages('images/add2.jpg','images/remove2.jpg','images/search2.jpg')">

<table width="100%" border="0" cellspacing="0" cellpadding="0">


<form id="mls" name="mls" method="POST" enctype='multipart/form-data'>

 <tr><td><?php include("header.php");?></td></tr>

     <input type="hidden" name="Mobile" id="Mobile" value="<?php echo $_GET['Mobile']; ?>">

  <tr>

    <td><table width="1147" border="0" align="center" cellpadding="0" cellspacing="13">

      <tr>

        <td>
		
		<h1>ADVANCED SEARCH - CAPE MAY COUNTY PROPERTIES FOR SALE</h1>

		<p class="medspacing">Please use the MLS search feature below to find your new beach home here at the shore including Wildwood Crest, North Wildwood, Wildwood, Stone Harbor, Avalon, Lower Township, Diamond Beach, and the entire Cape May County, NJ. Our team of professional realtors is ready to assist you in your search</p>
		<table width="1121" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td width="160"><a href="http://cabreracoastalteam.com/results.php?Mls=Search&amp;Town=Cape%20May,Cape%20May%20Point,West%20Cape%20May&amp;Type=Single%20Family,CONDO,TOWNHOUSE,MULTI-FAMILY,Modular/Mobile,LOTS/LAND,COMMERCIAL/INDUSTRIAL&amp;OB=desc"><img src="images/capemaylistings.jpg" alt="All Cape May Properties For Sale" width="160" height="200" border="0" /></a></td>
		    <td width="160"><a href="http://cabreracoastalteam.com/results.php?Mls=Search&amp;Town=Cape%20May%20Beach,Lower%20Township,Erma,Cold%20Spring&amp;Type=Single%20Family,CONDO,TOWNHOUSE&amp;OB=desc#"><img src="images/lowertwp.jpg" alt="Lower Township Properties" width="160" height="200" border="0" /></a></td>
		    <td width="160"><a href="http://cabreracoastalteam.com/results.php?Mls=Search&amp;Town=North%20Wildwood,West%20Wildwood,Wildwood,Wildwood%20Crest&amp;Type=Single%20Family,CONDO,TOWNHOUSE,MULTI-FAMILY,Modular/Mobile,LOTS/LAND,COMMERCIAL/INDUSTRIAL&amp;OB=desc#"><img src="images/wildwoodlistings.jpg" alt="Wildwood Crest, Wildwood &amp; North Wildwood Real Estate" width="160" height="200" border="0" /></a></td>
		    <td width="160"><a href="http://cabreracoastalteam.com/results.php?Mls=Search&amp;Town=Avalon,Stone%20Harbor&amp;Type=Single%20Family,CONDO,TOWNHOUSE,MULTI-FAMILY,Modular/Mobile,LOTS/LAND,COMMERCIAL/INDUSTRIAL&amp;OB=desc#"><img src="images/avalonstoneharborlistings.jpg" alt="Avalon &amp; Stone Harbor Properties For Sale" width="160" height="200" border="0" /></a></td>
		    <td width="161"><a href="http://cabreracoastalteam.com/results.php?Mls=Search&amp;Town=Middle%20Township,Goshen,Avalon%20Manor,Cape%20May%20Court%20House,Del%20Haven,Stone%20Harbor%20Manor&amp;Type=Single%20Family,CONDO,TOWNHOUSE,MULTI-FAMILY,Modular/Mobile,LOTS/LAND,COMMERCIAL/INDUSTRIAL&amp;OB=desc#"><img src="images/middletwp.jpg" alt="Middle Township Real Estate Properties" width="161" height="200" border="0" /></a></td>
		    <td width="160"><a href="http://cabreracoastalteam.com/results.php?Mls=Search&amp;Town=All&amp;Type=Single%20Family,CONDO,TOWNHOUSE,MULTI-FAMILY,Modular/Mobile,LOTS/LAND,COMMERCIAL/INDUSTRIAL&amp;FC=Yes&amp;OB=desc#"><img src="images/bankowned.jpg" alt="Bank Owned Properties" width="160" height="200" border="0" /></a></td>
		    <td width="160"><a href="http://www.cabreracoastalteam.com/results.php?Mls=Cabrera"><img src="images/cabreralistings.jpg" alt="Cabrera Coastal Real Estate Properties" width="160" height="200" border="0" /></a></td>
		    </tr>
		  </table>
		<br />
		<table width="1121" border="0" cellspacing="0" cellpadding="0">
		  
		  <tr>

              <td><table width="1121" border="0" cellspacing="1" cellpadding="6">

                <tr>

                  <td width="35">&nbsp;</td>

                  <td width="140" align="center" bgcolor="#1E8BCC">
				  <a href="mls.php" class="whitelink">ADVANCED SEARCH</a></td>

                  <td width="5">&nbsp;</td>

                  <td width="100" align="center" bgcolor="#195CAB">
				  <a href="map.php" class="whitelink">MAP SEARCH</a></td>

                  <td width="5">&nbsp;</td>

                  <td width="150" align="center" bgcolor="#195CAB">
				  <a href="address.php" class="whitelink">SEARCH BY ADDRESS</a></td>

                  <td width="5">&nbsp;</td>

                  <td width="175" align="center" bgcolor="#195CAB">
				  <a href="number.php" class="whitelink">SEARCH BY MLS NUMBER</a></td>

                  <td width="388">&nbsp;</td>

                </tr>

              </table></td>

            </tr>

            <tr>

              <td bgcolor="#1E8BCC">
			  
			  <table width="1121" border="0" cellspacing="7" cellpadding="13">

                <tr>

                  <td bgcolor="#EEF7FD">
				  
				  <table width="1081" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td width="485" valign="top">
					  <table width="426" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                          <td align="center"><strong><u>AVAILABLE TOWNS</u></strong></td>

                          <td>&nbsp;</td>

                          <td align="center"><strong><u>SELECTED TOWNS</u></strong></td>

                          </tr>

                        <tr>

                          <td colspan="3"><img src="images/t.gif" width="13" height="13" /></td>

                          </tr>

                        <tr>

                          <td width="166" align="center"><span class="spacing">

                            <select name="pSearchCities" size="0" multiple="multiple" class="form-select[]" id="pSearchCities[]" style="height:180px">

                              <option  value="All">All</option>

                              <option value="Absecon">Absecon</option>

                              <option value="Atlantic City">Atlantic City</option>

                              <option value="Avalon">Avalon</option>

                              <option value="Avalon Manor">Avalon Manor</option>

                              <option value="Beesleys Point">Beesleys Point</option>

                              <option value="Belleplain">Belleplain</option>

                              <option value="Brigantine">Brigantine</option>

                              <option value="Burleigh">Burleigh</option>

                              <option value="Cape May">Cape May</option>

                              <option value="Cape May Beach">Cape May Beach</option>

                              <option value="Cape May Court House">Cape May Court House</option>

                              <option value="Cape May Point">Cape May Point</option>

                              <option value="Clermont">Clermont</option>

                              <option value="Cold Spring">Cold Spring</option>

                              <option value="Del Haven">Del Haven</option>

                              <option value="Dennis Township">Dennis Township</option>

                              <option value="Dennisville">Dennisville</option>

                              <option value="Diamond Beach">Diamond Beach</option>

                              <option value="Dias Creek">Dias Creek</option>

                              <option value="Dorchester">Dorchester</option>

                              <option value="Edgewood">Edgewood</option>

                              <option value="Egg Harbor Township">Egg Harbor Township</option>

                              <option value="Eldora">Eldora</option>

                              <option value="Erma">Erma</option>

                              <option value="Fishing Creek"  >Fishing Creek</option>

                              <option value="Galloway Township"  >Galloway Township</option>

                              <option value="Goshen"    >Goshen</option>

                              <option value="Grassy Sound"    >Grassy Sound</option>

                              <option value="Green Creek"   >Green Creek</option>

                              <option value="Hamilton Township"  >Hamilton Township</option>

                              <option value="Leesburg"  >Leesburg</option>

                              <option value="Linwood"   >Linwood</option>

                              <option value="Lower Township"   >Lower Township</option>

                              <option value="Margate"   >Margate</option>

                              <option value="Marmora"   >Marmora</option>

                              <option value="Marshallville"  >Marshallville</option>

                              <option value="Mays Landing"  >Mays Landing</option>

                              <option value="Mayville"  >Mayville</option>

                              <option value="Middle Township"  >Middle Township</option>

                              <option value="Millville"  >Millville</option>

                              <option value="North Cape May"  >North Cape May</option>

                              <option value="North Wildwood"   >North Wildwood</option>

                              <option value="Ocean City"   >Ocean City</option>

                              <option value="Oceanview"   >Oceanview</option>

                              <option value="Out of County"   >Out of County</option>

                              <option value="Palermo"   >Palermo</option>

                              <option value="Petersburg"   >Petersburg</option>

                              <option value="Pleasantville"  >Pleasantville</option>

                              <option value="Port Elizabeth"  >Port Elizabeth</option>

                              <option value="Port Norris"   >Port Norris</option>

                              <option value="Rio Grande"  >Rio Grande</option>

                              <option value="Sea Isle City"   >Sea Isle City</option>
							  
                              <option value="Seapointe Village"   >Seapointe Village</option>
							  
                              <option value="Seaville"   >Seaville</option>

                              <option value="Shaw Crest"  >Shaw Crest</option>

                              <option value="Somers Point"  >Somers Point</option>

                              <option value="South Dennis"   >South Dennis</option>

                              <option value="South Seaville"   >South Seaville</option>

                              <option value="Stone Harbor"   >Stone Harbor</option>

                              <option value="Stone Harbor Manor"   >Stone Harbor Manor</option>

                              <option value="Strathmere"   >Strathmere</option>

                              <option value="Swainton"   >Swainton</option>

                              <option value="Townbank"   >Townbank</option>

                              <option value="Tuckahoe"   >Tuckahoe</option>

                              <option value="Ventnor"   >Ventnor</option>

                              <option value="Villas"   >Villas</option>

                              <option value="West Cape May"   >West Cape May</option>

                              <option value="West Wildwood"   >West Wildwood</option>

                              <option value="Whitesboro"   >Whitesboro</option>

                              <option value="Wildwood"  >Wildwood</option>

                              <option value="Wildwood Crest"   >Wildwood Crest</option>

                              <option value="Woodbine"   >Woodbine</option>

                              </select>

                            </span></td>

                          <td width="94" align="center" valign="middle">
						  
						  <p><a href="#" onclick="listbox_moveacross('pSearchCities[]', 'pSearch[]')"

						  onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('add','','images/add2.jpg',1)">
						  
						  
	<img src="images/add.jpg" alt="Add" width="80" height="20" id="add" /></a>
						  
	  </p>

		<p><a href="#" onclick="listbox_moveacross('pSearch[]', 'pSearchCities[]')" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('remove','','images/remove2.jpg',1)"><img src="images/remove.jpg" alt="Remove" width="80" height="20" id="remove" /></a></p></td>

	  <td width="166" align="center"><span class="spacing">

		<select name="pSearch[]" size="0" multiple="multiple" class="form-select"  id='pSearch[]' style="height:180px">


		</select>

                            </span></td>

                          </tr>

                      </table></td>

                      <td width="246" valign="top">
					  
					  <table width="246" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                          <td width="246"><u><strong>PROPERTY TYPE:</strong></u></td>

                          </tr>

                        <tr>

                          <td><img src="images/t.gif" width="13" height="13" /></td>

                          </tr>

                        <tr>

                          <td class="spacing">
						  
				<?php	  
				$amenitArray = explode(",",$_GET['Type']);
				$ii=0;	
				for($kkk=0;$kkk<count($amenitArray); $kkk++) {

				if($amenitArray[$kkk]=='Single Family') { $checkboxckd1='checked="checked"'; }
				if($amenitArray[$kkk]=='CONDO') { $checkboxckd2='checked="checked"'; }
				if($amenitArray[$kkk]=='TOWNHOUSE') { $checkboxckd3='checked="checked"'; }
				if($amenitArray[$kkk]=='MULTI-FAMILY') { $checkboxckd4='checked="checked"'; }
				if($amenitArray[$kkk]=='Modular/Mobile') { $checkboxckd5='checked="checked"'; }
				if($amenitArray[$kkk]=='LOTS/LAND') { $checkboxckd6='checked="checked"'; }
				if($amenitArray[$kkk]=='COMMERCIAL/INDUSTRIAL') { $checkboxckd7=$amenitArray[$kkk]; }

				$ii=$ii+1;
				}				
				if($_GET['Type']==''){
					
					$checkboxckd1='checked="checked"';
					$checkboxckd2='checked="checked"';
					$checkboxckd3='checked="checked"';					
				}				
				?>

			  <input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="Single Family" <?php echo $checkboxckd1;?>/>

				Single Family<br />

				<input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="CONDO" <?php echo $checkboxckd2;?> /> 

				Condominium<br />

				<input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="TOWNHOUSE"  <?php echo $checkboxckd3;?>/> 

				Townhouse<br />

				<input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="MULTI-FAMILY"  <?php echo $checkboxckd4;?>/> 

				Multi Family<br />

				<input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="Modular/Mobile"  <?php echo $checkboxckd5;?>/> 

				Modular / Mobile<br />

				<input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="LOTS/LAND" <?php echo $checkboxckd6;?> /> 

				Lot / Land<br />

				<input name="propertycheckbox[]" type="checkbox" id="propertycheckbox[]" value="COMMERCIAL/INDUSTRIAL"  <?php echo $checkboxckd7;?>/> 

				Commercial / Industrial
				
				</td>

			  </tr>

		  </table></td>

                      <td width="350" valign="top">
					  
					  
					  <table width="350" border="0" cellspacing="0" cellpadding="0">

                        <tr>

                          <td colspan="2"><u><strong>PROPERTY FEATURES</strong></u></td>

                          </tr>

                        <tr>

                          <td colspan="2"><img src="images/t.gif" width="13" height="13" /></td>

                          </tr>

                        <tr>

                          <td width="150"><strong>Minimum Price</strong></td>

                          <td width="200"><strong>Maximum  Price</strong></td>

                          </tr>

                        <tr>

                          <td colspan="2"><img src="images/t.gif" width="13" height="3" /></td>

                        </tr>

                        <tr>

                          <td>
						  
				<select size="1" name="MinPrice" id="MinPrice" class="form-select">

                            <option value="0">No Minimum</option>

                            <option value="100000">$100,000 </option>

                            <option value="150000"    >$150,000 </option>

                            <option value="200000"    >$200,000 </option>

                            <option value="250000"    >$250,000 </option>

                            <option value="300000"    >$300,000 </option>

                            <option value="350000"    >$350,000 </option>

                            <option value="400000"    >$400,000 </option>

                            <option value="450000"    >$450,000 </option>

                            <option value="500000"    >$500,000 </option>

                            <option value="750000">$750,000</option>

                            <option value="1000000"   >$1,000,000</option>

                            <option value="2000000"   >$2,000,000</option>

                            <option value="3000000"   >$3,000,000</option>

                          </select></td>

                          <td>
						  
						  <select size="1" name="MaxPrice" id="MaxPrice" class="form-select">

                            <option value="99999999">No Maximum</option>

                            <option value="100000">$100,000</option>

                            <option value="150000">$150,000</option>

                            <option value="200000">$200,000</option>

                            <option value="250000">$250,000</option>

                            <option value="300000">$300,000</option>

                            <option value="350000">$350,000</option>

                            <option value="400000">$400,000</option>

                            <option value="450000">$450,000</option>

                            <option value="500000">$500,000</option>

                            <option value="750000">$750,000</option>

                            <option value="1000000">$1,000,000</option>

                            <option value="2000000">$2,000,000</option>

                            <option value="3000000">$3,000,000</option>

                          </select></td>

                        </tr>

                        <tr>

                          <td colspan="2"><img src="images/t.gif" width="13" height="20" /></td>

                        </tr>

                        <tr>

                          <td><strong>Minimum Bedrooms</strong></td>

                          <td><strong>Maximum Bedrooms</strong></td>

                        </tr>

                        <tr>

                          <td colspan="2"><img src="images/t.gif" width="13" height="3" /></td>

                        </tr>

                        <tr>

                          <td><span style="width:50%">

                            <select id="selbedsmin" name="selbedsmin">

                              <option value="" selected="selected">No Preference</option>

                              <option value="0">Studio</option>

                              <option value="1">1</option>

                              <option value="2">2</option>

                              <option value="3">3</option>

                              <option value="4">4</option>
							  
                              <option value="5">5</option>

                            </select>

                          </span></td>

                          <td><span style="width:50%">

                            <select id="selbedsmax" name="selbedsmax">

                              <option value="" selected="selected">No Preference</option>

                              <option value="0">Studio</option>

                              <option value="1">1</option>

                              <option value="2">2</option>

                              <option value="3">3</option>

                              <option value="4">4</option>
							  
                              <option value="5">5</option>
							  
                              <option value="6">6</option>
							  
                              <option value="7">7</option>

                            </select>

                          </span></td>

                        </tr>

                        <tr>

                          <td colspan="2"><img src="images/t.gif" width="13" height="20" /></td>

                        </tr>

                        <tr>

                          <td><strong>Bank Owned</strong></td>

                          <td><strong>List By</strong></td>

                        </tr>

                        <tr>

                          <td colspan="2"><img src="images/t.gif" width="13" height="3" /></td>

                        </tr>

                        <tr>

                          <td><span style="width:50%">

                            <select id="foreclosure" name="foreclosure">

                              <option value="">No Preference</option>

                              <option value="Yes">Yes</option>

                              <option value="No">No</option>

                            </select>

                          </span></td>

                          <td>
						  
		  <select size="1" name="sortby" id="sortby" class="form-select">

			<option value="asc">Low To High</option>

			<option value="desc" selected="selected">High To Low</option>

		  </select>
						  
						  </td>

                        </tr>

				<tr>

				  <td colspan="2"><img src="images/t.gif" width="13" height="20" /></td>

				</tr>

			  </table></td>

			  </tr>

			<tr>

			  <td colspan="3" valign="top"><img src="images/t.gif" width="13" height="13" /></td>

			  </tr>

		<tr>
		  <input type="hidden" id="search_properties" name="search_properties" value="search_mlsadvance" />

		  <td colspan="3" valign="top">
					  
					  
	<input type="hidden" id="btnsubmit" name="btnsubmit"  value="listsubmit" />

	 <a href="javascript:void(0);" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('search_properties','','images/searchproperties2.png',1)">
	 
	<img onclick="return submitform();" src="images/searchproperties.png" width="400" height="43" alt="Search Properties For Sale" id="search_properties" name="search_properties" border="0" style="cursor:pointer;"/></a>			  

		</td>
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

        <td><table width="258" border="0" align="center" cellpadding="0" cellspacing="0">

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

            <td width="8"><img src="images/t.gif" width="8" height="30" /></td>

            <td width="30"><a href="https://instagram.com/cabrera_coastal_real_estate/" target="_blank"><img src="images/instagram-bottom.jpg" width="30" height="30" border="0" /></a></td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td><img src="images/t.gif" width="10" height="8" /></td>

      </tr>

    </table></td>

  </tr>

</form>

<?php

	$_SESSION['TOWNS'] = "";

	$_SESSION['PROPERTIES'] = "";

	$_SESSION['MINPRICE'] = "";

	$_SESSION['MAXPRICE'] = "";

	$_SESSION['BEDS'] = "";

	$_SESSION['BATHS'] = "";

	$_SESSION['FORECLOSURE'] = "";

	$_SESSION['SORTBY'] = "";

	$_SESSION['SOLD'] = "";

?>

  <script>

  document.getElementById('MinPrice').value = "<?php echo $search_minprice;?>";

  document.getElementById('MaxPrice').value = "<?php echo $search_maxprice;?>";

  document.getElementById('selbedsmin').value = "<?php echo $selbedsmin;?>";

  document.getElementById('selbedsmax').value = "<?php echo $selbedsmax;?>";

  document.getElementById('foreclosure').value = "<?php echo $search_foreclosure;?>";

  document.getElementById('sortby').value = "<?php echo $search_sortby;?>";

  document.getElementById('status').value = "<?php echo $search_sold;?>";

  
  ff = document.getElementsByName('propertycheckbox[]');

  var ln = ff.length;

  sellengh = <?php echo count($search_properties1);?>;

  <?php $kk =0; ?>;

  for(h=0;h<ln;h++){

  	<?php 

  	for($k=1;$k<=count($search_properties1);$k++){

  	?>

  		gg = '<?php echo $search_properties1[$k-1];?>';

  		if(ff[h].value == gg){

  			ff[h].checked = true;

  		}
  	<?php }	?>

  }



	if('<?php echo $search_properties1[0];?>' == 0){

		for(h=0;h<1;h++){

			ff[h].checked = true;

		}

	}
	var src=document.getElementById('pSearchCities[]');

    for(var count1=0;count1<src.options.length;count1++) {

		<?php for($k=1;$k<=count($search_towns);$k++){ ?>

  				ss = '<?php echo  $search_towns[$k-1];?>';

  				if(src.options[count1].value == ss){

  					src.options[count1].selected=true;

  					listbox_moveacross('pSearchCities[]','pSearch[]');

  				}
        		

		<?php }	?>

	}
</script>

</table>

</body><?php require_once('googletagmanager.php'); ?>

<?php if($_GET['Town']!=''){
	
$Townarray = explode(",",$_GET['Town']);

$ii=0;	
for($kkk=0;$kkk<count($Townarray); $kkk++) {
	
?><script>

	jQuery(document).ready(function($){
		
	  $('select').find("option[value='<?php echo $Townarray[$kkk];?>']").attr('selected','selected');
	  
	});	
</script>

<?php 
$ii=$ii+1;
}
?> <script>
 	jQuery(document).ready(function($){
		
	listbox_moveacross('pSearchCities[]', 'pSearch[]');
	  
	});
	
</script><?php } else { ?><script>

jQuery(document).ready(function($){
	
  $('select').find("option[value='Diamond Beach']").attr('selected','selected');
  $('select').find("option[value='Wildwood Crest']").attr('selected','selected');
  $('select').find("option[value='Wildwood']").attr('selected','selected');
  $('select').find("option[value='North Wildwood']").attr('selected','selected');
  $('select').find("option[value='Stone Harbor']").attr('selected','selected');
  $('select').find("option[value='Avalon']").attr('selected','selected');
  
  listbox_moveacross('pSearchCities[]', 'pSearch[]');
  
});</script><?php } ?>

</html>

<?php 
$_SESSION['searchtype']='';
?>