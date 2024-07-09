<?php
// Include database connection
include_once "db.php";

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $campus = mysqli_real_escape_string($conn, $_POST['campus']);
    $reg_no = mysqli_real_escape_string($conn, $_POST['reg_no']);

    // File handling
    $file_name = $_FILES['report']['name'];
    $file_tmp = $_FILES['report']['tmp_name'];
    $file_type = $_FILES['report']['type'];
    $file_size = $_FILES['report']['size'];

    // Check if file is a PDF
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if ($file_ext != "pdf") {
        echo "Error: Only PDF files are allowed.";
        exit;
    }

    // Generate unique ID
    $unique_id = "RPT" . sprintf('%04d', mt_rand(1, 9999));

    // Move uploaded file to desired location (optional)
    // Example: move_uploaded_file($file_tmp, "uploads/" . $file_name);

    // SQL query to insert data into database
    // Assuming 'reports' table structure: id (auto-increment), name, institution, regno, report, upload_date
    $sql = "INSERT INTO reports (id, name, institution, regno, report_data, upload_date) 
            VALUES ('$unique_id', '$name', '$campus', '$reg_no', '$file_name', NOW())";

    if (mysqli_query($conn, $sql)) {
        // Close database connection
        mysqli_close($conn);

        // Redirect to studentdashboard.php after successful submission
        header("Location: studentdashbord.php");
        exit; // Ensure script stops here after redirection
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
