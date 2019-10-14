<!DOCTYPE html>
<html>
    <head>
        <title>Chess Database - Main Page</title>
    </head>
    <body>
        <form action="main.php" method="post">
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            Player Name: <br>
            <input type="submit" value="Search">
            <input value="<?=$name?>" type="text" name="name" maxlength="22">          
        </form>
        <? if (!empty($results)) { ?>
        <hr> <?=count($results) . " records found."?> <br> <br>        
        <table border="1">
            <tr>
                <th>Player One</th>
                <th>Player Two</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <? foreach ($results as $result) { ?>
            <tr>
                <td><?=$result['player1']?></td>
                <td><?=$result['player2']?></td>
                <td><a href="main.php?deleteID=<?=$result['id']?>"
                       onclick="return confirm('Do you really want to delete this record?');">Delete</a></td>
                <td><a href="main.php?viewID=<?=$result['id']?>">View Details</a></td>
                <td><a href="main.php?editID=<?=$result['id']?>">Edit</a></td>
            </tr>
            <? } ?>
        </table>
        <? } else { ?>
        <p>No data found.</p>
        <? } ?>
    </body>
</html>
