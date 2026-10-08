<?php

include "config/db.php";

$id = $_GET['id'];

$sql = "DELETE FROM documents WHERE id=$id";

if (mysqli_query($conn, $sql)) {

    header("Location: documents.php");
    exit;

} else {

    echo "Error: " . mysqli_error($conn);

}

?>