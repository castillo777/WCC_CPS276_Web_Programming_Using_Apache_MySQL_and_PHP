<!DOCTYPE html>
<html>
    <head>
        <title>Chess Database - Edit Players</title>
    </head>
    <body>
        <form action="main.php" method="post">
            <input type="hidden" name="eventID" value="<?=$editID?>">
            <input type="submit" name="back" value="Cancel"/> &nbsp;
            <input type="submit" name="save" value="Save"/>
            <br>
            <table border="1">
                <tr>
                    <td>Player One</td>
                    <td><input type="text" maxlength="32" name="player1" size="50"
                            value="<?=$record['player1']?>"></td>
                </tr>
                <tr>
                    <td>Player Two</td>
                    <td><input type="text" maxlength="32" name="player2" size="50"
                           value="<?=$record['player2']?>"></td>
                </tr>
            </table>
        </form>
    </body>
</html>
