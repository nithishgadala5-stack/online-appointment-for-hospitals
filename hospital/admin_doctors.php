<?php

session_start();

include "config/database.php";

if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT * FROM doctors ORDER BY doctor_id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Manage Doctors</title>

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
            margin: 40px auto;
        }

        h1 {
            margin: 0;
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
            padding: 14px;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f1f9fc;
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

        .add {
            float: right;
            background-color: #0096c7;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
        }

    </style>

</head>

<body>

<header>

    <h1>👨‍⚕️ Manage Doctors</h1>

    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION["admin_name"]); ?>
    </p>

</header>

<div class="container">

    <a class="back" href="admin_dashboard.php">
        ← Dashboard
    </a>

    <a class="add" href="add_doctor.php">
        + Add Doctor
    </a>

    <table>

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Specialization</th>
            <th>Qualification</th>
            <th>Experience</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Email</th>
            <th>Action</th>

        </tr>

        <?php

        if (mysqli_num_rows($result) > 0) {

            while ($doctor = mysqli_fetch_assoc($result)) {

        ?>

        <tr>

            <td>
                <?php echo $doctor["doctor_id"]; ?>
            </td>

            <td>
                <?php echo htmlspecialchars($doctor["name"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($doctor["specialization"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($doctor["qualification"]); ?>
            </td>

            <td>
                <?php echo $doctor["experience"]; ?> years
            </td>

            <td>
                <?php echo htmlspecialchars($doctor["phone"]); ?>
            </td>

            <td>
                <?php echo htmlspecialchars($doctor["email"]); ?>
            </td>
            <td>

    <a href="edit_doctor.php?id=<?php echo $doctor["doctor_id"]; ?>">
        Edit
    </a>

    |

    <a
        href="delete_doctor.php?id=<?php echo $doctor["doctor_id"]; ?>"
        onclick="return confirm('Are you sure you want to delete this doctor?');"
    >
        Delete
    </a>

</td>

        </tr>

        <?php

            }

        } else {

        ?>

        <tr>

            <td colspan="7">
                No doctors found.
            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>

</html>