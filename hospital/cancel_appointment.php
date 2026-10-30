<?php

session_start();

include "config/database.php";

if (!isset($_SESSION["patient_id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"])) {

    $appointment_id = $_GET["id"];
    $patient_id = $_SESSION["patient_id"];

    $sql = "UPDATE appointments
            SET status = 'Cancelled'
            WHERE appointment_id = ?
            AND patient_id = ?
            AND status != 'Cancelled'";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ii",
        $appointment_id,
        $patient_id
    );

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

header("Location: my_appointments.php");
exit();

?>