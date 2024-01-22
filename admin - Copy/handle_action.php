<?php
include('include/config.php');

// Function to fetch complaints from the database
function getComplaints() {
    global $bd;
    $result = mysqli_query($bd, "SELECT * FROM tblcomplaints");
    $complaints = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $complaints;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $complaintNumber = $_POST['complaintNumber'];
   $action = $_POST['action'];

   if ($action == 'approve') {
      // Implement code for approval if needed
      // Update the status or perform other actions
      mysqli_query($bd, "UPDATE tblcomplaints SET status = 'approved' WHERE complaintNumber = '$complaintNumber'");
      echo 'Action approved successfully.';
   } elseif ($action == 'reject') {
      // Implement code for rejection
      // Update the status or perform other actions for rejection
      mysqli_query($bd, "UPDATE tblcomplaints SET status = 'rejected' WHERE complaintNumber = '$complaintNumber'");
      echo 'Action rejected successfully.';
   }
}

// Display the list of complaints in the admin interface
$complaints = getComplaints();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Interface</title>
</head>
<body>

<h1>Complaints</h1>

<table border="1">
    <tr>
        <th>Complaint Number</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php foreach ($complaints as $complaint): ?>
        <tr>
            <td><?= $complaint['complaintNumber'] ?></td>
            <td><?= $complaint['status'] ?></td>
            <td>
                <!-- Add form and buttons for approval and rejection -->
                <form method="post" action="">
                    <input type="hidden" name="complaintNumber" value="<?= $complaint['complaintNumber'] ?>">
                    <button type="submit" name="action" value="approve">Approve</button>
                    <button type="submit" name="action" value="reject">Reject</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
