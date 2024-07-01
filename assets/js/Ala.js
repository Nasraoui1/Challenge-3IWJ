const form = document.querySelector('#formAuthentication');
const emailInput = document.querySelector('#emailinput');
const pwdInput = document.querySelector('#pwdinput');
const message = document.querySelector('#message');

function validateEmail(email) {
  const re = /\S+@\S+\.\S+/;
  return re.test(email);
}

function validatePassword(password) {
  const specialChars = /[!@#$%^&*(),.?":{}|<>]/;
  const uppercaseChars = /[A-Z]/;
  
  return password.length >= 8 && 
    specialChars.test(password) && 
    uppercaseChars.test(password);
}

form.addEventListener('submit', function(e) {
  e.preventDefault();
  message.textContent = '';
  
  if (!validateEmail(emailInput.value)) {
    message.textContent = 'Please enter a valid email address.';
    emailInput.focus();
    return;
  }
  
  if (!validatePassword(pwdInput.value)) {
    message.textContent = 'Password must contain at least 8 characters, one special character, and one uppercase letter.';
    pwdInput.focus();
    return;
  }
  
  // If both email and password are valid, submit the form
  form.submit();
});
