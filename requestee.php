<?php
session_cache_expire(1);
session_start();

function captchaText() {
	
	    $uppers = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$lowers = "abcdefghijklmnopqrstuvwxyz";
		$numbers = "01234567890123456789012345";//set numbers to length 26 like the alphabet//
		$types = array($uppers,$lowers,$numbers);
		$str = "";
		$length = 5;
		$seed = rand(0,2);
		for ($i = 0; $i < $length; $i++) {
			$o = $seed++%3;
			$str .= substr($types[$o],rand(0,25),1);
			
		
		}
        return $str;
}


if (isset($_POST['requesttype']) && $_POST['requesttype'] == 'getCaptchaString') {

	$response = array("captchaString" => captchaText());
	$_SESSION['currentCaptcha'] = $response['captchaString'];
	echo json_encode($response);

}

if (isset($_POST['requesttype']) && $_POST['requesttype'] == 'captchaCorrect' && isset($_POST['data'])) {
	
	if ($_SESSION['currentCaptcha'] == $_POST['currentCaptcha']) {
		
		$data = json_decode(urldecode(base64_decode($_POST['data'])));


		var_dump($data);
		
		?>
        
        <div ><a >Link to PDF</a></div>
        
        
        
        <?php
		
		
	} else {
		echo "nope";
	}

}


?>