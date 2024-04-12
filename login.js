window.onload = function() {
    var loginForm = document.getElementById('loginForm');
    var registerForm = document.getElementById('registerForm');
    var showRegisterForm = document.getElementById('showRegisterForm');
    var showLoginForm = document.getElementById('showLoginForm');

    registerForm.addEventListener('submit', function(event) {
        var email = document.getElementById('useremail').value;
        var password = document.getElementById('password').value;
        var confirmPassword= document.getElementById('confirmPassword').value;

        if(!password || !email || !confirmPassword){
            event.preventDefault();
            var errorMessage = document.createElement('div');
            errorMessage.textContent = 'Plesase fill in all fields.';
            errorMessage.className = 'error-message';
            loginForm.appendChild(errorMessage);
            console.log('Prevented login');
        }

        else if (!email.endsWith('@connect.hku.hk')) {
            event.preventDefault();
            var errorMessage = document.createElement('div');
            errorMessage.textContent = 'Please use your @connect.hku.hk email address to register.';
            errorMessage.className = 'error-message';
            registerForm.appendChild(errorMessage);
            console.log('Prevented registration');
        }
        else if(password != confirmPassword){
            event.preventDefault();
            var errorMessage = document.createElement('div');
            errorMessage.textContent = 'Passwords do not match.';
            errorMessage.className = 'error-message';
            registerForm.appendChild(errorMessage);
            console.log('Prevented registration');
        }
    });

    loginForm.addEventListener('submit', function(event) {
        var email = document.getElementById('useremail').value;
        var password= document.getElementById('password').value;

        if(!password || !email){
            event.preventDefault();
            var errorMessage = document.createElement('div');
            errorMessage.textContent = 'Plesase fill in all fields.';
            errorMessage.className = 'error-message';
            loginForm.appendChild(errorMessage);
            console.log('Prevented login');
        }

        else if (!email.endsWith('@connect.hku.hk')) {
            event.preventDefault();
            var errorMessage = document.createElement('div');
            errorMessage.textContent = 'Please use your @connect.hku.hk email address to login.';
            errorMessage.className = 'error-message';
            loginForm.appendChild(errorMessage);
            console.log('Prevented login');
        }

    });

    showRegisterForm.addEventListener('click', function() {
        loginForm.style.display = 'none'; // Hide the login form
        registerForm.style.display = 'block'; // Show the registration form
    });    
    showLoginForm.addEventListener('click', function() {
        registerForm.style.display = 'none'; // Hide the registration form
        loginForm.style.display = 'block'; // Show the login form
    });
}