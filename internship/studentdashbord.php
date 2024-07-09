<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        /* Your CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .dashboard-container {
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }

        .report-form-container,
        .marks-table-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 48%;
        }

        h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="file"],
        input[type="number"],
        select {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
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

        h1 {
            margin: 0;
            flex-grow: 1;
            text-align: center;
            border-bottom: 2px solid #cccc;
        }

        .logout-container {
            display: inline-block;
            margin-left: 100px;
        }

        .logout-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Welcome to Student Dashboard <span class="logout-container"><a href="index.html" class="logout-btn">LogOut</a></span></h1>
    <div class="dashboard-container">
        <div class="report-form-container">
            <h2>Submit Report</h2>
            <form action="process_insert_report.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="campus">Institution:</label>
                    <input type="text" id="campus" name="campus" required>
                </div>
                <div class="form-group">
                    <label for="reg_no">Registration No:</label>
                    <input type="text" id="reg_no" name="reg_no" required>
                </div>
                <div class="form-group">
                    <label for="report">Report (PDF):</label>
                    <input type="file" id="report" name="report" accept="application/pdf" required>
                </div>
                <button type="submit">Submit Report</button>
            </form>
        </div>
        <div class="marks-table-container">
            <h2>View Marks and Remarks</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Report ID</th>
                        <th>Marks</th>
                        <th>Upload Date</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include database connection
                    include_once "db.php";

                    // Fetch marks and remarks data from database
                    $sql = "SELECT id, marks, upload_date, remarks FROM reports";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $count = 1; // Counter for numbering rows
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Extract data from each row
                            $report_id = $row['id'];
                            $marks = $row['marks'];
                            $upload_date = $row['upload_date'];
                            $remarks = $row['remarks'];

                            // Display each marks and remarks row dynamically
                            echo "<tr>";
                            echo "<td>" . $count . "</td>";
                            echo "<td>" . htmlspecialchars($report_id) . "</td>";
                            echo "<td>" . htmlspecialchars($marks) . "</td>";
                            echo "<td>" . htmlspecialchars($upload_date) . "</td>";
                            echo "<td>";
                            if ($remarks) {
                                echo htmlspecialchars($remarks);
                            } else {
                                echo "No remarks yet.";
                            }
                            echo "</td>";
                            echo "</tr>";

                            $count++; // Increment row counter
                        }
                    } else {
                        echo "<tr><td colspan='5'>No records found.</td></tr>";
                    }

                    // Close database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>