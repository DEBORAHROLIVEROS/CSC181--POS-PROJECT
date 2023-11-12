// JavaScript code for login functionality
document.querySelector('.login-button').addEventListener('click', function() {
    // Add your login logic here (e.g., validate credentials)

    // For the example, let's assume the login is successful
    // You can replace this with your actual login logic
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Check if login is successful (replace with your validation logic)
    if (username === '123' && password === '123') {
        // Redirect to the dashboard page
        window.location.href = 'dashboard1.html';
    } else {
        alert('Login failed. Please check your username and password.');
    }
});
