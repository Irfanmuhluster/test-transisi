
<?php

function Counts($str)
{

	$hurufkecil = 0;
    $hurufbesar = 0;
	for ($i = 0; $i < strlen($str); $i++)
	{
		 if ($str[$i] >= 'a' && $str[$i] <= 'z') {
			$hurufkecil++;
         } else {
			$hurufbesar++;
		 }
	}
    
	echo "banyak huruf kecil : " ,$hurufkecil,"\n" ;
}

	$str = "TranSISI";
	Counts($str);
?> 
