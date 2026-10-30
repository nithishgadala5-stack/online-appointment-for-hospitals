<?php

session_start();

include "config/database.php";

$sql = "SELECT * FROM doctors ORDER BY name ASC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Our Doctors - City Care Hospital</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

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

        /* NAVIGATION */

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
            gap: 25px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .nav-links a:hover {
            color: #90e0ef;
        }

        /* PAGE HEADER */

        .page-header {
            background: linear-gradient(
                135deg,
                #0077b6,
                #023e8a
            );

            color: white;
            text-align: center;
            padding: 55px 20px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 40px;
        }

        .page-header p {
            font-size: 18px;
            margin-top: 12px;
        }

        /* DOCTORS */

        .doctors-container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
        }

        .doctors-grid {
            display: grid;
            grid-template-columns:
                repeat(auto-fit, minmax(260px, 1fr));

            gap: 30px;
        }

        .doctor-card {
            background-color: white;
            border-radius: 12px;
            padding: 30px 25px;
            text-align: center;

            box-shadow:
                0 4px 15px rgba(0, 0, 0, 0.10);

            transition: 0.3s;
        }

        .doctor-card:hover {
            transform: translateY(-5px);

            box-shadow:
                0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .doctor-icon {
            width: 100px;
            height: 100px;

            margin: 0 auto 20px;

            border-radius: 50%;

            background-color: #caf0f8;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 50px;
        }

        .doctor-card h2 {
            color: #023e8a;
            margin-bottom: 8px;
        }

        .specialization {
            color: #0077b6;
            font-size: 18px;
            font-weight: bold;
        }

        .doctor-info {
            margin: 15px 0;
            line-height: 1.7;
            color: #555;
        }

        .book-btn {
            display: inline-block;

            padding: 12px 22px;

            background-color: #0077b6;

            color: white;

            text-decoration: none;

            border-radius: 6px;

            margin-top: 10px;
        }

        .book-btn:hover {
            background-color: #023e8a;
        }

        /* NO DOCTORS */

        .no-doctors {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 10px;
        }

        /* FOOTER */

        footer {
            margin-top: 70px;

            background-color: #023e8a;

            color: white;

            text-align: center;

            padding: 25px;
        }

        /* MOBILE */

        @media (max-width: 768px) {

            nav {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }

            .page-header h1 {
                font-size: 32px;
            }

        }

    </style>

</head>

<body>


<!-- NAVIGATION -->

<nav>

    <a class="logo" href="index.php">
        🏥 City Care Hospital
    </a>

    <div class="nav-links">

        <a href="index.php">
            Home
        </a>

        <a href="doctors.php">
            Doctors
        </a>

        <a href="login.php">
            Appointments
        </a>

        <a href="login.php">
            Login
        </a>

        <a href="register.php">
            Register
        </a>

    </div>

</nav>


<!-- PAGE HEADER -->

<section class="page-header">

    <h1>
        👨‍⚕️ Our Doctors
    </h1>

    <p>
        Meet our experienced and dedicated medical professionals
    </p>

</section>


<!-- DOCTOR LIST -->

<div class="doctors-container">

    <?php if (mysqli_num_rows($result) > 0) { ?>

        <div class="doctors-grid">

            <?php while ($doctor = mysqli_fetch_assoc($result)) { ?>

                <div class="doctor-card">

                    <div class="doctor-icon">
                        👨‍⚕️
                    </div>

                    <h2>
                        <?php
                        echo htmlspecialchars($doctor["name"]);
                        ?>
                    </h2>

                    <div class="specialization">

                        <?php
                        echo htmlspecialchars(
                            $doctor["specialization"]
                        );
                        ?>

                    </div>

                    <div class="doctor-info">

                        <div>
                            📧
                            <?php
                            echo htmlspecialchars(
                                $doctor["email"]
                            );
                            ?>
                        </div>

                        <?php if (!empty($doctor["phone"])) { ?>

                            <div>
                                📞
                                <?php
                                echo htmlspecialchars(
                                    $doctor["phone"]
                                );
                                ?>
                            </div>

                        <?php } ?>

                    </div>

                    <a
                        class="book-btn"
                        href="login.php"
                    >
                        📅 Book Appointment
                    </a>

                </div>

            <?php } ?>

        </div>

    <?php } else { ?>

        <div class="no-doctors">

            <h2>
                No doctors available
            </h2>

            <p>
                Please check again later.
            </p>

        </div>

    <?php } ?>

</div>


<!-- FOOTER -->

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