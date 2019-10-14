<?
    function factorial($num) { // recursive function that calculates factorial numbers
        if ($num == 1) {
            return 1;
        } else {
            return $num * factorial($num -1);
        }           
    }
    
    echo(factorial(4));
    
    //strlen
    //substr
    function luhnTest($card) { // recursive function that executes the luhn algoritthm to verify credit card # is valid
        if (empty($card)) {
            return false;
        }
        
        $sum = 0;
        $doubleVal = true;
        for ($pos = strlen($card) - 1; $pos >= 0; $pos--) {
            $doubleVal = !$doubleVal;
            $char = substr($card, $pos, 1);
            
            if ($doubleVal) {
                $char *= 2;
                if ($char > 9) {
                    $char = $char % 10 + 1;
                }
            }
            
            $sum += $char;
        }
        return $sum % 10 == 0;
    }   
    
    echo(luhnTest('') ? 'good' : 'bad');
    //41111111111111
?>
