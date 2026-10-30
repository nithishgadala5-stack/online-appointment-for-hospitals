<?php

session_start();

include "config/database.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $appointment_id = (int) $_POST["appointment_id"];
    $status = $_POST["status"];

    $allowed_statuses = [
        "Pending",
        "Confirmed",
        "Completed",
        "Cancelled"
    ];

    if (in_array($status, $allowed_statuses, true)) {

        $sql = "UPDATE appointments
                SET status = ?
                WHERE appointment_id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $status,
            $appointment_id
        );

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }
}

header("Location: admin_appointments.php");
exit();

?>