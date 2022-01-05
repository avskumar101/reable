<?php
// The following three lines must be at the top of  your script. 
session_start();

define('CAPTCHA_PATH', $_SERVER['DOCUMENT_ROOT'].'/cp/captcha/'); // Path to captcha
require_once(CAPTCHA_PATH.'captcha.php');


// The following is an HTML demo
print   '<h1>CAPTCHA</h1>'."\n";
		
// Validation section

if(isset($_POST['captcha'])){
	if(captcha_validate()){
		print '<p>Success! <br>You entered the correct code! <br><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'">Here\'s another one to try!</a></p>';
	}else{
		print '<p>Failure! <br>You entered the wrong code! <br><a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'">Here\'s another one to try!</a></p>';
	}
    

    
    
    
// Form section    
}else{
print   '<div style="float: left;"><img id="mainimage" style="border: 1px solid #555;" src="http://'.$_SERVER['HTTP_HOST'].
		$_SERVER['PHP_SELF'].'?image" width="140" height="90" alt="CAPTCHA image">'."\n".
        '<br>I can\'t read that image...<br>'."\n".
        '<a href="#" onclick="document.getElementById(\'mainimage\').src=\'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?image=\' + new Date; return false;">give me an easier one!</a>'."\n".
        '</div><form style="margin-top: 0; margin-bottom: 3px;" action="http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'" method="post">'."\n".
        '<input type="text" name="captcha" style="width: 100px; height: 24px; margin-top: 5px; border: 1px solid #555; margin-left: 10px; text-align: center;">'."\n".
        '<span style="color: red;">*</span> <i>case sensitive</i><br>'."\n".
        '<input type="submit" name="submit" value="try me" style="width: 100px; height: 24px; margin-left: 10px; margin-top: 5px;">'."\n".
        '</form><br><br><br><br>'."\n".
        
        '<div style="clear: both"><p> <a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?audio">CAPTCHA code in audio form</a>'."\n".
        ' (.wav file, typically 60kB)</div>'."\n";
}

?>