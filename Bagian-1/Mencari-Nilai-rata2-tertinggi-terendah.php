<?php
// Buatlah sebuah PHP script untuk menentukan (1) nilai rata-rata, (2) 7 nilai tertinggi, (3) 7 nilai terendah
$nilai = [72,65,73,78,75,74,90,81,87,65,55,69,72,78,79,91,100,40,67,77,86];

// function
function calculate($arr) {
    $count = count($arr); 
    $total = 0;
    foreach ($arr as $value) {
        $total = $total + $value; 
    }
    $average = ($total/$count); 

   
    
    echo "1. Nilai Rata-rata = " . $average . "</br>";
    
    sort($arr);

    // 
    echo "2. 7 Nilai Tertinggi : ";       
    for($i = count($arr) - 7; $i < count($arr); $i++)
    {
        echo "$arr[$i], ";
    }
    echo "<br>";

    // 7 nilai terendah
    echo "3. 7 Nilai Terendah : ";
    for($i = 0; $i < 7; $i++)
    {
        echo "$arr[$i], ";
    }
    echo "<br>"; 

}

calculate($nilai);

?>


?>