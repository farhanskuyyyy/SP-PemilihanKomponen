document.addEventListener("DOMContentLoaded", function () {
    // Demo credentials
    const validCredentials = {
        email: "admin@example.com",
        password: "admin123",
    };

    // Check for registered users
    const registeredUsers =
        JSON.parse(localStorage.getItem("registeredUsers")) || [];

    // Form elements
    const loginForm = document.getElementById("loginForm");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const loginBtn = document.getElementById("loginBtn");
    const togglePassword = document.getElementById("togglePassword");
    const rememberMe = document.getElementById("rememberMe");
    const alertContainer = document.getElementById("alertContainer");

    // Modal elements
    const forgotPasswordModal = new bootstrap.Modal(
        document.getElementById("forgotPasswordModal")
    );
    const forgotPasswordForm = document.getElementById("forgotPasswordForm");
    const resetEmailInput = document.getElementById("resetEmail");

    // Load saved credentials if remember me was checked
    loadSavedCredentials();

    // Password toggle functionality
    togglePassword.addEventListener("click", function () {
        const type =
            passwordInput.getAttribute("type") === "password"
                ? "text"
                : "password";
        passwordInput.setAttribute("type", type);

        const icon = this.querySelector("i");
        icon.classList.toggle("bi-eye");
        icon.classList.toggle("bi-eye-slash");
    });

    // Login form submission
    loginForm.addEventListener("submit", function (e) {
        // e.preventDefault();
        // if (validateForm()) {
        //     performLogin();
        // }
    });

    // Forgot password link
    document
        .getElementById("forgotPasswordLink")
        .addEventListener("click", function (e) {
            e.preventDefault();
            forgotPasswordModal.show();
        });

    // Send reset email
    document
        .getElementById("sendResetBtn")
        .addEventListener("click", function () {
            const email = resetEmailInput.value.trim();

            if (!email) {
                showFieldError(
                    resetEmailInput,
                    "Please enter your email address"
                );
                return;
            }

            if (!isValidEmail(email)) {
                showFieldError(
                    resetEmailInput,
                    "Please enter a valid email address"
                );
                return;
            }

            // // Simulate sending reset email
            // showAlert(
            //     "Password reset link has been sent to your email address.",
            //     "success"
            // );
            // forgotPasswordModal.hide();
            // resetEmailInput.value = "";
            // clearFieldError(resetEmailInput);
            forgotPasswordForm.requestSubmit();
        });

    // Form validation
    function validateForm() {
        let isValid = true;

        // Clear previous errors
        clearAllErrors();

        // Validate email
        const email = emailInput.value.trim();
        if (!email) {
            showFieldError(emailInput, "Email is required");
            isValid = false;
        } else if (!isValidEmail(email)) {
            showFieldError(emailInput, "Please enter a valid email address");
            isValid = false;
        }

        // Validate password
        const password = passwordInput.value;
        if (!password) {
            showFieldError(passwordInput, "Password is required");
            isValid = false;
        } else if (password.length < 6) {
            showFieldError(
                passwordInput,
                "Password must be at least 6 characters"
            );
            isValid = false;
        }

        return isValid;
    }

    // Perform login
    function performLogin() {
        const email = emailInput.value.trim();
        const password = passwordInput.value;

        // Show loading state
        setLoadingState(true);

        // Simulate API call delay
        setTimeout(() => {
            // Check demo credentials first
            let loginSuccess = false;
            let userData = null;

            if (
                email === validCredentials.email &&
                password === validCredentials.password
            ) {
                loginSuccess = true;
                userData = {
                    email: email,
                    username: "admin",
                    role: "Admin",
                };
            } else {
                // Check registered users
                const user = registeredUsers.find(
                    (u) =>
                        u.email.toLowerCase() === email.toLowerCase() &&
                        u.password === password
                );

                if (user) {
                    loginSuccess = true;
                    userData = user;
                }
            }

            if (loginSuccess) {
                // Save credentials if remember me is checked
                if (rememberMe.checked) {
                    localStorage.setItem("rememberedEmail", email);
                    localStorage.setItem("rememberMe", "true");
                } else {
                    localStorage.removeItem("rememberedEmail");
                    localStorage.removeItem("rememberMe");
                }

                // Store login session
                sessionStorage.setItem("isLoggedIn", "true");
                sessionStorage.setItem("userData", JSON.stringify(userData));

                showAlert("Login successful! Redirecting...", "success");

                // Redirect to dashboard after 1.5 seconds
                setTimeout(() => {
                    window.location.href = "index.html";
                }, 1500);
            } else {
                showAlert(
                    "Invalid email or password. Please try again.",
                    "danger"
                );
                setLoadingState(false);
            }
        }, 1500);
    }

    // Load saved credentials
    function loadSavedCredentials() {
        const rememberedEmail = localStorage.getItem("rememberedEmail");
        const rememberMeChecked = localStorage.getItem("rememberMe") === "true";

        if (rememberedEmail && rememberMeChecked) {
            emailInput.value = rememberedEmail;
            rememberMe.checked = true;
        }
    }

    // Set loading state
    function setLoadingState(loading) {
        const btnText = loginBtn.querySelector(".btn-text");

        if (loading) {
            loginBtn.classList.add("loading");
            btnText.innerHTML = '<span class="spinner"></span>Signing In...';
            loginBtn.disabled = true;
        } else {
            loginBtn.classList.remove("loading");
            btnText.innerHTML = "Sign In";
            loginBtn.disabled = false;
        }
    }

    // Show field error
    function showFieldError(field, message) {
        field.classList.add("is-invalid");
        field.classList.remove("is-valid");
        const feedback = field.parentNode.querySelector(".invalid-feedback");
        if (feedback) {
            feedback.textContent = message;
        }
    }

    // Clear field error
    function clearFieldError(field) {
        field.classList.remove("is-invalid");
        field.classList.add("is-valid");
        const feedback = field.parentNode.querySelector(".invalid-feedback");
        if (feedback) {
            feedback.textContent = "";
        }
    }

    // Clear all errors
    function clearAllErrors() {
        const inputs = [emailInput, passwordInput];
        inputs.forEach((input) => {
            input.classList.remove("is-invalid", "is-valid");
            const feedback =
                input.parentNode.querySelector(".invalid-feedback");
            if (feedback) {
                feedback.textContent = "";
            }
        });
    }

    // Show alert
    function showAlert(message, type) {
        const alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
        alertContainer.innerHTML = alertHtml;

        // Auto-dismiss after 5 seconds for non-error messages
        if (type !== "danger") {
            setTimeout(() => {
                const alert = alertContainer.querySelector(".alert");
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        }
    }

    // Email validation
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Real-time validation
    emailInput.addEventListener("blur", function () {
        const email = this.value.trim();
        if (email && !isValidEmail(email)) {
            showFieldError(this, "Please enter a valid email address");
        } else if (email) {
            clearFieldError(this);
        }
    });

    passwordInput.addEventListener("blur", function () {
        const password = this.value;
        if (password && password.length < 6) {
            showFieldError(this, "Password must be at least 6 characters");
        } else if (password) {
            clearFieldError(this);
        }
    });

    // Clear errors on input
    emailInput.addEventListener("input", function () {
        if (this.classList.contains("is-invalid")) {
            this.classList.remove("is-invalid");
        }
    });

    passwordInput.addEventListener("input", function () {
        if (this.classList.contains("is-invalid")) {
            this.classList.remove("is-invalid");
        }
    });

    // Show demo credentials info
    setTimeout(() => {
        showAlert(
            `Demo credentials: <strong>admin@example.com</strong> / <strong>admin123</strong>`,
            "info"
        );
    }, 1000);
});
