<?php
include_once "db.php";

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm-password'];
$type = $_POST['type'];

// Validate password match
if ($password !== $confirmPassword) {
    echo "Error: Passwords do not match";
    exit;
}

// Insert data into database
$sql = "INSERT INTO Users (name, email, phone, password, type) 
        VALUES ('$fullname', '$email', '$phone', '$password', '$type')";
if ($conn->query($sql) === TRUE) {
    // Registration successful, show dialog
    echo '<!DOCTYPE html>
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
            <h2>Registration Successful!</h2>
            <p>Your account has been registered.</p>
            <button class="dialog-button" onclick="goToLoginPage()">Go to Login</button>
        </div>
        <script>
            function goToLoginPage() {
                window.location.href = "login.html";
            }
        </script>
    </body>
    
    </html>';
} else {
    // Error in SQL query
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
