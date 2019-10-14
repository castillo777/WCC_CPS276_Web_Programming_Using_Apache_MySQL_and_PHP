$(document).ready(function() {
  $('#creditCardForm').submit(function(e) {
    e.preventDefault();
    var creditCardNumber = $('input[name="creditCardNumber"]').val();
    if (isNaN(creditCardNumber)) {
        alert("You have entered a non-numeric value! Please try again with a vaild number.");
    } else {
        isCardNumberValid(creditCardNumber);
    }
  });
});

var luhnChk = (function(arr) {
  return function(ccNum) {
    var
      len = ccNum.length,
      bit = 1,
      sum = 0,
      val;

    while (len) {
      val = parseInt(ccNum.charAt(--len), 10);
      sum += (bit ^= 1) ? arr[val] : val;
    }

    return sum && sum % 10 === 0;
  };
}([0, 2, 4, 6, 8, 1, 3, 5, 7, 9]));

function isCardNumberValid(creditCardNumber) {    
  if (luhnChk(creditCardNumber) === true) {
      alert("You have entered a valid credit card number!");
    } else {
      alert("You have entered an invalid credit card number! Please try again with a vaild number.");
    }
}
