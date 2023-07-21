document.getElementById("signup_form").addEventListener("submit", (event) => {
    event.preventDefault();
    const user_name = document.getElementById("user_name").value;
    const user_email = document.getElementById("user_email").value;
    const user_password = document.getElementById("user_password").value;
    const user_password_conf = document.getElementById("user_password_conf").value;

    if (user_password !== user_password_conf) {
        alert("Passwords do not match!");
        event.preventDefault();
    } else {
        const dataToSend = {
            user_name: user_name,
            user_email: user_email,
            user_password: user_password
        };

        fetch('signup.php', {
            method: 'POST', // Use GET or POST based on your server's handling
            headers: {
                'Content-Type': 'application/json', // Sending JSON data
            },
            body: JSON.stringify(dataToSend), // Convert data to JSON format
        })
        .then(response => response.json()) // Parse the response as JSON
        .then(data => {
            if (data["status"]) {
                window.location.href = "welcome.php";
            } else {
                console.log(data["message"]);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
