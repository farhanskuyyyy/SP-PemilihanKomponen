document.addEventListener("DOMContentLoaded", function () {
    // Form elements
    const registerForm = document.getElementById("registerForm");
    const alertContainer = document.getElementById("alertContainer");

    // Form inputs
    const inputs = {
        username: document.getElementById("username"),
        email: document.getElementById("email"),
        password: document.getElementById("password"),
        confirmPassword: document.getElementById("confirmPassword"),
        agreeTerms: document.getElementById("agreeTerms"),
    };

    // Password toggles
    const togglePassword = document.getElementById("togglePassword");
    const toggleConfirmPassword = document.getElementById(
        "toggleConfirmPassword"
    );
    const registerBtn = document.getElementById("registerBtn");

    // Success modal
    const successModal = new bootstrap.Modal(
        document.getElementById("successModal")
    );

    // Registered users storage (simulating database)
    let registeredUsers =
        JSON.parse(localStorage.getItem("registeredUsers")) || [];

    // Password toggle functionality
    togglePassword.addEventListener("click", function () {
        togglePasswordVisibility(inputs.password, this);
    });

    toggleConfirmPassword.addEventListener("click", function () {
        togglePasswordVisibility(inputs.confirmPassword, this);
    });

    // Form submission
    registerForm.addEventListener("submit", function (e) {
        // e.preventDefault();

        // if (validateForm()) {
        //     performRegistration();
        // }
    });

    // Real-time validation
    setupRealTimeValidation();

    // Password strength checker
    inputs.password.addEventListener("input", function () {
        checkPasswordStrength(this.value);
    });

    // Functions
    function togglePasswordVisibility(input, button) {
        const type =
            input.getAttribute("type") === "password" ? "text" : "password";
        input.setAttribute("type", type);

        const icon = button.querySelector("i");
        icon.classList.toggle("bi-eye");
        icon.classList.toggle("bi-eye-slash");
    }

    function validateForm() {
        let isValid = true;

        // Clear previous errors
        clearAllErrors();

        // Validate all fields
        const fieldsToValidate = [
            "username",
            "email",
            "password",
            "confirmPassword",
        ];
        fieldsToValidate.forEach((field) => {
            if (!validateField(field)) {
                isValid = false;
            }
        });

        // Validate terms agreement
        if (!inputs.agreeTerms.checked) {
            showFieldError(
                inputs.agreeTerms,
                "You must agree to the terms and conditions"
            );
            isValid = false;
        } else {
            clearFieldError(inputs.agreeTerms);
        }

        return isValid;
    }

    function validateField(fieldName) {
        const field = inputs[fieldName];
        const value = field.value.trim();

        // Clear previous validation
        clearFieldError(field);

        switch (fieldName) {
            case "username":
                if (!value) {
                    showFieldError(field, "Username is required");
                    return false;
                } else if (value.length < 3) {
                    showFieldError(
                        field,
                        "Username must be at least 3 characters"
                    );
                    return false;
                } else if (!/^[a-zA-Z0-9_]+$/.test(value)) {
                    showFieldError(
                        field,
                        "Username can only contain letters, numbers, and underscores"
                    );
                    return false;
                } else if (isUsernameTaken(value)) {
                    showFieldError(field, "This username is already taken");
                    return false;
                }
                break;

            case "email":
                if (!value) {
                    showFieldError(field, "Email is required");
                    return false;
                } else if (!isValidEmail(value)) {
                    showFieldError(field, "Please enter a valid email address");
                    return false;
                } else if (isEmailTaken(value)) {
                    showFieldError(field, "This email is already registered");
                    return false;
                }
                break;

            case "password":
                if (!value) {
                    showFieldError(field, "Password is required");
                    return false;
                } else if (value.length < 8) {
                    showFieldError(
                        field,
                        "Password must be at least 8 characters"
                    );
                    return false;
                } else if (!isStrongPassword(value)) {
                    showFieldError(
                        field,
                        "Password must contain uppercase, lowercase, number, and special character"
                    );
                    return false;
                }
                break;

            case "confirmPassword":
                if (!value) {
                    showFieldError(field, "Please confirm your password");
                    return false;
                } else if (value !== inputs.password.value) {
                    showFieldError(field, "Passwords do not match");
                    return false;
                }
                break;
        }

        showFieldSuccess(field);
        return true;
    }

    function setupRealTimeValidation() {
        Object.keys(inputs).forEach((fieldName) => {
            const field = inputs[fieldName];
            if (field.type !== "checkbox") {
                field.addEventListener("blur", function () {
                    validateField(fieldName);
                });

                field.addEventListener("input", function () {
                    if (field.classList.contains("is-invalid")) {
                        validateField(fieldName);
                    }
                });
            }
        });
    }

    function checkPasswordStrength(password) {
        const strengthText = document.getElementById("strengthText");
        const strengthLevel = document.getElementById("strengthLevel");
        const strengthFill = document.getElementById("strengthFill");

        let strength = 0;
        let strengthLabel = "";

        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;

        strengthFill.className = "strength-fill";

        switch (strength) {
            case 0:
            case 1:
                strengthLabel = "Very Weak";
                strengthFill.classList.add("strength-weak");
                break;
            case 2:
                strengthLabel = "Weak";
                strengthFill.classList.add("strength-weak");
                break;
            case 3:
                strengthLabel = "Fair";
                strengthFill.classList.add("strength-fair");
                break;
            case 4:
                strengthLabel = "Good";
                strengthFill.classList.add("strength-good");
                break;
            case 5:
                strengthLabel = "Strong";
                strengthFill.classList.add("strength-strong");
                break;
        }

        strengthLevel.textContent = strengthLabel;
    }

    function performRegistration() {
        setLoadingState(true);

        // Simulate API call delay
        setTimeout(() => {
            const userData = {
                id: Date.now(),
                username: inputs.username.value.trim(),
                email: inputs.email.value.trim(),
                password: inputs.password.value, // In real app, this would be hashed
                createdAt: new Date().toISOString(),
                status: "Active",
            };

            // Save to localStorage (simulating database)
            registeredUsers.push(userData);
            localStorage.setItem(
                "registeredUsers",
                JSON.stringify(registeredUsers)
            );

            setLoadingState(false);
            successModal.show();
        }, 2000);
    }

    function setLoadingState(loading) {
        const btnText = registerBtn.querySelector(".btn-text");

        if (loading) {
            registerBtn.classList.add("loading");
            btnText.innerHTML =
                '<span class="spinner"></span>Creating Account...';
            registerBtn.disabled = true;
        } else {
            registerBtn.classList.remove("loading");
            btnText.innerHTML = "Create Account";
            registerBtn.disabled = false;
        }
    }

    function showFieldError(field, message) {
        field.classList.add("is-invalid");
        field.classList.remove("is-valid");
        const feedback = field.parentNode.querySelector(".invalid-feedback");
        if (feedback) {
            feedback.textContent = message;
        }
    }

    function showFieldSuccess(field) {
        field.classList.remove("is-invalid");
        field.classList.add("is-valid");
        const feedback = field.parentNode.querySelector(".invalid-feedback");
        if (feedback) {
            feedback.textContent = "";
        }
    }

    function clearFieldError(field) {
        field.classList.remove("is-invalid", "is-valid");
        const feedback = field.parentNode.querySelector(".invalid-feedback");
        if (feedback) {
            feedback.textContent = "";
        }
    }

    function clearAllErrors() {
        const inputFields = [
            inputs.username,
            inputs.email,
            inputs.password,
            inputs.confirmPassword,
        ];
        inputFields.forEach((input) => {
            input.classList.remove("is-invalid", "is-valid");
            const feedback =
                input.parentNode.querySelector(".invalid-feedback");
            if (feedback) {
                feedback.textContent = "";
            }
        });
    }

    function showAlert(message, type) {
        const alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
        alertContainer.innerHTML = alertHtml;

        setTimeout(() => {
            const alert = alertContainer.querySelector(".alert");
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    }

    // Validation helper functions
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isStrongPassword(password) {
        return (
            password.length >= 8 &&
            /[a-z]/.test(password) &&
            /[A-Z]/.test(password) &&
            /[0-9]/.test(password) &&
            /[^A-Za-z0-9]/.test(password)
        );
    }

    function isEmailTaken(email) {
        return registeredUsers.some(
            (user) => user.email.toLowerCase() === email.toLowerCase()
        );
    }

    function isUsernameTaken(username) {
        return registeredUsers.some(
            (user) => user.username.toLowerCase() === username.toLowerCase()
        );
    }
});
