<?
require_once('../shared/creditCardValidator.php');

$message = '';

$creditCardNumber = isset($_SESSION['creditCardNumber']) ? $_SESSION['creditCardNumber'] : '';
$creditCardNumber = isset($_REQUEST['creditCardNumber']) ? $_REQUEST['creditCardNumber'] : $creditCardNumber;

$submit = isset($_SESSION['submit']) ? $_SESSION['submit'] : NULL;
$submit = isset($_REQUEST['submit']) ? $_REQUEST['submit'] : $submit;

if ((isset($creditCardNumber) && is_numeric($creditCardNumber)) && isset($submit)) {
    if (validCard($creditCardNumber)) {
        $message = "You have entered a valid credit card number!";
    } else {
        $message = "You have entered an invalid credit card number! Please try again with a vaild number.";      
    }    
} elseif ((isset($creditCardNumber) && !is_numeric($creditCardNumber)) && isset($submit)) {
    $message = "You have entered a non-numeric value! Please try again with a vaild number.";
}

require_once('view.php');
