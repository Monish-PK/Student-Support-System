<?php
session_start();
include('include/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    // Your existing code

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        // Handle other form data

        // Handle file upload
        if (isset($_FILES['compfile']) && $_FILES['compfile']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/'; // Specify your upload directory
            $uploadFile = $uploadDir . basename($_FILES['compfile']['name']);

            if (move_uploaded_file($_FILES['compfile']['tmp_name'], $uploadFile)) {
                // File upload successful, now insert data into database
                $complaintNumber = $_POST['complaintNumber'];
                $regDate = $_POST['regDate'];
                $status = $_POST['status'];

                // Add the file path to your database
                $file_path = $uploadFile;

                $insertQuery = "INSERT INTO complaints (complaintNumber, regDate, status, file_path)
                                VALUES ('$complaintNumber', '$regDate', '$status', '$file_path')";

                mysqli_query($bd, $insertQuery);

                // Handle other actions if needed
            } else {
                echo "Error uploading file.";
            }
        }
    }

    // Rest of your existing code
}
?>
