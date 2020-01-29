<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once(dirname(__FILE__).'/utils/utils.php'); // for debug call  debug($msg,$obj)

if ($_POST["article"])
{
    $article1 = $_POST["article"];
    $article = urldecode($article1);
     debug(">>>>>>>> CALL FORM AJAX [" .$article . "] <<<<<<<<<");
     $source = $article;
     include 'unike.php';
     echo $article;
}else
{
     echo "NO POST DATA<br>";
}

?>