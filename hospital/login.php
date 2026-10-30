<?php

session_start();

include "config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM patients WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {

        $patient = mysqli_fetch_assoc($result);

        if (password_verify($password, $patient["password"])) {

            $_SESSION["patient_id"] = $patient["patient_id"];
            $_SESSION["patient_name"] = $patient["name"];

            header("Location: patient_dashboard.php");
            exit();

        } else {

            $message = "Incorrect password.";

        }

    } else {

        $message = "Email not found.";

    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Patient Login</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #eaf6f8;
        }

        .container {
            width: 400px;
            margin: 80px auto;
            background: white;
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

        button:hover {
            background-color: #023e8a;
        }

        .error {
            text-align: center;
            color: red;
        }

        .register {
            text-align: center;
            margin-top: 20px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Patient Login</h1>

    <?php if ($message != ""): ?>

        <p class="error">
            <?php echo $message; ?>
        </p>

    <?php endif; ?>

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
            Login
        </button>

    </form>

    <div class="register">

        <p>
            Don't have an account?
        </p>

        <a href="register.php">
            Register here
        </a>

    </div>

</div>

</body>

</html>