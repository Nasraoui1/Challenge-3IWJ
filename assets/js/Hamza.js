const form = document.querySelector('#postRsv');
const IDinp = document.querySelector('#idinp');
const NAMEinp = document.querySelector('#nameinp');
const PRENAMEinp = document.querySelector('#prenameinp');
const PHONEinp = document.querySelector('#phoneinp');
const EMAILinp = document.querySelector('#emailinp');

function emailvalid(email) {
  const re = /\S+@\S+\.\S+/;
  return re.test(email);
}

function IDvalid(id) {
  const specialChars = /[!@#$%^&*(),.?":{}|<>]/;
  const uppercaseChars = /[A-Z]/;
  
  return id.length >= 8 && 
    specialChars.test(password) && 
    uppercaseChars.test(password);
}

form.addEventListener('submit', function(e) {
  e.preventDefault();
  message.textContent = '';
  
  if (!emailvalid(EMAILinp.value)) {
    message.textContent = 'Please enter a valid email address.';
    EMAILinp.focus();
    return;
  }
  
  if (!IDvalid(pwdInput.value)) {
    message.textContent = 'Password must contain at least 8 characters, one special character, and one uppercase letter.';
    pwdInput.focus();
    return;
  }
  
  // If both email and password are valid, submit the form
  form.submit();
});
function addEvent() {
  var form = document.getElementById('eventForm');
  var formData = new FormData(form);

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'process.php', true);

  xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
          // Handle the response from the PHP script
          var response = xhr.responseText;
          console.log(response);
          // You can update the page dynamically based on the response
      }
  };

  xhr.send(formData);
}