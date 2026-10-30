<?php

session_start();

include "config/database.php";

/* Patient must be logged in */

if (!isset($_SESSION["patient_id"])) {
    header("Location: login.php");
    exit();
}

$patient_id = $_SESSION["patient_id"];

$message = "";
$message_type = "";


/* Get doctors */

$doctor_sql = "SELECT doctor_id, name, specialization
               FROM doctors
               ORDER BY name ASC";

$doctor_result = mysqli_query($conn, $doctor_sql);


/* Handle appointment form */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $doctor_id = (int) $_POST["doctor_id"];
    $appointment_date = $_POST["appointment_date"];
    $appointment_time = $_POST["appointment_time"];


    /* Check that doctor exists */

    $check_doctor_sql = "SELECT doctor_id
                         FROM doctors
                         WHERE doctor_id = ?";

    $check_doctor_stmt = mysqli_prepare(
        $conn,
        $check_doctor_sql
    );

    mysqli_stmt_bind_param(
        $check_doctor_stmt,
        "i",
        $doctor_id
    );

    mysqli_stmt_execute($check_doctor_stmt);

    $check_doctor_result =
        mysqli_stmt_get_result($check_doctor_stmt);


    if (mysqli_num_rows($check_doctor_result) == 0) {

        $message = "Selected doctor does not exist.";
        $message_type = "error";

    } else {


        /*
         * Check whether the doctor already has
         * an appointment at the selected date/time.
         */

        $check_sql = "SELECT appointment_id
                      FROM appointments
                      WHERE doctor_id = ?
                      AND appointment_date = ?
                      AND appointment_time = ?
                      AND status != 'Cancelled'";

        $check_stmt = mysqli_prepare(
            $conn,
            $check_sql
        );

        mysqli_stmt_bind_param(
            $check_stmt,
            "iss",
            $doctor_id,
            $appointment_date,
            $appointment_time
        );

        mysqli_stmt_execute($check_stmt);

        $check_result =
            mysqli_stmt_get_result($check_stmt);


        if (mysqli_num_rows($check_result) > 0) {

            $message =
                "Sorry, this time slot is already booked.";

            $message_type = "error";

        } else {


            /* Insert appointment */

            $insert_sql = "INSERT INTO appointments
                           (
                               patient_id,
                               doctor_id,
                               appointment_date,
                               appointment_time,
                               status
                           )
                           VALUES (?, ?, ?, ?, 'Pending')";

            $insert_stmt = mysqli_prepare(
                $conn,
                $insert_sql
            );

            mysqli_stmt_bind_param(
                $insert_stmt,
                "iiss",
                $patient_id,
                $doctor_id,
                $appointment_date,
                $appointment_time
            );


            if (mysqli_stmt_execute($insert_stmt)) {

                $message =
                    "Appointment booked successfully!";

                $message_type = "success";

            } else {

                $message =
                    "Unable to book appointment. Please try again.";

                $message_type = "error";
            }

            mysqli_stmt_close($insert_stmt);
        }

        mysqli_stmt_close($check_stmt);
    }

    mysqli_stmt_close($check_doctor_stmt);
}

?>


<!DOCTYPE html>
<html>

