<?
function validCard($creditCard) 
{
    if (empty($creditCard)) {
        return false;
    }
    
    $sum = 0;
    $doubleVal = true;
    $max = strlen($creditCard) - 1; 
    
    for ($counter = $max;$counter >= 0;$counter--){
         $char = substr($creditCard,$counter,1);
         
        if (!is_numeric($char)) {
            continue;
        }
         
        $doubleVal = !$doubleVal;
        $val = $char;
         
        if ($doubleVal) {
            $val *= 2;
        }
        
        if ($val > 9) {
            $val = ($val % 10) + 1;
        }
        
        $sum += $val;         
    }
    
    return $sum > 0 && $sum % 10 == 0;
}
