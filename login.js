document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("login-form");
    loginForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();
        
        // Prepare data for login
        const loginData = { username: username, password: password };

        fetch("admin_login.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(loginData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect to the main page (or refresh current page)
                window.location.href = "index2.html"; // adjust as needed
            } else {
                alert(data.error || "Login failed");
            }
        })
        .catch(err => {
            console.error("Login error:", err);
            alert("An error occurred during login.");
        });
    });
});
