<?php
include "config/db.php";

$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM documents");
$data = mysqli_fetch_assoc($result);

$total_documents = $data['total'];
$result_users = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$data_users = mysqli_fetch_assoc($result_users);

$total_users = $data_users['total'];
$result_departments = mysqli_query($conn, "SELECT COUNT(*) AS total FROM departments");
$data_departments = mysqli_fetch_assoc($result_departments);

$total_departments = $data_departments['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Government Documents Management System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="dashboard-layout">

    <!-- Sidebar -->
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

    <!-- Main Content -->
    <div class="dashboard">

        <h1>Government Documents Management System</h1>
        <p>Welcome to the Dashboard</p>

        <div class="dashboard-cards">

            <div class="card">
                <h3>Total Documents</h3>
                <p><?php echo $total_documents;?></p>
            </div>

            <div class="card">
                <h3>Users</h3>
                <p><?php echo $total_users;?></p>
            </div>

            <div class="card">
                <h3>Departments</h3>
                <p><?php echo $total_departments;?></p>
            </div>

        </div>

    </div>

</div>

</body>
</html>