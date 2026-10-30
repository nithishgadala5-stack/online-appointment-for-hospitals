<?php

session_start();

include "config/database.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("Location: admin_doctors.php");
    exit();
}

$doctor_id = (int) $_GET["id"];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $specialization = $_POST["specialization"];
    $qualification = $_POST["qualification"];
    $experience = (int) $_POST["experience"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    $sql = "UPDATE doctors
            SET name = ?,
                specialization = ?,
                qualification = ?,
                experience = ?,
                phone = ?,
                email = ?
            WHERE doctor_id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "sssissi",
        $name,
        $specialization,
        $qualification,
        $experience,
        $phone,
        $email,
        $doctor_id
    );

    if (mysqli_stmt_execute($stmt)) {
        $message = "Doctor updated successfully!";
    } else {
        $message = "Failed to update doctor.";
    }

    mysqli_stmt_close($stmt);
}

$sql = "SELECT * FROM doctors WHERE doctor_id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $doctor_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) != 1) {
    header("Location: admin_doctors.php");
    exit();
}

$doctor = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Doctor</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #eaf6f8;
        }

        .container {
            width: 450px;
            margin: 40px auto;
            background: white;
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

    <h1>✏️ Edit Doctor</h1>

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
            value="<?php echo htmlspecialchars($doctor["name"]); ?>"
            required
        >

        <label>Specialization</label>

        <input
            type="text"
            name="specialization"
            value="<?php echo htmlspecialchars($doctor["specialization"]); ?>"
            required
        >

        <label>Qualification</label>

        <input
            type="text"
            name="qualification"
            value="<?php echo htmlspecialchars($doctor["qualification"]); ?>"
            required
        >

        <label>Experience (Years)</label>

        <input
            type="number"
            name="experience"
            value="<?php echo $doctor["experience"]; ?>"
            min="0"
            required
        >

        <label>Phone</label>

        <input
            type="text"
            name="phone"
            value="<?php echo htmlspecialchars($doctor["phone"]); ?>"
            required
        >

        <label>Email</label>

        <input
            type="email"
            name="email"
            value="<?php echo htmlspecialchars($doctor["email"]); ?>"
            required
        >

        <button type="submit">
            Update Doctor
        </button>

    </form>

    <a class="back" href="admin_doctors.php">
        ← Back to Doctors
    </a>

</div>

</body>

</html>