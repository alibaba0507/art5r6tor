<?php

require_once("accesskey.php");
ini_set('display_errors', 'On');
error_reporting(E_ALL);
error_log("WE ARE AT PayPal Payment ");
// STEP 1: read POST data
// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
// Instead, read raw POST data from the input stream. 
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}
 
// Step 2: POST IPN data back to PayPal to validate
$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0)
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// In wamp-like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set 
// the directory path of the certificate as shown below:
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if( !($res = curl_exec($ch)) ) {
     error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
//error_log(" Processing IPN data [".$res."]");
if (strcmp ($res, "VERIFIED") == 0) {
 
// PAYMENT VALIDATED & VERIFIED!
 $email = $_POST['payer_email'];
 $token = generateactivationtoken();
 $res = addToken($email,$token);
 if ($res == -1) 
 {
	 // invalid email, this should not happend
 }else
 { // process send email.
	$exp = date('Y-m-d',checkForUserEmail($email,"Y"));
    $to      = $email;
  $subject = 'Access Key from articlecreator.theprofitwebmaster.org';
      $message = '
		 
		Thank you for your purchase

		Your account information
		-------------------------
		Email: '.$email.'
		token: '.$token.'
		valid till:'.$exp.'
		-------------------------
		 You can now login at http://articlecreator.theprofitwebmaster.org/
		 please keep this email cause we can not reissue new tokens. On event of
		 loosing your token we will try to recover.
		 if this is not you please ignore this email.';
	$headers = 'From:info@articlecreator.theprofitwebmaster.org' . "\r\n";
  error_log("// ******************* Send Email ******************");
  error_log($message);
  mail($to, $subject, $message, $headers);
 }
}
 
else if (strcmp ($res, "INVALID") == 0) {
 
// PAYMENT INVALID & INVESTIGATE MANUALY!
 $to      = 'fx2go4u@gmail.com';
$subject = 'articlecreator.theprofitwebmaster.org | Invalid Payment';
$message = '
 
Dear Administrator,
 
A payment has been made but is flagged as INVALID.
Please verify the payment manualy and contact the buyer.
 
Buyer Email: '.$email.'
';
$headers = 'From:info@articlecreator.theprofitwebmaster.org' . "\r\n";
  error_log("// ******************* Send Payment FAIL Email ******************");
  error_log($message);
mail($to, $subject, $message, $headers);
}
curl_close($ch);