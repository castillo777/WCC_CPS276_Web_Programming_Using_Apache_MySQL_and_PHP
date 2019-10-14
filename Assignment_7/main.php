<?
    session_start();
    define('UPLOAD_DIR', 'uploaded_files');
    $account_pattern = '/[a-zA-Z]{2}\d{8}|[a-zA-Z]{2}\d{4}/';
    $phone_pattern = '/\d{3}-\d{4}|\(\d{3}\) ?\d{3}-\d{4}/';
    $money_pattern = '/\$\d{0,}\.\d{2}/';
    
    $total_amount = 0.00;
   
    $myFile = isset($_SESSION['myFile']) ? $_SESSION['myFile'] : ''; 
    $myFile = isset($_REQUEST['myFile']) ? $_REQUEST['myFile'] : $myFile; 
    $_SESSION['myFile'] = $myFile;
    $upload = isset($_SESSION['upload']) ? $_SESSION['upload'] : ''; 
    $upload = isset($_REQUEST['upload']) ? $_REQUEST['upload'] : $upload; 
    $_SESSION['upload'] = $upload;
    
    if (isset($upload) && !empty($_FILES['myFile']['tmp_name'])) {
        $new_name = NULL;
        $original_name = $_FILES['myFile']['name'];
        $tmp_name = $_FILES['myFile']['tmp_name'];
        $path = getcwd() . DIRECTORY_SEPARATOR . UPLOAD_DIR;
        $new_name = $path . $tmp_name;
        $success = move_uploaded_file($tmp_name, $new_name);
        
        if ($success) {
            $upload_message = $original_name . ' has been uploaded!';
        }
        else {
            echo('error');
            exit();
        }
      
        if (preg_match('/.txt/', $original_name) == 1) {
           $text = file($new_name);
           $records = count($text);
        
           for ($i = 0; $i < $records; $i++) {
               preg_match($account_pattern, $text[$i], $matches['account']);
               preg_match($phone_pattern, $text[$i], $matches['phone']);
               preg_match($money_pattern, $text[$i], $matches['money']);
            
               if (preg_match($account_pattern, $text[$i]) == 1) {
                  $results['account'][$i] = $matches['account'][0];
                }elseif (preg_match($account_pattern, $text[$i]) == 0) {
                  $results['account'][$i] = '';
                }
            
               if (preg_match($phone_pattern, $text[$i]) == 1) {
                  $results['phone'][$i] = $matches['phone'][0];
               }elseif (preg_match($phone_pattern, $text[$i]) == 0) {
                  $results['phone'][$i] = '';
               }
            
               if (preg_match($money_pattern, $text[$i]) == 1) {
                  $results['money'][$i] = $matches['money'][0];
               }elseif (preg_match($money_pattern, $text[$i]) == 0) {
                  $results['money'][$i] = '';
               }
            }
        }elseif(preg_match('/.csv/', $original_name) == 1) {
           $text = file_get_contents($new_name);
           
           $records = preg_match_all($account_pattern, $text, $matches['account']);
           $records = preg_match_all($phone_pattern, $text, $matches['phone']);
           $records = preg_match_all($money_pattern, $text, $matches['money']);
           
           $results['account'] = $matches['account'][0];
           $results['phone'] = $matches['phone'][0];
           $results['money'] = $matches['money'][0];
           
        }
       
        for ($i = 0; $i < $records; $i++) {
            $amount[$i] = str_replace('$', '', $results['money'][$i]);
        }
        
        foreach ($amount as $value) {
            $total_amount += (float)$value;
        }
    }
    
    require_once('view.php');