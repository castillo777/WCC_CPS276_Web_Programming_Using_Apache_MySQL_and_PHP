<?
 require_once ('../shared/db.php');
 if (empty($_REQUEST['id'])) {
     echo('error');
     exit();
 }
 $id = $_REQUEST['id'];
 
 $sql = "SELECT * FROM matches WHERE id=$id";
 $results = execute($sql);
 if (sizeof($results) != 1) {
     echo('error');
     exit();
 }
 
//var_dump($results);
 $result = $results[0];
?>
<!DOCTYPE html>
<html>
    <table border="1">
        <tr>
            <td>Event Name</td>
            <td><?=$result['event']?></td>
        </tr>
        <tr>
            <td>Event Site</td>
            <td><?=$result['site']?></td>
        </tr>
        <tr>
            <td>Date</td>
            <td><?=convertDate2($result['matchDate'])?></td>
        </tr>
        <tr>
            <td>Round Number</td>
            <td><?=$result['round']?></td>
        </tr>
        <tr>
            <td>Player One</td>
            <td><?=$result['player1']?></td>
        </tr>
        <tr>
            <td>Player Two</td>
            <td><?=$result['player2']?></td>
        </tr>
        <tr>
            <td>Result</td>
            <td><?=convertResult($result['result'])?></td>
        </tr>
        <tr>
            <td>ECO and Opening</td>
            <td><?=printEchoAndOpening($result['eco'], $result['opening'])?></td>
        </tr>
        <tr>
            <td>Moves</td>
            <td><?=$result['moves']?></td>
        </tr>
    </table>
</html>
