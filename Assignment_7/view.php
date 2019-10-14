<!DOCTYPE html>
<html>
    <head>
        <title>Accounting Import</title>
    </head>
    <body>
        <form action="main.php" enctype="multipart/form-data" method="POST">
            <input type="submit" value="Upload File" name="upload">
            <input accept=".cvs,.txt" type="file" name="myFile">
        </form>
        <hr>
        <? if ($total_amount > 0) {
            echo($upload_message);
            echo('<br> <br>');
        }
        ?>
        <? if ($total_amount > 0) { ?>
        <table border="1">
            <tr>
                <th>File Name</th>
                <th>Records</th>
                <th>Total</th>
            </tr>
            <tr>
                <td><?=$original_name?></td>
                <td><?=$records?></td>
                <td><?='$' . number_format($total_amount)?></td>
            </tr>
        </table>
        <br>
        <table border="1">
            <tr>
                <th>Account</th>
                <th>Phone</th>
                <th>Amount</th>
            </tr>
            <? for($i = 0; $i < $records; $i++) {
            ?>
            <tr>
                <td><?=$results['account'][$i]?></td>
                <td><?=$results['phone'][$i]?></td>
                <td><?=$results['money'][$i]?></td>
            </tr>
            <?
            } ?>
        </table>
        <? } ?>
    </body>
</html>
