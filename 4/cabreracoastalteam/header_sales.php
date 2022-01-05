<?php
	session_start();
	require_once('config.php');
	$res_page=mysql_fetch_array(mysql_query("select *  from tbl_header_text"));
	$headervalue = $res_page['header_text'];
	//$headervalue = str_replace('../','',$headervalue);
?><head>
 <style type="text/css" media="screen">
 
 .horizontalmenu ul { padding:1; margin:1; list-style:none; }
 .horizontalmenu li { float:left; position:relative; padding-right:100; display:block;font-size:18px;margin-right:1.73em;} 
 .horizontalmenu li ul { display:none; position:absolute;margin-top:4px; } 
 .horizontalmenu li:hover ul{ display:block;height:auto; background:rgba(48,108,180,0.8);position:absolute;} 
 .horizontalmenu li ul li{ margin-left:-30px; border-style:none;font-size:16px;white-space:nowrap;background:url(../images/dropdownarrow.png) no-repeat left;} 
 .horizontalmenu li ul li a{ color:#fff;text-decoration:none;}
 </style> 
</head>
<?php echo $headervalue; ?>
  <tr>
    <td><table width="1121" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
        <td style="width:10px;"><img src="../images/navleft.png" width="" height="34" /></td>
        <td width="1101" align="center" class="" background="../images/navbg.png" style="padding-left:2px;">
        <div class="horizontalmenu" style="margin-top:-9px;"> 
        <ul>
        <li style="margin-left:-8px;"><a href="index.php" class="whitelink">HOME</a></li> 
        <li style="height:29px;"><a href="javascript:;" class="whitelink" >SALES 
        <ul> 
		<li><a href="mls.php" style="margin-left:15px;">SEARCH MLS </a></li> 
		<li><a style="margin-left:15px;" href="results.php">CABRERA LISTINGS </a></li> 
		<li><a style="margin-left:15px;" href="results.php">LONG & FOSTER LISTINGS </a></li> 
		<li><a style="margin-left:15px;" href="results.php">FORECLOSURES</a></li> 
		<li><a style="margin-left:15px;" href="sold.php">SOLD PROPERTIES </a></li> 
		<li><a style="margin-left:15px;" href="listsales.php">LIST YOUR PROPERTY </a></li>
		
		<?php 
			$resultarrays = mysql_query("SELECT * FROM tbl_web_subpage WHERE main_link ='SALES' and delete_status!=1"); 
			$i=1;
			while($info = @mysql_fetch_array($resultarrays))
			{
			?>
				<li><a style="margin-left:15px;" href="<?php echo $info['pagelink']; ?>"><?php echo $info['pagename']; ?></a></li>
			<?php
				$i=$i+1;
			}
		?>
		</ul>
		</li>
		<li><a href="javascript:;" class="whitelink">SEARCH TOWNS / EVENTS</a> 
        <ul> 
		<li><a href="capemayrealestate.php" style="margin-left:15px;">CAPE MAY  </a></li> 
		<li><a style="margin-left:15px;" href="diamondbeachproperties.php">DIAMOND BEACH  </a></li> 
		<li><a style="margin-left:15px;" href="wildwoodcrestproperties.php">WILDWOOD CREST  </a></li> 
		<li><a style="margin-left:15px;" href="wildwoodrealestate.php">WILDWOOD</a></li> 
		<li><a style="margin-left:15px;" href="westwildwoodhomes.php">WEST WILDWOOD  </a></li> 
		<li><a style="margin-left:15px;" href=" northwildwoodproperties.php">NORTH WILDWOOD  </a></li> 
		<li><a style="margin-left:15px;" href="lowertownshiprealestate.php">LOWER TOWNSHIP   </a></li>
		<li><a style="margin-left:15px;" href=" middletownshiphomes.php">MIDDLE TOWNSHIP   </a></li> 
		<?php 
			$resultarrays = mysql_query("SELECT * FROM tbl_web_subpage WHERE main_link ='CAPE MAY COUNTY' and delete_status!=1"); 
			$i=1;
			while($info = @mysql_fetch_array($resultarrays))
			{
			?>
				<li><a style="margin-left:15px;" href="<?php echo $info['pagelink']; ?>"><?php echo $info['pagename']; ?></a></li>
			<?php
				$i=$i+1;
			}
		?>
		</ul>
		</li>
		
		<li> <a href="vacationrentals.php" class="whitelink">RENTALS</a>
        <ul> 
		<li><a href="vacationrentals.php" style="margin-left:15px;">RENTAL SEARCH </a></li> 
		<li><a style="margin-left:15px;" href="listrental.php">LIST YOUR RENTAL  </a></li> 
		<?php 
			$resultarrays = mysql_query("SELECT * FROM tbl_web_subpage WHERE main_link ='RENTALS' and delete_status!=1"); 
			$i=1;
			while($info = @mysql_fetch_array($resultarrays))
			{
			?>
				<li><a style="margin-left:15px;" href="<?php echo $info['pagelink']; ?>"><?php echo $info['pagename']; ?></a></li>
			<?php
				$i=$i+1;
			}
		?>
		</ul>
		</li>
		<li><a href="team.php" class="whitelink">MEET THE TEAM</a>
        <ul> 
		<li><a href="team.php" style="margin-left:15px;">OUR TEAM  </a></li> 
		<li><a style="margin-left:15px;" href="testimonials.php">TESTIMONIALS   </a></li> 
		<?php 
			$resultarrays = mysql_query("SELECT * FROM tbl_web_subpage WHERE main_link ='MEET THE TEAM' and delete_status!=1"); 
			$i=1;
			while($info = @mysql_fetch_array($resultarrays))
			{
			?>
				<li><a style="margin-left:15px;" href="<?php echo $info['pagelink']; ?>"><?php echo $info['pagename']; ?></a></li>
			<?php
				$i=$i+1;
			}
		?>
		</ul>
		</li>
		<li><a href="propertymanagement.php" class="whitelink">PROPERTY MANAGEMENT</a> 
        <ul> 
		<li><a href="propertymanagement.php" style="margin-left:15px;">PROPERTY MANAGEMENT   </a></li> 
		<li><a style="margin-left:15px;" href="homerepair.php">HOME REPAIR   </a></li> 
		<?php 
			$resultarrays = mysql_query("SELECT * FROM tbl_web_subpage WHERE main_link ='PROPERTY MANAGEMENT' and delete_status!=1"); 
			$i=1;
			while($info = @mysql_fetch_array($resultarrays))
			{
			?>
				<li><a style="margin-left:15px;" href="<?php echo $info['pagelink']; ?>"><?php echo $info['pagename']; ?></a></li>
			<?php
				$i=$i+1;
			}
		?>
		</ul>
		</li>
		<li><a href="contact.php" class="whitelink">CONTACT US</a></li>
		</ul>
		</div>
		</td>
        <td width="10"><img src="../images/navright.png" width="10" height="34" /></td>
      </tr>
    </table></td>
  </tr>
