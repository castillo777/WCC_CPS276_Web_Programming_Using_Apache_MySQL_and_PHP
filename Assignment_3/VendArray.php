<?
$presidents = array();
$presidents[] = array('first'=>'George','last'=>'Washington');
$presidents[] = array('first'=>'John','last'=>'Adams');
$presidents[] = array('first'=>'Thomas','last'=>'Jefferson');
$presidents[] = array('first'=>'James','last'=>'Madison');
$presidents[] = array('first'=>'James','last'=>'Monroe');
$presidents[] = array('first'=>'John Q.','last'=>'Adams');
$presidents[] = array('first'=>'Andrew','last'=>'Jackson');
$presidents[] = array('first'=>'Martin','last'=>'Van Buren');
$presidents[] = array('first'=>'William','last'=>'Harrison');
$presidents[] = array('first'=>'John','last'=>'Tyler');

$str = json_encode($presidents); //takes an array and returns it as a string
//echo($str);
//$arr = json_decode($str);

//$data = file_get_contents('xx.txt');
//$data = file_get_contents('http://apple.com');
//$data = file_get_contents('http://sites.wccnet.edu');
echo($str);