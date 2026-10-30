<?php

session_start();

include "config/database.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET["id"])) {

    $doctor_id = (int) $_GET["id"];

    $sql = "DELETE FROM doctors
            WHERE doctor_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $doctor_id
    );

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

header("Location: admin_doctors.php");
exit();

?>