<?
    session_start();
    require_once ('../shared/db.php');    
    define('TABLE_NAME', 'matches_06');
    
    $sql = NULL;
    $results = NULL;
    $record = NULL;
    
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : ''; 
    $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : $name; 
    $_SESSION['name'] = $name;
    $player1 = isset($_SESSION['player1']) ? $_SESSION['player1'] : '';
    $player1 = isset($_REQUEST['player1']) ? $_REQUEST['player1'] : $player1;
    $_SESSION['player1'] = $player1;
    $player2 = isset($_SESSION['player2']) ? $_SESSION['player2'] : '';
    $player2 = isset($_REQUEST['player2']) ? $_REQUEST['player2'] : $player2;
    $_SESSION['player2'] = $player2;
    $deleteID = isset($_REQUEST['deleteID']) ? $_REQUEST['deleteID'] : 0;     
    $viewID = isset($_REQUEST['viewID']) ? $_REQUEST['viewID'] : 0;
    $editID = isset($_REQUEST['editID']) ? $_REQUEST['editID'] : 0;  
    $pressedSave = isset($_REQUEST['save']);
    $pressedBack = isset($_REQUEST['back']);
    $pressedSearch = isset($_REQUEST['search']);

    // Clicked view details on main page
    if (!empty($viewID))
    {
        $sql = "SELECT * FROM " . TABLE_NAME . " WHERE id = $viewID";
        $results = execute($sql, true);
        
        if (empty($results)) {
            echo("Record not found.");
            exit();
        }
        
        $record = $results[0];
        require_once("view2.php");
        exit();
    }    
    // Clicked edit on main page
    elseif (!empty($editID))
    {
        $sql = "SELECT * FROM " . TABLE_NAME . " WHERE id = $editID";
        $results = execute($sql, true);
        
        if (empty($results)) {
            echo("Record not found.");
            exit();
        }
        
        $record = $results[0];
        require_once("view3.php");
        exit();
    }
    // Clicked delete on main page
    elseif (!empty($deleteID))
    {
        $sql = "DELETE FROM " . TABLE_NAME . " WHERE id = $deleteID";
        execute($sql, false);
    } 
    // Clicked save on edit page
    elseif ($pressedSave)
    {   
        $eventID = isset($_REQUEST['eventID']) ? $_REQUEST['eventID'] : 0;
        addslashes($player1);
        addslashes($player2);
            
        $sql = "UPDATE " . TABLE_NAME . " SET player1 = '$player1', player2 = '$player2' WHERE id = $eventID";
        execute($sql, false);
    }
    
    // Clicked search on main page
    if ((!empty($name)) || ((!empty($deleteID)) || $pressedSearch || $pressedSave || $pressedBack)) {
        $sql = "SELECT event,player1,player2,matchDate,id FROM " . TABLE_NAME . " WHERE (player1 LIKE '%$name%' OR player2 LIKE '%$name%') LIMIT 25";        
        $results = execute($sql, true);     
    } else { // first time loading page
       $sql = "SELECT event,player1,player2,matchDate,id FROM " . TABLE_NAME . " LIMIT 25";    
       $results = execute($sql, true);

   }
    require_once("view1.php");
    