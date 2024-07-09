<?php
// Start a session
session_start();

// Include database connection
include_once "db.php";

// Fetch POST data
$email = $_POST['email'];
$password = $_POST['password'];

// Sanitize inputs (optional, but recommended)
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

// Query to fetch user details
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, proceed with authentication
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $type = $row['type'];

    if ($type === "student") {
        // Redirect to student dashboard
        header("Location: studentdashbord.html");
        exit();
    } elseif ($type === "supervisor") {
        // Redirect to supervisor dashboard
        header("Location: supervisordashbord.html");
        exit();
    } elseif ($type === "administrator") {
        // Redirect to admin dashboard
        header("Location: admindashbord.html");
        exit();
    } else {
        // Invalid user type
        echo "Invalid user type.";
    }
} else {
    // User not found or incorrect credentials
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Authentication</title>
        <style>
            .dialog-container {
                background-color: #f9f9f9;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 20px;
                width: 300px;
                margin: 100px auto;
                text-align: center;
            }

            .dialog-container h2 {
                margin-top: 0;
            }

            .dialog-button {
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <div class="dialog-container">
            <h2>User not found or incorrect credentials.</h2>
            <p>Please try again.</p>
            <button class="dialog-button" onclick="goToLoginPage()">Back to Login</button>
        </div>
        <script>
            function goToLoginPage() {
                window.location.href = "login.html";
            }
        </script>
    </body>

    </html>
<?php
}

// Close connection
$conn->close();
?>