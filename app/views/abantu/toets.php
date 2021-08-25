<?php 
$tebu = json_encode($data, JSON_PRETTY_PRINT);
echo $tebu;


$fp = fopen('experience.json', 'w');
fwrite($fp, $tebu);
// echo $fp;
fclose($fp);

?>