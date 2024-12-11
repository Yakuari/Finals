document.addEventListener("DOMContentLoaded", function () {
    const showLoginBtn = document.querySelector("#show-login");
    const showSignupBtn = document.querySelector("#show-signup");
    const loginPopup = document.querySelector(".popup.login-popup");
    const signupPopup = document.querySelector(".popup.signup-popup");
    const closeBtns = document.querySelectorAll(".popup .close-btn");

    // Function to close all popups
    function closeAllPopups() {
        loginPopup?.classList.remove("active");
        signupPopup?.classList.remove("active");
    }

    // Toggle popup visibility
    function togglePopup(popup) {
        if (popup.classList.contains("active")) {
            popup.classList.remove("active"); // Close the popup if already active
        } else {
            closeAllPopups(); // Close any other active popups
            popup.classList.add("active"); // Open the designated popup
        }
    }

    // Event listeners for opening popups
    showLoginBtn?.addEventListener("click", function () {
        togglePopup(loginPopup);
    });

    showSignupBtn?.addEventListener("click", function () {
        togglePopup(signupPopup);
    });

    // Event listeners for closing popups
    closeBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
            const popup = this.closest(".popup");
            popup?.classList.remove("active");
        });
    });

    // Close popup when clicking outside
    document.addEventListener("click", function (event) {
        if (
            !event.target.closest(".popup") &&
            !event.target.matches("#show-login") &&
            !event.target.matches("#show-signup")
        ) {
            closeAllPopups();
        }
    });

    // Smooth scrolling for home link
    const homeLink = document.querySelector('.nav-links li a[href="index.php"]');
    if (homeLink) {
        homeLink.addEventListener("click", (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    }
});