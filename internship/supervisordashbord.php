<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Dashboard</title>
    <style>
        /* Your CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
            flex-grow: 1;
            text-align: center;
        }

        .logout-container {
            display: inline-block;
        }

        .logout-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #0056b3;
        }

        .dashboard-container {
            display: flex;
            justify-content: center;
        }

        .report-table-container {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 20px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        form {
            display: flex;
            align-items: center;
        }

        input[type="number"] {
            width: 60px;
            padding: 5px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            width: 100%;
            max-width: 300px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to Supervisor Dashboard <span class="logout-container"><a href="index.html" class="logout-btn">LogOut</a></span></h1>
    </header>
    <div class="dashboard-container">
        <div class="report-table-container">
            <h2>Submitted Reports</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Report ID</th>
                        <th>Student Name</th>
                        <th>Campus</th>
                        <th>Registration No</th>
                        <th>Report</th>
                        <th>Marks</th>
                        <th>Upload Date</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include database connection
                    include_once "db.php";

                    // Check if form is submitted for updating marks or remarks
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Check if updating marks
                        if (isset($_POST['marks'])) {
                            // Validate and sanitize inputs
                            $report_id = mysqli_real_escape_string($conn, $_POST['report_id']);
                            $marks = intval($_POST['marks']); // Ensure marks are integer

                            // Update marks in database
                            $update_sql = "UPDATE reports SET marks = $marks WHERE id = '$report_id'";
                            if (mysqli_query($conn, $update_sql)) {
                                echo "<div id='success-message' class='message success'>Marks updated successfully.</div>";
                            } else {
                                echo "<div id='error-message' class='message error'>Error updating marks: " . mysqli_error($conn) . "</div>";
                            }
                        }
                        // Check if adding remarks
                        elseif (isset($_POST['remarks'])) {
                            // Validate and sanitize inputs
                            $report_id = mysqli_real_escape_string($conn, $_POST['report_id']);
                            $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

                            // Update remarks in database
                            $update_remarks_sql = "UPDATE reports SET remarks = '$remarks' WHERE id = '$report_id'";
                            if (mysqli_query($conn, $update_remarks_sql)) {
                                echo "<div id='success-message' class='message success'>Remarks added successfully.</div>";
                            } else {
                                echo "<div id='error-message' class='message error'>Error adding remarks: " . mysqli_error($conn) . "</div>";
                            }
                        }
                    }

                    // Fetch reports data from database
                    $sql = "SELECT id, name, institution, regno, report_data, marks, upload_date, remarks FROM reports";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $count = 1; // Counter for numbering rows
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Extract data from each row
                            $report_id = $row['id'];
                            $name = $row['name'];
                            $campus = $row['institution'];
                            $reg_no = $row['regno'];
                            $report_file = $row['report_data'];
                            $marks = $row['marks'];
                            $upload_date = $row['upload_date'];
                            $remarks = $row['remarks'];

                            // Display each report row dynamically
                            echo "<tr>";
                            echo "<td>" . $count . "</td>";
                            echo "<td>" . htmlspecialchars($report_id) . "</td>";
                            echo "<td>" . htmlspecialchars($name) . "</td>";
                            echo "<td>" . htmlspecialchars($campus) . "</td>";
                            echo "<td>" . htmlspecialchars($reg_no) . "</td>";
                            echo "<td><a href='uploads/" . htmlspecialchars($report_file) . "' target='_blank'>View Report</a></td>";
                            echo "<td>" . htmlspecialchars($marks) . "</td>";
                            echo "<td>" . htmlspecialchars($upload_date) . "</td>";
                            echo "<td>";
                            if ($remarks) {
                                echo htmlspecialchars($remarks);
                            } else {
                                echo "<form action='supervisordashbord.php' method='post'>";
                                echo "<input type='hidden' name='report_id' value='" . htmlspecialchars($report_id) . "'>";
                                echo "<textarea name='remarks' placeholder='Add remarks...' required></textarea>";
                                echo "<button type='submit'>Add Remarks</button>";
                                echo "</form>";
                            }
                            echo "</td>";
                            echo "<td>";
                            echo "<form action='supervisordashbord.php' method='post'>";
                            echo "<input type='hidden' name='report_id' value='" . htmlspecialchars($report_id) . "'>";
                            echo "<input type='number' name='marks' min='0' max='100' value='" . htmlspecialchars($marks) . "' required>";
                            echo "<button type='submit'>Update Marks</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";

                            $count++; // Increment row counter
                        }
                    } else {
                        echo "<tr><td colspan='10'>No reports found.</td></tr>";
                    }

                    // Close database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Hide messages after 3 seconds
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
            document.getElementById('error-message').style.display = 'none';
        }, 3000);
    </script>
</body>

</html>