var loginForm = document.getElementById('loginForm');
var registerForm = document.getElementById('registerForm');
var showRegisterForm = document.getElementById('showRegisterForm');
var showLoginForm = document.getElementById('showLoginForm');
    
showRegisterForm.addEventListener('click', function() {
    loginForm.style.display = 'none'; // Hide the login form
    registerForm.style.display = 'block'; // Show the registration form
});    
showLoginForm.addEventListener('click', function() {
    registerForm.style.display = 'none'; // Hide the registration form
    loginForm.style.display = 'block'; // Show the login form
});


document.getElementById('registerForm').addEventListener('submit', function(event) {
    var email = document.getElementById('useremail').value;
    if (!email.endsWith('@connect.hku.hk')) {
        var errorMessage = document.createElement('div');
        errorMessage.textContent = 'Please use your @connect.hku.hk email address to register.';
        errorMessage.className = 'error-message';
        registerForm.appendChild(errorMessage);
        event.preventDefault();
    }
});


