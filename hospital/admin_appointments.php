<?php

session_start();

include "config/database.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT
            appointments.appointment_id,
            appointments.appointment_date,
            appointments.appointment_time,
            appointments.status,
            patients.name AS patient_name,
            patients.email AS patient_email,
            patients.phone AS patient_phone,
            doctors.name AS doctor_name,
            doctors.specialization
        FROM appointments
        INNER JOIN patients
            ON appointments.patient_id = patients.patient_id
        INNER JOIN doctors
            ON appointments.doctor_id = doctors.doctor_id
        ORDER BY appointments.appointment_date ASC,
                 appointments.appointment_time ASC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Appointments</title>

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
            width: 95%;
            margin: 35px auto;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 18px;
            background-color: #023e8a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 8px #ccc;
        }

        th {
            background-color: #0077b6;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
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

        .completed {
            color: blue;
            font-weight: bold;
        }

        .cancelled {
            color: red;
            font-weight: bold;
        }

        .action {
            padding: 7px;
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
            cursor: pointer;
        }

    </style>

</head>

<body>

<header>

    <h1>📅 Manage Appointments</h1>

    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION["admin_name"]); ?>
    </p>

</header>

<div class="container">

    <a class="back" href="admin_dashboard.php">
        ← Dashboard
    </a>

    <?php if (mysqli_num_rows($result) > 0) { ?>

    <table>

        <tr>

            <th>ID</th>
            <th>Patient</th>
            <th>Phone</th>
            <th>Doctor</th>
            <th>Specialization</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Change Status</th>

        </tr>

        <?php while ($appointment = mysqli_fetch_assoc($result)) { ?>

        <tr>

            <td>
                <?php echo $appointment["appointment_id"]; ?>
            </td>

            <td>
                <?php echo htmlspecialchars($appointment["patient_name"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($appointment["patient_phone"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($appointment["doctor_name"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($appointment["specialization"]); ?>
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

            <td class="action">

                <form method="POST" action="update_appointment_status.php">

                    <input
                        type="hidden"
                        name="appointment_id"
                        value="<?php echo $appointment["appointment_id"]; ?>"
                    >

                    <select name="status">

                        <option value="Pending"
                            <?php if ($appointment["status"] == "Pending") echo "selected"; ?>>
                            Pending
                        </option>

                        <option value="Confirmed"
                            <?php if ($appointment["status"] == "Confirmed") echo "selected"; ?>>
                            Confirmed
                        </option>

                        <option value="Completed"
                            <?php if ($appointment["status"] == "Completed") echo "selected"; ?>>
                            Completed
                        </option>

                        <option value="Cancelled"
                            <?php if ($appointment["status"] == "Cancelled") echo "selected"; ?>>
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

        <h2>No appointments found.</h2>

    <?php } ?>

</div>

</body>

</html>