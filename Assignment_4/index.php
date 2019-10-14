<?
    require_once ('../shared/db.php');
    
    $name = filter_input(INPUT_POST, 'name');    
    $startDate = filter_input(INPUT_POST, 'startDate');
    $endDate = filter_input(INPUT_POST, 'endDate');
    
    if ((!is_string($name))|| (!is_string($startDate))|| (!is_string($endDate))) {
        $name = NULL;
        $startDate = NULL;
        $endDate = NULL;
     }  
     
    $startingDate = convertDate1($startDate);
    $endingDate = convertDate1($endDate);
    
    if ((!empty($name)) && empty($startDate) && empty($endDate)) {
        $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE (player1 LIKE '%$name%' OR player2 LIKE '%$name%') LIMIT 25";        
        $results = execute($sql, true);
    }
    elseif (!empty($name) && (!empty($startDate)) && empty($endDate)) {
        $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE ((player1 LIKE '%$name%' OR player2 LIKE '%$name%') AND (matchDate >= '$startingDate')) LIMIT 25";        
        $results = execute($sql, true);
    }
    elseif (!empty($name) && empty($startDate) && (!empty($endDate))) {
        $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE ((player1 LIKE '%$name%' OR player2 LIKE '%$name%') AND (matchDate <= '$endingDate')) LIMIT 25";        
        $results = execute($sql, true);
    }
    elseif ((!empty($name)) && (!empty($startDate)) && (!empty($endDate))) {
        $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE ((player1 LIKE '%$name%' OR player2 LIKE '%$name%') AND (matchDate BETWEEN '$startingDate' AND '$endingDate')) LIMIT 25";        
        $results = execute($sql, true);
    }
    elseif (empty($name) && (!empty($startDate)) && (!empty($endDate))) {
        $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE (matchDate BETWEEN '$startingDate' AND '$endingDate') LIMIT 25";        
        $results = execute($sql, true);
    }
    elseif (empty($name) && (!empty($startDate)) && empty($endDate)) {
        $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE (matchDate >= '$startingDate') LIMIT 25";        
        $results = execute($sql, true);
    }
    elseif (empty($name) && empty($startDate) && (!empty($endDate))) {
        $sql = "SELECT event,player1,player2,matchDate,id FROM matches WHERE (matchDate <= '$endingDate') LIMIT 25";        
        $results = execute($sql, true);
    }
    else {
        $sql = "SELECT event,player1,player2,matchDate,id FROM matches LIMIT 25";    
        $results = execute($sql, true);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Chess Database</title>
    </head>
    <body>
        <form action="index.php" method="post">
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            Player Name: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            Start Date: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            End Date: <br>
            <input type="submit" value="Search">
            <input value="<?=$name?>" type="text" name="name" maxlength="22">
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;            
            <input value="<?=$startDate?>" type="text" name="startDate" maxlength="10">
            &nbsp;to&nbsp;            
            <input value="<?=$endDate?>" type="text" name="endDate" maxlength="10">           
        </form>
        <hr> <?=count($results) . " records found."?> <br> <br>
        
        <table border="1">
            <tr>
                <th>Event</th>
                <th>Player One</th>
                <th>Player Two</th>
                <th>Match Date</th>
                <th></th>
            </tr>
            <? foreach ($results as $result) { ?>
            <tr>
                <td><?=$result['event']?></td>
                <td><?=$result['player1']?></td>
                <td><?=$result['player2']?></td>
                <td><?=convertDate2($result['matchDate'])?></td>
                <td><a href="details.php?id=<?=$result['id']?>">View Details</a></td>
            </tr>
            <? } ?>
        </table>
    </body>
</html>