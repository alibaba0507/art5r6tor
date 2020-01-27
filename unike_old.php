<?php

//echo "We at UNIKE.PHP <br>";
$article=$source;

include 'letter_index.php';
echo "We at UNIKE.PHP AFTER INCLUDE ".strlen($article)."<br>";
$artarray=$article;
$step1 = array("(", ")", "[", "]", "?", ".", ",", "|", "\$", "*", "+", "^","{", "}");
$artarray=str_replace($step1," ",$artarray);
$artarray=str_replace("  "," ",$artarray);
$words_artarray = explode(" ",$artarray);
if (sizeof($words_artarray)>0)
{
	 for($i=0;$i<sizeof($words_artarray);$i++)
	{
		    
	  $replace=$words_artarray[$i];
	  $replace=str_replace(" ","",$replace);
		if(($replace!="")&&(strlen(trim($replace))>=4))
		{
			$replace= trim($replace);
			$searchIndex = strtoupper (substr($replace,0,1));					
			$leter_index = $letters[$searchIndex];
			if ($leter_index != "" && strlen(trim($leter_index)) > 2)
			{ // we found our index
		      $range = explode("|",$leter_index);
			  $start = $range[0];
			  $end = $range[1];
			   // if ($i < 20)
				//		echo "We found repace \"".$searchIndex."\" ".$range[0]." - ".$range[1]." <br/>";
			  for ($j = $start;$j < $end;$j++)
			  {
				  $buffer = "";
				  $pos = strpos($lines[$j], strtolower($replace)."|");
				 // The !== operator can also be used.  Using != would not work as expected
				// because the position of 'a' is 0. The statement (0 != false) evaluates 
				// to false.
				if ($pos !== false)
				{ // we found our word
				   $line_arr = explode("|",$lines[$j]);
				   fseek($fdat, $line_arr[1] ); // we seek the positon in the big file
				   $buffer = fgets($fdat, 4096); // not so important for only to get the word
				   if ($i < 20)
						echo "We found repace pos = [".$pos."][".$buffer."] at [".$line_arr[1]."] <br/>";
				   break;
				}// end if
			  }// end for ($j)
			  if (strlen($buffer) > 0)
			  {
				$replacewith = "";   
				while (substr(trim($buffer = fgets($fdat, 4096)),0,1) == '(')
				{ 
				   // but for now we will use only one synonym 
					//echo "Line is [".$buffer."]<br/>";
					$syn = explode("|",$buffer);
					$replacewith = " ".$syn[1]." ";
					if ($i < 20)
					  echo "Replace for [".$replace."] with[".$replacewith."]<br/>";
					break;
					//$buffer = fgets($fp, 4096);
				}//end while
				if(($replace!="")&&($replace!=" ")&&($replacewith!=""))
				{
					$replace=" ".$replace." ";
					$article = str_replace($replace,$replacewith,$article);
					$article = str_replace(" ".ucfirst(trim($replace))." "," ".ucfirst(trim($replacewith))." ",$article);
				} // end if(($replace!="")&&($replace!=" ")&&($replacewith!=""))
			  } //  end  if (strlen($buffer) > 0) 
			}
		}
	}// end for ($i)
}// end if (sizeof($words_artarray)>0)



$article=str_replace("\'","'",$article);
$article=str_replace('\"','"',$article);
$article=str_replace("\n\r","</p><p>",$article);
$article=str_replace("\r\n","</p><p>",$article);

?>