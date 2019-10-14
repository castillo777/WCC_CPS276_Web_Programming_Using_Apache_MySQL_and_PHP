<!DOCTYPE html>
<html>
    <head>
        <title>Chess Database - View Details</title>
    </head>
    <body>
        <form action="main.php" method="post">
            <input type="submit" name="back" value="Go Back">
        </form>
        <table border="1">
            <tr>
                <td>Player One</td>
                <td><?=$record['player1']?></td>
            </tr>
            <tr>
                <td>Player Two</td>
                <td><?=$record['player2']?></td>
            </tr>
        </table>
    </body>
</html>
