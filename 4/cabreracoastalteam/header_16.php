<?php
	session_start();
	require_once('config.php');
	$res_page=mysql_fetch_array(mysql_query("select *  from tbl_header_text"));
	$headervalue = $res_page['header_text'];
	$headervalue = str_replace('../','',$headervalue);
?><head>
 <style type="text/css" media="screen">
 
 .horizontalmenu ul { padding:1; margin:1; list-style:none; z-index:20;}
 .horizontalmenu li { height:29px;float:left; position:relative; padding-right:100; display:block;font-size:18px;margin-right:1.73em;} 
 .horizontalmenu li ul { display:none; position:absolute;margin-top:6px; } 
 .horizontalmenu li:hover ul{ height:24px; display:block;height:auto; background:rgba(48,108,180,0.8);position:absolute;} 
 .horizontalmenu li ul li{ height:24px; margin-left:-30px; border-style:none;font-size:16px;white-space:nowrap;background:url(images/dropdownarrow.png) no-repeat left;} 
 .horizontalmenu li ul li a{ color:#fff;text-decoration:none;}
 </style> 
</head>
<?php echo $headervalue; ?>
  <tr>
    <td><table width="1121" border="0" align="center" cellpadding="0" cellspacing="0">
       <tr>
        <td style="width:10px;"><img src="images/navleft.png" width="" height="34" /></td>
        <td width="1101" align="center" class="" background="images/navbg.png" style="padding-left:2px;">
        <div class="horizontalmenu" style="margin-top:-9px;"> 
        <ul>
        <li style="margin-left:-8px;"><a href="index.php" class="whitelink">HOME</a></li> 
        <li style="height:29px;"><a href="javascript:;" class="whitelink" >SALES 
        <ul> 
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
		
		<li> <a href="javascript:;" class="whitelink">RENTALS</a>
        <ul> 
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
		<li><a href="javascript:;" class="whitelink">MEET THE TEAM</a>
        <ul> 
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
		<li><a href="javascript:;" class="whitelink">PROPERTY MANAGEMENT</a> 
        <ul> 
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
        <td width="10"><img src="images/navright.png" width="10" height="34" /></td>
      </tr>
    </table></td>
  </tr>
