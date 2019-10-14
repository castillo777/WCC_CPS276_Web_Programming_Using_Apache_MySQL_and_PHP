<?
$presidents = array();
$presidents[] = array('first'=>'George','last'=>'Washington');
$presidents[] = array('first'=>'George','last'=>'Bush');
$presidents[] = array('first'=>'Jimmy','last'=>'Carter');

$str = json_encode($presidents); //takes an array and returns it as a string
//echo($str);
//$arr = json_decode($str);

//$data = file_get_contents('xx.txt');
//$data = file_get_contents('http://apple.com');
//$data = file_get_contents('http://sites.wccnet.edu');
echo($str);
?>