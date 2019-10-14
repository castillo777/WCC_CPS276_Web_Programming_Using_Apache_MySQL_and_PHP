<?
session_start();
require_once ('../shared/db_2.php');

$login = isset($_SESSION['login']) ? $_SESSION['login'] : NULL; 
$login = isset($_REQUEST['login']) ? $_REQUEST['login'] : $login;

$logout = isset($_SESSION['logout']) ? $_SESSION['logout'] : NULL; 
$logout = isset($_REQUEST['logout']) ? $_REQUEST['logout'] : $logout;

$username = isset($_SESSION['username']) ? $_SESSION['username'] : ''; 
$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : $username;

if (isset($login)) {
    $_SESSION['username'] = $username;
} elseif (isset($logout)) {
    unset($_SESSION['username']);
}

$name = isset($_SESSION['name']) ? $_SESSION['name'] : ''; 
$name = isset($_REQUEST['name']) ? $_REQUEST['name'] : $name;

$player1 = isset($_SESSION['player1']) ? $_SESSION['player1'] : '';
$player1 = isset($_REQUEST['player1']) ? $_REQUEST['player1'] : $player1;

$player2 = isset($_SESSION['player2']) ? $_SESSION['player2'] : '';
$player2 = isset($_REQUEST['player2']) ? $_REQUEST['player2'] : $player2;

$startDate = isset($_SESSION['startDate']) ? $_SESSION['startDate'] : ''; 
$startDate = isset($_REQUEST['startDate']) ? $_REQUEST['startDate'] : $startDate;

$endDate = isset($_SESSION['endDate']) ? $_SESSION['endDate'] : ''; 
$endDate = isset($_REQUEST['endDate']) ? $_REQUEST['endDate'] : $endDate;

$viewID = isset($_REQUEST['viewID']) ? $_REQUEST['viewID'] : 0;
$viewID = isset($_REQUEST['viewID']) ? $_REQUEST['viewID'] : $viewID;

$pressedBack = isset($_REQUEST['back']);
     
$startingDate = convertDate1($startDate);
$endingDate = convertDate1($endDate);

if (!empty($viewID)) {
    $sql = "SELECT * FROM matches WHERE id = ?";
    $args = array();
    $args[] = $viewID;
    $results = execute($sql, true, $args);
        
    if (empty($results)) {
        echo("Record not found.");
        exit();
    }
        
    $record = $results[0];
    require_once("view2.php");
    exit();    
}

if ((!empty($name)) && empty($startDate) && empty($endDate)) {
    $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE (player1 LIKE ? OR player2 LIKE ?) LIMIT 25";
    $args = array();
    $args[] = '%' . $name . '%';
    $args[] = '%' . $name . '%';
    $results = execute($sql, true, $args);
} elseif (!empty($name) && (!empty($startDate)) && empty($endDate)) {
    $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE ((player1 LIKE ? OR player2 LIKE ?) AND (matchDate >= ?)) LIMIT 25";
    $args = array();
    $args[] = '%' . $name . '%';
    $args[] = '%' . $name . '%';
    $args[] = $startingDate;
    $results = execute($sql, true, $args);
} elseif (!empty($name) && empty($startDate) && (!empty($endDate))) {
    $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE ((player1 LIKE ? OR player2 LIKE ?) AND (matchDate <= ?)) LIMIT 25";  
    $args = array();
    $args[] = '%' . $name . '%';
    $args[] = '%' . $name . '%';
    $args[] = $endingDate;
    $results = execute($sql, true, $args);
} elseif ((!empty($name)) && (!empty($startDate)) && (!empty($endDate))) {
    $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE ((player1 LIKE ? OR player2 LIKE ?) AND (matchDate BETWEEN ? AND ?)) LIMIT 25";        
    $args = array();
    $args[] = '%' . $name . '%';
    $args[] = '%' . $name . '%';
    $args[] = $startingDate;
    $args[] = $endingDate;
    $results = execute($sql, true, $args);
} elseif (empty($name) && (!empty($startDate)) && (!empty($endDate))) {
    $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE (matchDate BETWEEN ? AND ?) LIMIT 25";        
    $args = array();
    $args[] = $startingDate;
    $args[] = $endingDate;
    $results = execute($sql, true, $args);
} elseif (empty($name) && (!empty($startDate)) && empty($endDate)) {
    $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE (matchDate >= ?) LIMIT 25";        
    $args = array();
    $args[] = $startingDate;
    $results = execute($sql, true, $args);
} elseif (empty($name) && empty($startDate) && (!empty($endDate))) {
    $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE (matchDate <= ?) LIMIT 25";        
    $args = array();
    $args[] = $endingDate;
    $results = execute($sql, true, $args);
} else {
    $sql = "SELECT event,player1,player2,matchDate,id FROM matches LIMIT 25";    
    $results = execute($sql, true);
}

require_once("view1.php");
