<?php

session_start();

if (!isset($_SESSION["patient_id"])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Patient Dashboard</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f9fc;
        }

        header {
            background-color: #0077b6;
            color: white;
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: 40px auto;
        }

        .card {
            display: inline-block;
            width: 250px;
            margin: 15px;
            padding: 30px;
            background: white;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 2px 8px #ccc;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #0077b6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

    </style>

</head>

<body>

<header>

    <h1>Patient Dashboard</h1>

    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION["patient_name"]); ?>!
    </p>

</header>

<div class="container">

    <div class="card">

        <h2>👨‍⚕️ Doctors</h2>

        <p>Find available doctors.</p>

        <a href="#">View Doctors</a>

    </div>

    <div class="card">

        <h2>📅 Appointment</h2>

        <p>Book your hospital appointment.</p>

        <a href="book_appointment.php">Book Appointment</a>

    </div>

    <div class="card">

        <h2>📋 My Appointments</h2>

        <p>View your appointments.</p>

        <a href="my_appointments.php">View Appointments</a>

    </div>

    <div class="card">

        <h2>🚪 Logout</h2>

        <p>Logout from your account.</p>

        <a href="logout.php">Logout</a>

    </div>

</div>

</body>

</html>