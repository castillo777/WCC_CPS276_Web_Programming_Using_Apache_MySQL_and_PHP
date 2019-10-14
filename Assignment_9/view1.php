<?
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Chess Database - Main Page</title>
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
            &nbsp; &nbsp;
            <input type="submit" value="Log Out" name="logout">            
        </form>
        <? if (!empty($results)) { ?>
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
                <td><a href="index.php?viewID=<?=$result['id']?>">View Details</a></td>
            </tr>
            <? } ?>
        </table>
        <? } else { ?>
        <p>No data found.</p>
        <? } ?>
    </body>
</html>