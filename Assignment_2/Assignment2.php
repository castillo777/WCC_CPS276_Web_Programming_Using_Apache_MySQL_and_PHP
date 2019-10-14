<?
require_once 'COL_Array.php';
     
    $locationA = filter_input(INPUT_POST, 'locationA');
    $locationB = filter_input(INPUT_POST, 'locationB');
    $inputWages = filter_input(INPUT_POST, 'inputWages');   

    $cityA = substr($locationA, 5);
    $cityB = substr($locationB, 5);
    
    if (!is_numeric($inputWages)) {
        $inputWages = null;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cost of Living Calculator</title>
        
        <style>
            table, #tableHeader, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            
            #tableHeader, #submitButton{
                padding: 5px;
                text-align: center;
            }
            
            th, td {
                padding: 5px;
                text-align: left;
            }
        </style>
    </head>
    
    <body>
        <form action="Assignment2.php" method="post">
            <table>
                <tr>
                    <th id="tableHeader" colspan="2">Cost of Living Calculator</th>
                </tr>
                <tr>
                    <th colspan="2">This app compares relative cost of living between two locations.</th>
                </tr>
                <tr>
                    <th>Location A:</th>                    
                    <td>
                        <select name="locationA">
                            <option value="0">Select a location </option>
                            <?
                            foreach ($COL_array as $key => $value) {
                                if ($key == $locationA) {
                                    $selectionStatus = "selected";
                                }
                                else {
                                    $selectionStatus = '';
                                }
                                echo "<option value='$key' $selectionStatus>$key</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Wages in location A:</th>
                    <td><input name="inputWages" type="text" value="<?echo($inputWages)?>"></td>
                </tr>
                <tr>
                    <th>Location B:</th>
                    <td>
                        <select name="locationB">
                            <option value="0">Select a location </option>
                            <?
                            foreach ($COL_array as $key => $value) {
                                if ($key == $locationB) {
                                    $selectionStatus = "selected";
                                }
                                else {
                                    $selectionStatus = '';
                                }
                                echo "<option value='$key' $selectionStatus>$key</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td id="submitButton" colspan="2"><input type="submit" value="Submit Form"></td>
                </tr>
            </table>
        </form>        
        <? 
         if ($locationA && $locationB && $inputWages) {
             $locationAIndex = $COL_array[$locationA];
             $locationBIndex = $COL_array[$locationB];
             $wagesA = $inputWages;
             $wagesB = ( ($wagesA / $locationAIndex) * $locationBIndex );
             $wagesAFormatted = '$'.number_format($wagesA, 2);
             $wagesBFormatted = '$'.number_format($wagesB, 2);
             
             echo "Making $wagesAFormatted in $cityA is the same as making $wagesBFormatted in $cityB.";            
         }  
        ?>      
    </body>
</html>