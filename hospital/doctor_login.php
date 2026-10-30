<?php

session_start();

include "config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM doctors WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {

        $doctor = mysqli_fetch_assoc($result);

        if (
            !empty($doctor["password"]) &&
            password_verify($password, $doctor["password"])
        ) {

            $_SESSION["doctor_id"] = $doctor["doctor_id"];
            $_SESSION["doctor_name"] = $doctor["name"];

            header("Location: doctor_dashboard.php");
            exit();

        } else {

            $message = "Incorrect password.";

        }

    } else {

        $message = "Doctor account not found.";

    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Doctor Login</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #eaf6f8;
        }

        .container {
            width: 400px;
            margin: 80px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px #ccc;
        }

        h1 {
            text-align: center;
            color: #0077b6;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #0077b6;
            color: white;
            border: none;
            cursor: pointer;
        }

        .error {
            color: red;
            text-align: center;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>👨‍⚕️ Doctor Login</h1>

    <?php if ($message != "") { ?>

        <p class="error">
            <?php echo htmlspecialchars($message); ?>
        </p>

    <?php } ?>

    <form method="POST">

        <label>Email</label>

        <input
            type="email"
            name="email"
            required
        >

        <label>Password</label>

        <input
            type="password"
            name="password"
            required
        >

        <button type="submit">
            Doctor Login
        </button>

    </form>

</div>

</body>

</html>