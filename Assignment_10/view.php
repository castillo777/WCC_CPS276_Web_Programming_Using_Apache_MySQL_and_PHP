<!DOCTYPE html>
<html>
    <head>
        <title>Credit Card Validator</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type='text/javascript' src="creditCardValidator.js"></script>
    </head>
    <body>
        <form id="creditCardForm" method="POST">
            Credit card number: &nbsp;
            <input value="<?=$creditCardNumber?>" type="text" name="creditCardNumber" maxlength="16" size="26"
                   placeholder="Enter your card number here..." required> &nbsp;
            <input type="submit" value="Submit" name="submit"/>
        </form>
        <br>
        <?=$message?>
    </body>
</html>