<?php
include "config/db.php";

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM documents WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $document_name = $_POST['document_name'];
    $document_number = $_POST['document_number'];
    $department = $_POST['department'];
    $document_date = $_POST['document_date'];
    $status = $_POST['status'];

    $sql = "UPDATE documents SET
            Document_Name='$document_name',
            Document_Number='$document_number',
            Department='$department',
            Document_Date='$document_date',
            Status='$status'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: documents.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Document</title>

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="dashboard-layout">

    <div class="sidebar">

        <h2>Government System</h2>

        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="documents.php">📄 Documents</a>
        <a href="users.php">👤 Users</a>
        <a href="departments.php">🏢 Departments</a>
        <a href="reports.php">📊 Reports</a>
        <a href="settings.php">⚙️ Settings</a>
        <a href="#">🚪 Logout</a>

    </div>

    <div class="dashboard">

        <h1>Edit Document</h1>

        <p>Update document information here.</p>

        <div class="document-form">

            <h2>Edit Document Details</h2>

            <form method="POST">

                <label>Document Name</label>

                <input
                    type="text"
                    name="document_name"
                    value="<?php echo $row['Document_Name']; ?>"
                    required
                >

                <label>Document Number</label>

                <input
                    type="text"
                    name="document_number"
                    value="<?php echo $row['Document_Number']; ?>"
                    required
                >

                <label>Department</label>

                <select name="department" required>

                    <option value="<?php echo $row['Department']; ?>">
                        <?php echo $row['Department']; ?>
                    </option>

                    <option value="Human Resources">
                        Human Resources
                    </option>

                    <option value="Finance">
                        Finance
                    </option>

                    <option value="Administration">
                        Administration
                    </option>

                </select>

                <label>Date</label>

                <input
                    type="date"
                    name="document_date"
                    value="<?php echo $row['Document_Date']; ?>"
                    required
                >

                <label>Status</label>

                <select name="status" required>

                    <option value="<?php echo $row['Status']; ?>">
                        <?php echo $row['Status']; ?>
                    </option>

                    <option value="Pending">
                        Pending
                    </option>

                    <option value="Approved">
                        Approved
                    </option>

                    <option value="Completed">
                        Completed
                    </option>

                </select>

                <button type="submit">
                    Update Document
                </button>

            </form>

        </div>

    </div>

</div>

</body>

</html>