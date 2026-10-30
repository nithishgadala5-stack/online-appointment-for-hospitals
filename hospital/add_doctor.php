<?php

session_start();

include "config/database.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $specialization = $_POST["specialization"];
    $qualification = $_POST["qualification"];
    $experience = $_POST["experience"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    $sql = "INSERT INTO doctors
            (name, specialization, qualification, experience, phone, email)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssiss",
        $name,
        $specialization,
        $qualification,
        $experience,
        $phone,
        $email
    );

    if (mysqli_stmt_execute($stmt)) {

        $message = "Doctor added successfully!";

    } else {

        $message = "Failed to add doctor.";

    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Add Doctor</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #eaf6f8;
        }

        .container {
            width: 450px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px #ccc;
        }

        h1 {
            text-align: center;
            color: #023e8a;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 11px;
            margin-top: 7px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 25px;
            background-color: #0077b6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #023e8a;
        }

        .message {
            text-align: center;
            color: green;
            font-weight: bold;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>👨‍⚕️ Add Doctor</h1>

    <?php if ($message != "") { ?>

        <p class="message">
            <?php echo htmlspecialchars($message); ?>
        </p>

    <?php } ?>

    <form method="POST">

        <label>Doctor Name</label>

        <input
            type="text"
            name="name"
            placeholder="Enter doctor name"
            required
        >

        <label>Specialization</label>

        <input
            type="text"
            name="specialization"
            placeholder="Example: Cardiology"
            required
        >

        <label>Qualification</label>

        <input
            type="text"
            name="qualification"
            placeholder="Example: MBBS, MD"
            required
        >

        <label>Experience (Years)</label>

        <input
            type="number"
            name="experience"
            min="0"
            required
        >

        <label>Phone</label>

        <input
            type="text"
            name="phone"
            placeholder="Enter phone number"
            required
        >

        <label>Email</label>

        <input
            type="email"
            name="email"
            placeholder="doctor@hospital.com"
            required
        >

        <button type="submit">
            Add Doctor
        </button>

    </form>

    <a class="back" href="admin_doctors.php">
        ← Back to Doctors
    </a>

</div>

</body>

</html>