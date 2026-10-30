<?php

include "config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO patients (name, email, phone, password)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $name,
        $email,
        $phone,
        $hashed_password
    );

    if (mysqli_stmt_execute($stmt)) {
        $message = "Registration successful!";
    } else {
        $message = "Registration failed. Email may already exist.";
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Patient Registration</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #eaf6f8;
        }

        .container {
            width: 400px;
            margin: 60px auto;
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

        .message {
            text-align: center;
            color: green;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Patient Registration</h1>

    <?php if ($message != ""): ?>

        <p class="message">
            <?php echo $message; ?>
        </p>

    <?php endif; ?>

    <form method="POST">

        <label>Full Name</label>

        <input
            type="text"
            name="name"
            required
        >

        <label>Email</label>

        <input
            type="email"
            name="email"
            required
        >

        <label>Phone Number</label>

        <input
            type="text"
            name="phone"
            required
        >

        <label>Password</label>

        <input
            type="password"
            name="password"
            required
        >

        <button type="submit">
            Register
        </button>

    </form>

</div>

</body>

</html>