<?php

include "config/db.php";

$success = "";
$error = "";

/* =========================
   SAVE DOCUMENT
========================= */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $document_name = $_POST['document_name'];
    $document_number = $_POST['document_number'];
    $department = $_POST['department'];
    $document_date = $_POST['document_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO documents
            (Document_Name, Document_Number, Department, Document_Date, Status)
            VALUES
            ('$document_name', '$document_number', '$department', '$document_date', '$status')";

    if (mysqli_query($conn, $sql)) {

        header("Location: documents.php?saved=1");
        exit;

    } else {

        $error = "Error: " . mysqli_error($conn);

    }
}


/* =========================
   SUCCESS MESSAGE
========================= */

if (isset($_GET['saved']) && $_GET['saved'] == "1") {

    $success = "Document saved successfully!";

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Documents - Government Documents Management System</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>

        /* ACTION BUTTONS */

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .edit-btn,
        .delete-btn {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .edit-btn {
            background: #1976d2;
            color: white;
        }

        .edit-btn:hover {
            background: #0d47a1;
        }

        .delete-btn {
            background: #d32f2f;
            color: white;
        }

        .delete-btn:hover {
            background: #b71c1c;
        }

    </style>

</head>


<body>


<!-- SUCCESS MESSAGE -->

<?php if ($success != "") { ?>

    <div class="success-message">
        ✓ <?php echo $success; ?>
    </div>

<?php } ?>


<!-- HIDE SUCCESS MESSAGE AFTER 3 SECONDS -->

<script>

setTimeout(function() {

    const message = document.querySelector('.success-message');

    if (message) {
        message.style.display = 'none';
    }

}, 3000);

</script>


<div class="dashboard-layout">


    <!-- =========================
         SIDEBAR
    ========================== -->

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


    <!-- =========================
         MAIN CONTENT
    ========================== -->

    <div class="dashboard">

        <h1>Documents Management</h1>

        <p>Manage government documents here.</p>


        <!-- =========================
             ADD DOCUMENT FORM
        ========================== -->

        <div class="document-form">

            <h2>Add New Document</h2>

            <form method="POST">


                <label>Document Name</label>

                <input
                    type="text"
                    name="document_name"
                    placeholder="Enter document name"
                    required
                >


                <label>Document Number</label>

                <input
                    type="text"
                    name="document_number"
                    placeholder="Enter document number"
                    required
                >


                <label>Department</label>

                <select name="department" required>

                    <option value="">
                        Select Department
                    </option>

                    <?php

$departments = mysqli_query(
    $conn,
    "SELECT * FROM departments ORDER BY Department_Name ASC"
);

while ($department = mysqli_fetch_assoc($departments)) {

?>

    <option value="<?php echo $department['Department_Name']; ?>">
        <?php echo $department['Department_Name']; ?>
    </option>

<?php

}

?>

                </select>


                <label>Date</label>

                <input
                    type="date"
                    name="document_date"
                    required
                >


                <label>Status</label>

                <select name="status" required>

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
                    Save Document
                </button>


            </form>

        </div>


        <!-- =========================
             SAVED DOCUMENTS
        ========================== -->

        <h2 class="documents-title">
            Saved Documents
        </h2>


        <table class="documents-table">

            <tr>

                <th>Document Name</th>

                <th>Document Number</th>

                <th>Department</th>

                <th>Date</th>

                <th>Status</th>

                <th>Actions</th>

            </tr>


<?php

$result = mysqli_query(
    $conn,
    "SELECT * FROM documents ORDER BY id DESC"
);

if ($result && mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

?>

            <tr>

                <td>
                    <?php echo $row['Document_Name']; ?>
                </td>

                <td>
                    <?php echo $row['Document_Number']; ?>
                </td>

                <td>
                    <?php echo $row['Department']; ?>
                </td>

                <td>
                    <?php echo $row['Document_Date']; ?>
                </td>

                <td>
                    <?php echo $row['Status']; ?>
                </td>

                <td>

                    <div class="action-buttons">

                        <a
                            class="edit-btn"
                            href="edit_document.php?id=<?php echo $row['id']; ?>"
                        >
                            Edit
                        </a>

                        <a
                            class="delete-btn"
                            href="delete_document.php?id=<?php echo $row['id']; ?>"
                        >
                            Delete
                        </a>

                    </div>

                </td>

            </tr>

<?php

    }

} else {

?>

            <tr>

                <td colspan="6">
                    No documents found.
                </td>

            </tr>

<?php

}

?>

        </table>


    </div>

</div>


</body>

</html>