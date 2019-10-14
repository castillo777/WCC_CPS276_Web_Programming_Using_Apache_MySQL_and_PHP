<!DOCTYPE HTML>
<html>
    <head>
        <title>Circus Insurance Calculator</title>
    </head>
    <body>
        <form action="index.php" method="POST">
            <table border="1" cellpadding="2" cellspacing="0">
                <tr>
                    <th>Lion Tamers</th>
                    <td>
                        <input value="<?=$lion_tamers?>" name="lion_tamers" type="text" maxlength="6">
                    </td>
                </tr>
                <tr>
                    <th>Clowns</th>
                    <td>
                        <input value="<?=$clowns?>" name="clowns" type="text" maxlength="6">
                    </td>
                </tr>
                <tr>
                    <th>Jugglers</th>
                    <td>
                        <input value="<?=$jugglers?>" name="jugglers" type="text" maxlength="6">
                    </td>
                </tr>
                <tr>
                <th>Trapeze Artists</th>
                    <td>
                        <input value="<?=$trapeze_artists?>" name="trapeze_artists" type="text" maxlength="6">
                    </td>
                </tr>
                <tr>
                <th>Human Cannonball</th>
                    <td>
                        <input value="<?=$human_cannonball?>" name="human_cannonball" type="text" maxlength="6">
                    </td>
                </tr>
                <tr>
                    <th>Mime</th>
                    <td>
                        <input value="<?=$mime?>" name="mime" type="text" maxlength="6">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Calculate Rate">
                    </td>
                </tr>
            </table>            
        </form>
        <?
            if (empty($lion_tamers) && empty($clowns) && empty($jugglers)
                    && empty($trapeze_artists) && empty($human_cannonball) && empty($mime)) {
                echo('Enter a numeric value above zero for each performer.');
            }elseif ((!is_numeric($lion_tamers) && !empty($lion_tamers)) || (!is_numeric($clowns) && !empty($clowns)) || (!is_numeric($jugglers) && !empty($jugglers))
                    || (!is_numeric($trapeze_artists) && !empty($trapeze_artists)) || (!is_numeric($human_cannonball) && !empty($human_cannonball)) || (!is_numeric($mime) && !empty($mime))) {
                echo('You have entered a non-numeric value. Please enter a numeric value above zero for each performer.');
            }elseif (($lion_tamers < 0) || ($clowns < 0) || ($jugglers < 0)
                    || ($trapeze_artists < 0) || ($human_cannonball < 0) || ($mime < 0)) {
                echo('You have entered a negative interger as a value. Please enter a numeric value above zero for each performer..');
            }elseif ((($index > 0) || ($rate > 0))) {
                echo('Your index is ' . $index . '. <br>');
                echo('Your rate is $' . $rate . '<br> <br>');
                echo('Total Risk = ' . $total_risk . '<br>');
                echo('Total Profit = ' . $total_profit . '<br>');
                echo('Total Terror = ' . $total_terror . '<br>');
            }elseif ((($index == 0) || ($rate == 0)) && ($total_profit == 0)) {
                echo('The circus averages less than 1 profit per performer, it is not profitable enough to stay solvent. Do not insure! <br> <br>');
                echo('Total Risk = ' . $total_risk . '<br>');
                echo('Total Profit = ' . $total_profit . '<br>');
                echo('Total Terror = ' . $total_terror . '<br>');
            }elseif ((($index == 0) || ($rate == 0)) && ($total_risk > $total_terror)) {
                echo('The circus total risk is greater than the total terror (perceived risk), this is a bad investment. Do not insure! <br> <br>');
                echo('Total Risk = ' . $total_risk . '<br>');
                echo('Total Profit = ' . $total_profit . '<br>');
                echo('Total Terror = ' . $total_terror . '<br>');
            }
        ?>
    </body>
</html>
