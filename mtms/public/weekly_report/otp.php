<?php
 $ph_num="9679662070";
$code="abc44AAS";
echo $ph_num.$code;
	$sender = "MTICDS";
	$numbers =$ph_num;
    $message = $code . " is your One Time Password (OTP) for verification,please OTP to proceed MTMICDS,Jalpaiguri.";
	$message = urlencode($message);
    $data = "username=ICDSOTP&api_key=97bcdb2e220ef8819ab0399e39c725d9&sender=MTICDS&to=$numbers&message=$message";
	$ch = curl_init('http://msg.infoskysolutions.com/API/WebSMS/Http/v2.3.6/api.php?');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); // This is the result from the API
	echo $result;
	curl_close($ch);
    if (substr_compare($result, "success", 0, 7, true) == 0)
    {
        alert("success");
    }
}
?>