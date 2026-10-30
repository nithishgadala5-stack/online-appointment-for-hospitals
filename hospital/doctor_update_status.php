<!DOCTYPE html>
<html>

<head>

    <title>City Care Hospital - Online Appointment System</title>

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
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            color: white;
            font-size: 25px;
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
            font-size: 16px;
        }

        .nav-links a:hover {
            color: #90e0ef;
        }

        /* HERO */

        .hero {
            min-height: 500px;
            display: flex;
            align-items: center;
            padding: 60px 8%;
            background: linear-gradient(
                135deg,
                #e0f7fa,
                #caf0f8
            );
        }

        .hero-content {
            width: 60%;
        }

        .hero h1 {
            font-size: 48px;
            color: #023e8a;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 20px;
            line-height: 1.6;
            color: #444;
        }

        .buttons {
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 14px 25px;
            margin-right: 10px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        .primary {
            background-color: #0077b6;
            color: white;
        }

        .secondary {
            background-color: white;
            color: #0077b6;
            border: 2px solid #0077b6;
        }

        .btn:hover {
            opacity: 0.85;
        }

        /* SERVICES */

        .services {
            padding: 60px 8%;
            text-align: center;
        }

        .services h2 {
            color: #023e8a;
            font-size: 32px;
        }

        .cards {
            display: flex;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
            margin-top: 35px;
        }

        .card {
            background-color: white;
            width: 260px;
            padding: 30px 20px;
            border-radius: 10px;
            box-shadow: 0 3px 12px #d5d5d5;
        }

        .card .icon {
            font-size: 45px;
        }

        .card h3 {
            color: #0077b6;
        }

        .card p {
            line-height: 1.5;
        }

        /* LOGIN SECTION */

        .login-section {
            background-color: #eaf6f8;
            padding: 60px 8%;
            text-align: center;
        }

        .login-section h2 {
            color: #023e8a;
        }

        .login-card {
            display: inline-block;
            width: 220px;
            margin: 15px;
            padding: 25px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px #ccc;
        }

        .login-card a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0077b6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        /* CONTACT */

        .contact {
            padding: 60px 8%;
            text-align: center;
        }

        .contact h2 {
            color: #023e8a;
        }

        /* FOOTER */

        footer {
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

            .hero-content {
                width: 100%;
            }

            .hero h1 {
                font-size: 35px;
            }

        }

    </style>

</head>

<body>


<!-- NAVIGATION -->

<nav>

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

</nav>


<!-- HERO SECTION -->

<section class="hero">

    <div class="hero-content">

        <h1>
            Quality Healthcare,
            <br>
            Anytime You Need
        </h1>

        <p>
            Welcome to City Care Hospital.
            Book your doctor appointment online quickly
            and conveniently from anywhere.
        </p>

        <div class="buttons">

            <a
                class="btn primary"
                href="login.php"
            >
                Book an Appointment
            </a>

            <a
                class="btn secondary"
                href="doctors.php"
            >
                View Doctors
            </a>

        </div>

    </div>

</section>


<!-- SERVICES -->

<section class="services">

    <h2>Our Services</h2>

    <div class="cards">

        <div class="card">

            <div class="icon">📅</div>

            <h3>Online Appointment</h3>

            <p>
                Book your appointment online
                without waiting in long queues.
            </p>

        </div>


        <div class="card">

            <div class="icon">👨‍⚕️</div>

            <h3>Expert Doctors</h3>

            <p>
                Consult experienced doctors
                from different medical specialties.
            </p>

        </div>


        <div class="card">

            <div class="icon">🏥</div>

            <h3>Quality Healthcare</h3>

            <p>
                We provide patient-focused
                healthcare services.
            </p>

        </div>

    </div>

</section>


<!-- LOGIN SECTION -->

<section class="login-section">

    <h2>Access Your Account</h2>

    <div class="login-card">

        <h3>👤 Patient</h3>

        <p>
            Book and manage your appointments.
        </p>

        <a href="login.php">
            Patient Login
        </a>

    </div>


    <div class="login-card">

        <h3>👨‍⚕️ Doctor</h3>

        <p>
            View and manage your appointments.
        </p>

        <a href="doctor_login.php">
            Doctor Login
        </a>

    </div>


    <div class="login-card">

        <h3>🔐 Admin</h3>

        <p>
            Manage doctors and appointments.
        </p>

        <a href="admin_login.php">
            Admin Login
        </a>

    </div>

</section>


<!-- CONTACT -->

<section class="contact">

    <h2>Contact Us</h2>

    <p>
        📍 123 Health Street, Your City
    </p>

    <p>
        📞 +91 98765 43210
    </p>

    <p>
        ✉️ contact@citycarehospital.com
    </p>

</section>


<!-- FOOTER -->

<footer>

    <p>
        © 2026 City Care Hospital.
        All Rights Reserved.
    </p>

    <p>
        Online Hospital Appointment System
    </p>

</footer>


</body>

</html>