<head>

    <title>Book Appointment - City Care Hospital</title>

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f9fc;
            color: #333;
        }


        /* Navigation */

        nav {
            background-color: #023e8a;
            padding: 18px 6%;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 22px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .nav-links a:hover {
            color: #90e0ef;
        }


        /* Page header */

        .page-header {
            background:
                linear-gradient(
                    135deg,
                    #0077b6,
                    #023e8a
                );

            color: white;
            text-align: center;
            padding: 45px 20px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 38px;
        }

        .page-header p {
            font-size: 18px;
        }


        /* Booking box */

        .booking-container {
            width: 90%;
            max-width: 650px;
            margin: 45px auto;
        }

        .booking-card {
            background-color: white;
            padding: 35px;

            border-radius: 12px;

            box-shadow:
                0 4px 15px rgba(0, 0, 0, 0.10);
        }

        .booking-card h2 {
            text-align: center;
            color: #023e8a;
            margin-top: 0;
        }


        /* Form */

        label {
            display: block;
            margin-top: 20px;
            margin-bottom: 7px;

            font-weight: bold;
            color: #333;
        }

        select,
        input {
            width: 100%;
            padding: 13px;

            border: 1px solid #ccc;
            border-radius: 6px;

            font-size: 15px;
        }

        select:focus,
        input:focus {
            outline: none;
            border-color: #0077b6;
        }

        .submit-btn {
            width: 100%;

            margin-top: 30px;

            padding: 14px;

            background-color: #0077b6;
            color: white;

            border: none;
            border-radius: 6px;

            font-size: 16px;
            font-weight: bold;

            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #023e8a;
        }


        /* Messages */

        .message {
            padding: 13px;
            margin-bottom: 20px;

            border-radius: 6px;
            text-align: center;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }


        /* Footer */

        footer {
            margin-top: 70px;

            background-color: #023e8a;
            color: white;

            text-align: center;

            padding: 25px;
        }


        /* Mobile */

        @media (max-width: 768px) {

            nav {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .booking-card {
                padding: 25px 20px;
            }

        }

    </style>

</head>


<body>


<!-- Navigation -->

<nav>

    <a
        class="logo"
        href="index.php"
    >
        🏥 City Care Hospital
    </a>

    <div class="nav-links">

        <a href="index.php">
            Home
        </a>

        <a href="doctors.php">
            Doctors
        </a>

        <a href="patient_dashboard.php">
            Dashboard
        </a>

        <a href="my_appointments.php">
            My Appointments
        </a>

        <a href="logout.php">
            Logout
        </a>

    </div>

</nav>


<!-- Header -->

<section class="page-header">

    <h1>
        📅 Book an Appointment
    </h1>

    <p>
        Choose your doctor and preferred appointment time
    </p>

</section>


<!-- Booking form -->

<div class="booking-container">

    <div class="booking-card">

        <h2>
            Appointment Details
        </h2>


        <?php if ($message != "") { ?>

            <div class="message <?php echo $message_type; ?>">

                <?php
                echo htmlspecialchars($message);
                ?>

            </div>

        <?php } ?>


        <?php if (mysqli_num_rows($doctor_result) > 0) { ?>

            <form method="POST">


                <!-- Doctor -->

                <label for="doctor_id">
                    Select Doctor
                </label>

                <select
                    id="doctor_id"
                    name="doctor_id"
                    required
                >

                    <option value="">
                        -- Select Doctor --
                    </option>

                    <?php
                    while (
                        $doctor =
                        mysqli_fetch_assoc($doctor_result)
                    ) {
                    ?>

                        <option
                            value="<?php
                            echo $doctor["doctor_id"];
                            ?>"
                        >

                            <?php
                            echo htmlspecialchars(
                                $doctor["name"]
                            );
                            ?>

                            -
                            <?php
                            echo htmlspecialchars(
                                $doctor["specialization"]
                            );
                            ?>

                        </option>

                    <?php } ?>

                </select>


                <!-- Date -->

                <label for="appointment_date">
                    Select Date
                </label>

                <input
                    type="date"
                    id="appointment_date"
                    name="appointment_date"
                    min="<?php echo date('Y-m-d'); ?>"
                    required
                >


                <!-- Time -->

                <label for="appointment_time">
                    Select Time
                </label>

                <input
                    type="time"
                    id="appointment_time"
                    name="appointment_time"
                    required
                >


                <!-- Submit -->

                <button
                    type="submit"
                    class="submit-btn"
                >
                    📅 Confirm Appointment
                </button>

            </form>

        <?php } else { ?>

            <div class="message error">

                No doctors are currently available.

            </div>

        <?php } ?>

    </div>

</div>


<!-- Footer -->

<footer>

    <p>
        © 2026 City Care Hospital
    </p>

    <p>
        Online Hospital Appointment System
    </p>

</footer>


</body>

</html>