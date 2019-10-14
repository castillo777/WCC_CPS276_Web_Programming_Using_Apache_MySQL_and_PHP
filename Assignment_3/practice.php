<?
$presidents = array();
$presidents[] = array('first'=>'George','last'=>'Washington');
$presidents[] = array('first'=>'George','last'=>'Bush');
$presidents[] = array('first'=>'Jimmy','last'=>'Carter');

/**
$president = array();
$president['first'] = 'George';
$president['last'] = 'Washington';

$presidents[] = $president;

$president['first'] = 'George';
$president['last'] = 'Washington';

$presidents[] = $president;
 
 **/

// var_dump($presidents);
?>
<html>
    <table border="1">
        <? for ($counter = 0; $counter < sizeof($presidents); $counter++) { ?>
        <tr>
            <td>
                <? echo($presidents[$counter]['first']); ?>
            </td>
            <td>
                <? echo($presidents[$counter]['last']); ?>
            </td>  
        </tr>
        <? } ?>
    </table>
    
        <table border="1">
        <? for ($counter = 0; $counter < sizeof($presidents); $counter++) { ?>
        <tr>
            <td>
                <? echo($presidents[$counter]['first']); ?>
            </td>
            <td>
                <? echo($presidents[$counter]['last']); ?>
            </td>  
        </tr>
        <? } ?>
    </table>
</html>

