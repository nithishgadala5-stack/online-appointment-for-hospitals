<?php

session_start();

include "config/database.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

$patients_result = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM patients"
);

$patients = mysqli_fetch_assoc($patients_result)["total"];

$doctors_result = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM doctors"
);

$doctors = mysqli_fetch_assoc($doctors_result)["total"];

$appointments_result = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM appointments"
);

$appointments = mysqli_fetch_assoc($appointments_result)["total"];

?>

<!DOCTYPE html>
<html>

<head>

    <title>Admin Dashboard</title>

    <style>

        <style>

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f4f9fc;
    }

    header {
        background-color: #023e8a;
        color: white;
        padding: 25px;
    }

    .container {
        width: 90%;
        margin: 40px auto;
        text-align: center;
    }

    .card {
        display: inline-block;
        width: 220px;
        margin: 15px;
        padding: 30px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px #ccc;
    }

    .card h2 {
        color: #0077b6;
    }

    .number {
        font-size: 35px;
        font-weight: bold;
        color: #023e8a;
    }

    .logout {
        color: white;
        float: right;
    }

    .card a {
        display: inline-block;
        margin-top: 15px;
        padding: 10px 15px;
        background-color: #0077b6;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

</style>

</head>

<body>

<header>

    <a class="logout" href="admin_logout.php">
        Logout
    </a>

    <h1>🏥 Admin Dashboard</h1>

    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION["admin_name"]); ?>
    </p>

</header>

<div class="container">

    <div class="card">

        <h2>👤 Patients</h2>

        <div class="number">
            <?php echo $patients; ?>
        </div>

    </div>

   <div class="card">

    <h2>👨‍⚕️ Doctors</h2>

    <div class="number">
        <?php echo $doctors; ?>
    </div>

    <a href="admin_doctors.php">
        Manage Doctors
    </a>

</div>

    </div>

    <div class="card">

        <h2>📅 Appointments</h2>

        <div class="number">
            <?php echo $appointments; ?>
        </div>

      <a href="admin_appointments.php">
        Manage Appointments
    </a>

    </div>

</div>

</body>

</html>