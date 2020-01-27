
	
 
<?php 
include ('index.inc');
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require_once("accesskey.php");
$email = $_POST['email'];
//error_log("// Eamil is [$email]");

 $token = generateactivationtoken();
// error_log("// Token is [$token]");
 $res = addFreeToken($email,$token);
 if ($res == -1)
 {//	error_log("Email exist u can't get free token");
    $msg = "Email exist u can't get free token";
 ?>
  <div> 
    <?php echo $msg;?>
  </div>
 <?php 
 }else
 {
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
  //error_log("// ******************* Send Email ******************");
  //error_log($message);
  mail($to, $subject, $message, $headers);
	// error_log("Email [".$email."][".$token."][".($exp)."]");
	?>
	 <div> 
  Email has been send with <b>Access Key</b> to <?php echo $email;?>.<br/>
  Please check your email in a few minutes.
  </div>
  <div>
   To go back . Please press browser back button or this page top header image
   or click <a href="/">here</a>
  </div>
	<?php 
 }
 
 
 include ('index_end.inc');
?>
