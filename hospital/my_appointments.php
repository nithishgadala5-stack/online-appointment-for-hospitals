<?php

session_start();

include "config/database.php";

if (!isset($_SESSION["patient_id"])) {
    header("Location: login.php");
    exit();
}

$patient_id = $_SESSION["patient_id"];

$sql = "SELECT 
            appointments.appointment_id,
            appointments.appointment_date,
            appointments.appointment_time,
            appointments.status,
            doctors.name AS doctor_name,
            doctors.specialization
        FROM appointments
        INNER JOIN doctors
        ON appointments.doctor_id = doctors.doctor_id
        WHERE appointments.patient_id = ?
        ORDER BY appointments.appointment_date DESC,
                 appointments.appointment_time DESC";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $patient_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html>

<head>

    <title>My Appointments</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f9fc;
        }

        header {
            background-color: #0077b6;
            color: white;
            text-align: center;
            padding: 25px;
        }

        .container {
            width: 90%;
            margin: 40px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 8px #ccc;
        }

        th {
            background-color: #023e8a;
            color: white;
            padding: 15px;
        }

        td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f1f9fc;
        }

        .pending {
            color: orange;
            font-weight: bold;
        }

        .confirmed {
            color: green;
            font-weight: bold;
        }

        .cancelled {
            color: red;
            font-weight: bold;
        }

        .completed {
            color: blue;
            font-weight: bold;
        }

        .back {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 20px;
            background-color: #0077b6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

    </style>

</head>

<body>

<header>

    <h1>📋 My Appointments</h1>

    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION["patient_name"]); ?>
    </p>

</header>

<div class="container">

<?php

if (mysqli_num_rows($result) > 0) {

?>

    <table>

        <tr>

            <th>Doctor</th>
            <th>Specialization</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Action</th>

        </tr>

<?php

    while ($appointment = mysqli_fetch_assoc($result)) {

        $status = strtolower($appointment["status"]);

?>

        <tr>

            <td>
                <?php
                echo htmlspecialchars($appointment["doctor_name"]);
                ?>
            </td>

            <td>
                <?php
                echo htmlspecialchars($appointment["specialization"]);
                ?>
            </td>

            <td>
                <?php
                echo htmlspecialchars($appointment["appointment_date"]);
                ?>
            </td>

            <td>
                <?php
                echo htmlspecialchars($appointment["appointment_time"]);
                ?>
            </td>

            <td class="<?php echo $status; ?>">

                <?php
                echo htmlspecialchars($appointment["status"]);
                ?>

            </td>
          
           <td>

    <?php if ($appointment["status"] != "Cancelled") { ?>

        <a
            href="cancel_appointment.php?id=<?php echo $appointment["appointment_id"]; ?>"
            onclick="return confirm('Are you sure you want to cancel this appointment?');"
        >
            Cancel
        </a>

    <?php } else { ?>

        Cancelled

    <?php } ?>

</td>

        </tr>

<?php

    }

?>

    </table>

<?php

} else {

    echo "<h2>No appointments found.</h2>";

}

?>

<a class="back" href="patient_dashboard.php">
    ← Back to Dashboard
</a>

</div>

</body>

</html>