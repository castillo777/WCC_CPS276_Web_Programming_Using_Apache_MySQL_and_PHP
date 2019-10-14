<?
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Chess Database - View Details</title>
    </head>
    <body>
        <form action="index.php" method="post">
            <input type="submit" name="back" value="Go Back">
        </form>
        <br>
        <table border="1">
            <tr>
                <td>Event Name</td>
                <td><?=$record['event']?></td>
            </tr>
            <tr>
                <td>Event Site</td>
                <td><?=$record['site']?></td>
            </tr>
            <tr>
                <td>Date</td>
                <td><?=convertDate2($record['matchDate'])?></td>
            </tr>
            <tr>
                <td>Round Number</td>
                <td><?=$record['round']?></td>
            </tr>
            <tr>
                <td>Player One</td>
                <td><?=$record['player1']?></td>
            </tr>
            <tr>
                <td>Player Two</td>
                <td><?=$record['player2']?></td>
            </tr>
            <tr>
                <td>Result</td>
                <td><?=convertResult($record['result'])?></td>
            </tr>
            <tr>
                <td>ECO and Opening</td>
                <td><?=printEchoAndOpening($record['eco'], $record['opening'])?></td>
            </tr>
            <tr>
                <td>Moves</td>
                <td><?=$record['moves']?></td>
            </tr>
        </table>
    </body>
</html>