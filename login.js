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


