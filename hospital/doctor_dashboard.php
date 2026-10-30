<?php

session_start();

include "config/database.php";

if (!isset($_SESSION["doctor_id"])) {
    header("Location: doctor_login.php");
    exit();
}

$doctor_id = $_SESSION["doctor_id"];

$sql = "SELECT
            appointments.appointment_id,
            appointments.appointment_date,
            appointments.appointment_time,
            appointments.status,
            patients.name AS patient_name,
            patients.email AS patient_email,
            patients.phone AS patient_phone
        FROM appointments
        INNER JOIN patients
            ON appointments.patient_id = patients.patient_id
        WHERE appointments.doctor_id = ?
        ORDER BY appointments.appointment_date ASC,
                 appointments.appointment_time ASC";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $doctor_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Doctor Dashboard</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f9fc;
        }

        header {
            background-color: #0077b6;
            color: white;
            padding: 25px;
        }

        .logout {
            float: right;
            color: white;
        }

        .container {
            width: 95%;
            margin: 35px auto;
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
            padding: 12px;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .pending {
            color: orange;
            font-weight: bold;
        }

        .confirmed {
            color: green;
            font-weight: bold;
        }

        .completed {
            color: blue;
            font-weight: bold;
        }

        .cancelled {
            color: red;
            font-weight: bold;
        }

        select {
            padding: 7px;
        }

        button {
            padding: 7px 12px;
            background-color: #0077b6;
            color: white;
            border: none;
            border-radius: 4px;
        }

    </style>

</head>

<body>

<header>

    <a class="logout" href="doctor_logout.php">
        Logout
    </a>

    <h1>👨‍⚕️ Doctor Dashboard</h1>

    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION["doctor_name"]); ?>
    </p>

</header>

<div class="container">

    <h2>My Appointments</h2>

    <?php if (mysqli_num_rows($result) > 0) { ?>

    <table>

        <tr>

            <th>Patient</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Update</th>

        </tr>

        <?php while ($appointment = mysqli_fetch_assoc($result)) { ?>

        <tr>

            <td>
                <?php echo htmlspecialchars($appointment["patient_name"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($appointment["patient_email"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($appointment["patient_phone"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($appointment["appointment_date"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($appointment["appointment_time"]); ?>
            </td>

            <td class="<?php echo strtolower($appointment["status"]); ?>">

                <?php echo htmlspecialchars($appointment["status"]); ?>

            </td>

            <td>

                <form method="POST" action="doctor_update_status.php">

                    <input
                        type="hidden"
                        name="appointment_id"
                        value="<?php echo $appointment["appointment_id"]; ?>"
                    >

                    <select name="status">

                        <option value="Pending">
                            Pending
                        </option>

                        <option value="Confirmed">
                            Confirmed
                        </option>

                        <option value="Completed">
                            Completed
                        </option>

                        <option value="Cancelled">
                            Cancelled
                        </option>

                    </select>

                    <button type="submit">
                        Update
                    </button>

                </form>

            </td>

        </tr>

        <?php } ?>

    </table>

    <?php } else { ?>

        <h3>No appointments assigned to you.</h3>

    <?php } ?>

</div>

</body>

</html>