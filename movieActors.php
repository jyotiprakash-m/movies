<?php
error_reporting(0);
include 'connection.php';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM `dvdactors` WHERE actorID='$id'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_array($result);
    $fname = $rows['fname'];
    $lname = $rows['lname'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Actors</title>
    <style>
        * {
            font-family: sans-serif;
        }

        .heading {
            text-align: center;
        }

        .buttons {
            margin-bottom: 20px;
            text-align: center;
        }

        .button {
            text-decoration: none;
            color: white;
            background-color: #3d3c3c;
            padding: 10px 20px;
            border-radius: 10px;
            margin: 5px;
        }

        .actors-form {
            border: 1px solid black;
            padding: 50px;
        }

        .actors-form tr td:nth-child(1) {
            padding-right: 100px;
        }

        input {
            width: 400px;
            padding: 5px;
        }

        input[type=submit] {
            width: 150px;
        }

        .allActors {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 20px;
        }

        .allActors table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .allActors td,
        .allActors th {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
            text-align: center;

        }

        .allActors tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        .allActors tr:hover {
            background-color: #ddd;
        }

        .allActors tr:nth-child(1) {
            background-color: #a5a5a5;
        }
    </style>
</head>

<body>
    <div class="actors-body">
        <h2 class="heading">Movie Actors</h2>
        <div class="buttons">
            <a class="button" href="index.php">Go Home</a>
        </div>
        <hr>
        <div class="actors-form">
            <form action="" method="post">
                <table>
                    <tr>
                        <td>First name:</td>
                        <td><input type="text" name="fname" placeholder="First name" value="<?php echo $fname ?>"></td>
                    </tr>
                    <tr>
                        <td>Last name:</td>
                        <td><input type="text" name="lname" placeholder="Last name" value="<?php echo $lname ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="submit" value="Add to database"></td>
                    </tr>

                </table>

            </form>
        </div>
        <?php
        include 'connection.php';

        if (isset($_POST['submit'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            if ($id) {
                $sql = "UPDATE `dvdactors` SET `fname`='$fname',`lname`='$lname' WHERE actorId=$id";
            } else {
                $sql = "INSERT INTO `dvdactors`(`fname`, `lname`) VALUES ('$fname','$lname')";
            }
            $result = mysqli_query($conn, $sql);

            if ($result) {
        ?>
                <script>
                    alert("Data Inserted Successfully");
                    window.location = "movieActors.php";
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("Something went wrong")
                </script>
        <?php
            }
        }

        ?>
        <div class="allActors">
            <?php
            $sql = "SELECT COUNT(`actorID`) as num FROM dvdactors";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_array($result);
            ?>

            <p><span><?php echo $rows['num'] ?></span> records in the database.</p>
            <table>
                <tr>
                    <th>Actor ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Action</th>
                </tr>
                <?php
                $sql = "SELECT * FROM `dvdactors`";
                $table = 'dvdactors';
                $result = mysqli_query($conn, $sql);
                while ($rows = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $rows['actorID'] ?></td>
                        <td><?php echo $rows['fname'] ?></td>
                        <td><?php echo $rows['lname'] ?></td>
                        <td>
                            <a href="delete.php?id=<?php echo $rows['actorID'] ?>&table=<?php echo $table ?>">Delete</a>
                            <a href="movieActors.php?edit=<?php echo $rows['actorID'] ?>">Update</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>

</body>

</html>