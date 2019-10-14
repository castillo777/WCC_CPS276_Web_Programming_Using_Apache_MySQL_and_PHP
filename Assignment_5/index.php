<?
    require_once ('../shared/db.php');
    
    $zipCode = filter_input(INPUT_POST, 'zipCode');
    $distance = filter_input(INPUT_POST, 'distance');
    $zipCodeIsValid = true;
    
    if ((!is_numeric($zipCode)) || (strlen($zipCode) != 5)) {
        $zipCodeIsValid = false;
    }

    if (($zipCodeIsValid) && ($distance != 0)) {
        $locationsSQLSearchQuery = "SELECT * FROM a6_locations WHERE zipcode = $zipCode";
        $locationsTableResults = execute($locationsSQLSearchQuery, true); 
        
        $zipCodeMatchesFound = count($locationsTableResults);
        
        if ($zipCodeMatchesFound > 0) {
            foreach ($locationsTableResults as $coordinates) {
                     $lat = $coordinates['latitude'];
                     $log = $coordinates['longitude'];
            } // End of foreach loop
    
            $peopleSQLSearchQuery =  "SELECT p.provider_number,p.person_name,l.state,l.zipcode,l.location_name,l.zipcode,(69*(sqrt(pow($lat-l.latitude,2) + pow($log-l.longitude,2)))) AS distance " .
                                     "FROM a6_people as p " .
                                     "JOIN a6_locations as l ON p.locationID=l.locationID " .
                                     "WHERE (69*(sqrt(pow($lat-l.latitude,2) + pow($log-l.longitude,2)))) <= $distance ORDER BY distance,provider_number";
    
            $peopleTableResults = execute($peopleSQLSearchQuery, true);
        
            $numberOfPeopleFoundWithinDistance = count($peopleTableResults);
        } // End of inner if statement
    } // End of outer if statement  
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Provider Lookup Application</title>
    </head>
    <body>
        <form action="index.php" method="post">
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            Zip Code: 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            Distance: <br>
            <input type="submit" value="Search">
            <input value="<?=$zipCode?>" type="text" name="zipCode" maxlength="5">
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <select name="distance">
                <option value="0" <?if ($distance == 0) { echo("selected"); }?>>--Select an option--</option>
                <option value="10" <?if ($distance == 10) { echo("selected"); }?>>10 miles</option>
                <option value="25" <?if ($distance == 25) { echo("selected"); }?>>25 miles</option>
                <option value="50" <?if ($distance == 50) { echo("selected"); }?>>50 miles</option>
                <option value="75" <?if ($distance == 75) { echo("selected"); }?>>75 miles</option>
            </select>
        </form> <hr>
        <?
          if ((empty($zipCode)) || ($distance == 0)) { 
              echo("Enter a valid 5-digit zip code and make sure to select your desired distance.");
            } else if ((!$zipCodeIsValid)) {
              echo("You have entered an invalid zip code! Please enter a valid 5-digit zip code and make sure to select a desired distance.");
            } else if (($zipCodeIsValid) && ($zipCodeMatchesFound == 0) && ($distance != 0)) {
              echo("The zip code you have entered does not match our records. Please try again with another zip code.");
            } else if (($zipCodeIsValid)  && ($zipCodeMatchesFound > 0) && ($numberOfPeopleFoundWithinDistance == 0) && (($distance != 0))) {
              echo("The zip code you have entered matches our records, however, nobody was found within $distance miles. Please try again with another zip code.");
            } else { 
        ?>
        <br>
        <table border="1">
            <tr>
                <th>City</th>
                <th>State</th>
                <th>Zip Code</th>
                <th>Members Within <?=$distance?> Miles</th>
            </tr>
            <?foreach ($locationsTableResults as $result) { ?>
            <tr>
                <td><?=$result['location_name']?></td>
                <td><?=$result['state']?></td>
                <td><?=$result['zipcode']?></td>
                <td><?=$numberOfPeopleFoundWithinDistance?></td>
            </tr>
            <? } ?>
        </table>
        <br> <br>
        <table border="1">
            <tr>
                <th>Person</th>
                <th>Provider</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Distance</th>
            </tr>
            <?foreach ($peopleTableResults as $result) { ?>
            <tr>
                <td><?=$result['person_name']?></td>
                <td><?=$result['provider_number']?></td>
                <td><?=$result['location_name']?></td>
                <td><?=$result['state']?></td>
                <td><?=$result['zipcode']?></td>
                <td align="right"><?=number_format($result['distance'], 2)?></td>
            </tr>
            <? } ?>
        </table>
        <? } ?>
    </body>
</html>
