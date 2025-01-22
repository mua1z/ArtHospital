
    const loginButton = document.getElementById('loginButton');
    const signupButton = document.getElementById('signupButton');
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');
    const loginContainer = document.querySelector('.login');
    const signupContainer = document.querySelector('.signup');

    loginButton.addEventListener('click', () => {
        loginContainer.classList.toggle('active');
        signupContainer.classList.remove('active'); // Close Sign-Up Form if open
    });

    signupButton.addEventListener('click', () => {
        signupContainer.classList.toggle('active');
        loginContainer.classList.remove('active'); // Close Login Form if open
    });

    // Optional: Close forms when clicking outside
    window.addEventListener('click', (e) => {
        if (!loginContainer.contains(e.target) && loginContainer.classList.contains('active')) {
            loginContainer.classList.remove('active');
        }
        if (!signupContainer.contains(e.target) && signupContainer.classList.contains('active')) {
            signupContainer.classList.remove('active');
        }
    });

