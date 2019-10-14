 <?php

$db = null;
 
function getPDO() {
    global $db;
    if ($db != null) {
        return $db;
    }
    try {
        $db = new PDO('mysql:host=localhost;port=3306;dbname=scastillobaez','scastillobaez','VvrxA93kA4r6');
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
        return $db;
    }
    catch (Exception $e2) {
        echo('DB Connection Error - ' . $e2->getMessage());
        exit();
    }
}

function execute($sql,$returnResults=true) {
//echo($sql . '<br>');    
    $db = getPDO();
    try {
        $statement = $db->prepare($sql);
        if (!$statement) {
            echo('DB Prepare Error - ' . $sql);
            exit();
        }
        $statement->execute();
        $results = array();
        if ($returnResults) {
            $results = $statement->fetchAll();
        }
        $statement->closeCursor();
        return $results;
    }
    catch (Exception $e2) {
        echo('DB Error - ' . $sql);
        echo('<br>' . $e2->getMessage());
        exit();
    }
}

// converts from mm/dd/yyyy to yyyy-mm-dd
function convertDate1($d1) {
    date_default_timezone_set('America/New_York');
    $test_arr  = explode('/', $d1);
     if (sizeof($test_arr) != 3) {
        return '';
    }
    if (!checkdate($test_arr[0], $test_arr[1], $test_arr[2])) {
        return '';
    }    
    $t = mktime(12,0,0,$test_arr[0], $test_arr[1], $test_arr[2]);
    return date('Y-m-d',$t);
}

// converts to mm/dd/yyyy from yyyy-mm-dd
function convertDate2($d1) {
    date_default_timezone_set('America/New_York');
    $test_arr  = explode('-', $d1);
    if (sizeof($test_arr) != 3) {
        return '';
    }
    if (!checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
        return '';
    }    
    $t = mktime(12,0,0,$test_arr[1], $test_arr[2], $test_arr[0]);
    return date('m/d/Y',$t);
}

function convertResult($dat) {
    if (!isset($dat)) {
       return '';
   }
    if ($dat === '1') {
        return 'Player One';
    }
    elseif ($dat === '2') {
        return 'Player Two';
    }
    elseif ($dat === 'D') {
        return 'Draw';
    }
    return '';
}

function printEchoAndOpening($eco, $opening) {
    
    if (!empty($opening)) {
        echo ("($eco) " . $opening);
    }
    else {
        echo ("($eco)");
    }
}