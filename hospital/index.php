<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>City Care Hospital</title>

    <style>

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f9fc;
            color: #333;
        }


        /* Header */

        header {
            background: linear-gradient(
                135deg,
                #0077b6,
                #023e8a
            );

            color: white;
            padding: 28px 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 32px;
        }

        header p {
            margin: 8px 0 0;
            font-size: 16px;
        }


        /* Navigation */

        nav {
            background-color: #023e8a;
            padding: 16px 20px;

            display: flex;
            justify-content: center;
            align-items: center;

            gap: 30px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;

            padding: 8px 4px;

            transition: 0.3s;
        }

        nav a:hover {
            color: #90e0ef;
        }


        /* Hero */

        .hero {
            min-height: 450px;

            display: flex;
            flex-direction: column;

            justify-content: center;
            align-items: center;

            text-align: center;

            padding: 70px 20px;

            background:
                linear-gradient(
                    rgba(202, 240, 248, 0.92),
                    rgba(240, 250, 255, 0.95)
                );
        }

        .hero-icon {
            font-size: 65px;
            margin-bottom: 10px;
        }

        .hero h1 {
            color: #023e8a;
            font-size: 44px;
            margin: 10px 0;
        }

        .hero p {
            max-width: 700px;

            font-size: 20px;
            line-height: 1.6;

            color: #444;
        }


        /* Buttons */

        .button {
            display: inline-block;

            background-color: #0077b6;
            color: white;

            padding: 15px 30px;

            text-decoration: none;

            border-radius: 7px;

            margin-top: 20px;

            font-weight: bold;
            font-size: 16px;

            transition: 0.3s;

            box-shadow:
                0 4px 10px rgba(0, 119, 182, 0.25);
        }

        .button:hover {
            background-color: #023e8a;
            transform: translateY(-2px);
        }


        /* Services */

        .services {
            text-align: center;
            padding: 70px 20px;
        }

        .section-title {
            color: #023e8a;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .section-description {
            color: #666;
            margin-bottom: 35px;
        }

        .service-container {
            max-width: 1100px;
            margin: auto;

            display: flex;
            justify-content: center;

            gap: 25px;

            flex-wrap: wrap;
        }

        .service-box {
            background-color: white;

            width: 300px;

            padding: 30px 25px;

            border-radius: 12px;

            box-shadow:
                0 4px 15px rgba(0, 0, 0, 0.08);

            transition: 0.3s;
        }

        .service-box:hover {
            transform: translateY(-5px);

            box-shadow:
                0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .service-icon {
            font-size: 45px;
        }

        .service-box h3 {
            color: #0077b6;
            margin: 15px 0 10px;
        }

        .service-box p {
            color: #666;
            line-height: 1.6;
        }


        /* Why choose us */

        .about {
            background-color: white;
            text-align: center;

            padding: 65px 20px;
        }

        .about-content {
            max-width: 850px;
            margin: auto;
        }

        .about p {
            line-height: 1.8;
            color: #555;
            font-size: 17px;
        }


        /* Footer */

        footer {
            background-color: #023e8a;
            color: white;

            text-align: center;

            padding: 30px 20px;
        }

        footer p {
            margin: 7px;
        }


        /* Mobile */

        @media (max-width: 768px) {

            header h1 {
                font-size: 26px;
            }

            nav {
                flex-wrap: wrap;
                gap: 12px;
            }

            nav a {
                font-size: 14px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero p {
                font-size: 17px;
            }

            .service-box {
                width: 100%;
                max-width: 350px;
            }

        }

    </style>

</head>


<body>


    <!-- Header -->

    <header>

        <h1>🏥 City Care Hospital</h1>

        <p>
            Your Health, Our Priority
        </p>

    </header>


    <!-- Navigation -->

    <nav>

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

    </nav>


    <!-- Hero Section -->

    <section class="hero">

        <div class="hero-icon">
            🏥
        </div>

        <h1>
            Welcome to City Care Hospital
        </h1>

        <p>
            Access quality healthcare and book appointments
            with experienced doctors quickly and conveniently.
        </p>

        <a
            href="login.php"
            class="button"
        >
            📅 Book an Appointment
        </a>

    </section>


    <!-- Services -->

    <section class="services">

        <h2 class="section-title">
            Our Services
        </h2>

        <p class="section-description">
            Healthcare services designed around your needs.
        </p>


        <div class="service-container">


            <div class="service-box">

                <div class="service-icon">
                    👨‍⚕️
                </div>

                <h3>
                    Expert Doctors
                </h3>

                <p>
                    Consult experienced and qualified doctors
                    across different medical specializations.
                </p>

            </div>


            <div class="service-box">

                <div class="service-icon">
                    📅
                </div>

                <h3>
                    Online Appointments
                </h3>

                <p>
                    Book your doctor appointment online
                    quickly and conveniently.
                </p>

            </div>


            <div class="service-box">

                <div class="service-icon">
                    ❤️
                </div>

                <h3>
                    Quality Healthcare
                </h3>

                <p>
                    We are committed to providing reliable,
                    accessible, and patient-focused healthcare.
                </p>

            </div>


        </div>

    </section>


    <!-- About -->

    <section class="about">

        <div class="about-content">

            <h2 class="section-title">
                Why Choose City Care Hospital?
            </h2>

            <p>
                Our online hospital appointment system makes
                it easier for patients to connect with doctors
                and manage appointments. Patients can book
                appointments online, while doctors and
                administrators can efficiently manage the
                healthcare workflow.
            </p>

        </div>

    </section>


    <!-- Footer -->

    <footer>

        <p>
            🏥 <strong>City Care Hospital</strong>
        </p>

        <p>
            Your Health, Our Priority
        </p>

        <p>
            © 2026 City Care Hospital. All Rights Reserved.
        </p>

    </footer>


</body>

</html>