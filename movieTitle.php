<!-- Update datas to the database -->
<?php
error_reporting(0);
include 'connection.php';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $sql = "SELECT * FROM `dvdtitles` WHERE uid='$id'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_array($result);
    $uid = $rows['uid'];
    $title = $rows['title'];
    $price = $rows['price'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Titles</title>
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

        .title-form {
            border: 1px solid black;
            padding: 50px;
        }

        .title-form tr td:nth-child(1) {
            padding-right: 100px;
        }

        input {
            width: 400px;
            padding: 5px;
        }

        input[type=submit] {
            width: 150px;
        }

        .allTitles {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 20px;
        }

        .allTitles table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .allTitles td,
        .allTitles th {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
            text-align: center;

        }

        .allTitles tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        .allTitles tr:nth-child(1) {
            background-color: #a5a5a5;
        }
    </style>
</head>


<body>
    <div class="title-body">
        <h2 class="heading">Movie Titles</h2>
        <div class="buttons">
            <a class="button" href="index.php">Go Home</a>
        </div>
        <hr>

        <div class="title-form">
            <form action="" method="post">
                <table>
                    <tr>
                        <td>ASIN:</td>
                        <td><input type="text" name="uid" placeholder="Uid" value="<?php echo $uid ?>"></td>
                    </tr>
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="title" value="<?php echo $title ?>"></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td><input type="text" name="price" placeholder="price" value="<?php echo $price ?>"></td>
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
            $uid = $_POST['uid'];
            $title = $_POST['title'];
            $price = $_POST['price'];
            if ($id) {
                $sql = "UPDATE `dvdtitles` SET `uid`='$uid',`title`='$title',`price`='$price' WHERE uid='$id'";
            } else {
                $sql = "INSERT INTO `dvdtitles`(`uid`, `title`, `price`) VALUES ('$uid','$title','$price')";
            }
            $result = mysqli_query($conn, $sql);

            if ($result) {
        ?>
                <script>
                    alert("Data Inserted Successfully");
                    window.location = "movieTitle.php";
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

        <div class="allTitles">
            <?php
            $sql = "SELECT COUNT(`uid`) as num FROM dvdtitles";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_array($result);
            ?>
            <p><span><?php echo $rows['num'] ?></span> records in the database.</p>
            <table>
                <tr>
                    <th>ASIN</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Operations</th>
                </tr>
                <!-- Selecting all the movies -->
                <?php
                $sql = "SELECT * FROM `dvdtitles`";
                $table = 'dvdtitles';
                $result = mysqli_query($conn, $sql);
                while ($rows = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $rows['uid'] ?></td>
                        <td><?php echo $rows['title'] ?></td>
                        <td>₹ <?php echo $rows['price'] ?></td>
                        <td>
                            <a href="delete.php?id=<?php echo $rows['uid'] ?>&table=<?php echo $table ?>">Delete</a>
                            <a href="movieTitle.php?edit=<?php echo $rows['uid'] ?>">Update</a>
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