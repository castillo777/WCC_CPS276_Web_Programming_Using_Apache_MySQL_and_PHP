function clearPresidents() {
    setDiv('');
}

function setDiv(val) {
    var myText = $('#mydiv');    
    if (myText.length < 1) {
        return;
    }
    myText.text('');
    myText.append(val);
}

function showPresidents() {
    debugger;
    $.ajax({
        type: "GET",
        url: "VendArray.php",
        success: function (response) {
            console.log(response);
            var myArray = JSON.parse(response);
            console.log(myArray);
            var resultString = '';
            
            resultString = '<table border="1">';
            resultString += '<tr>';
            resultString += '<th>First Name</th>';
            resultString += '<th>Last Name</th>';
            resultString += '</tr>';
            for (var counter = 0; counter < myArray.length; counter++) {
                //var onePresident = myArray[counter];
                resultString += '<tr>';
                resultString += '<td>';
                resultString += myArray[counter]['first'];
                resultString += '</td>';
                resultString += '<td>';
                resultString += myArray[counter]['last'];
                resultString += '</td>';
                resultString += '</tr>';
            }           
            resultString += '</table>';
            setDiv(resultString);            
           
            // response will be the output of TestAjax.php
        },
        
        error: function (response) {
            console.log(response);
        }
    });
}


