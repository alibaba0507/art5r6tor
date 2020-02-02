<?php

// Article Creator Script
// This script can grab articles from any keyword and rewrite them to unique articles
// Author: FullContentRSS.com
// Script URL: http://articlecreator.fullcontentrss.com
if(!session_id()) session_start();
require_once(dirname(__FILE__).'/config.php');
$user = ""; //prevent the "no index" error from $_POST
$pass = "";
if (isset($_POST['user'])) { // check for them and set them so
    $user = $_POST['user'];
}
if (isset($_POST['pass'])) { // so that they don't return errors
    $pass = $_POST['pass'];
}    

?><!DOCTYPE html>
<html>
  <head>
   <?php include('./html_tmp/head.php');?>
  </head>
  <body>
	<?php include('./html_tmp/body_top.php');?>
    <?php
	if ($user == 'alibaba0507' && $pass == 'Alida1$#@!') {
     $_SESSION['user'] = 'alibaba0507';
     $_SESSION['pass'] = 'Alida1$#@!';
    // the password verify is how we actually login here
    // the $userhash and $passhash are the hashed user-entered credentials
    // password verify now compares our stored user and pw with entered user and pw

    //include ("pass-admn.php");
     include('./html_tmp/from.php');  

} else { 
    // if it was invalid it'll just display the form, if there was never a $_POST
    // then it'll also display the form. that's why I set $user to "" instead of a $_POST
    // this is the right place for comments, not inside html
    ?>  
    <form method="POST" action="index_admn.php">
    User <input type="text" name="user"></input><br/>
    Pass <input type="password" name="pass"></input><br/>
    <input type="submit" name="submit" value="Go"></input>
    </form>
    <?php } ?>
 	<!-- ?php include ("./html_tmp/tabs.php"); ? -->
	<br /><?php include ("./html_tmp/footer.php"); ?>

	</div>
  </body>
</html>