<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once(dirname(__FILE__).'/utils/utils.php'); // for debug call  debug($msg,$obj)

if ($_POST["article"])
{
    $article1 = $_POST["article"];
    $article = urldecode($article1);
    // debug(">>>>>>>> CALL FORM AJAX [" .$article . "] <<<<<<<<<");
     $source = $article;
     $keyword = $_POST['keyword'];
     $keywords = $_POST['keywords'];
     $urllink = $_POST['urllink'];
     include 'unike.php';
     $data = array('raw' => $rawarticle 
               ,'spin' =>  $article);
   //  debug(">>>>>>>> CALL FORM AJAX AFTER <<<<<<<<<",$data);
     //echo json_encode($data);
     echo $article;
}else
{
     echo "NO POST DATA<br>";
}

?>