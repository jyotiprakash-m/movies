<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
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

        .allMovies {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 20px;
        }

        .allMovies table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .allMovies td,
        .allMovies th {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
            text-align: center;
        }



        .allMovies tr:nth-child(odd) {
            background-color: #f1f1f1;
        }

        .allMovies tr:nth-child(1) {
            background-color: #a5a5a5;
        }
    </style>
</head>

<body>
    <div>
        <h2 class="heading">Movie Listings</h2>
        <div class="buttons">
            <a class="button" href="movieTitle.php">All Titles</a>
            <a class="button" href="movieActors.php">All Actors</a>
        </div>
        <hr>
    </div>
    <div class="allMovies">
        <?php
        include "connection.php";
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
                <th>Actors</th>
            </tr>
            <?php
            $sql = "SELECT * FROM `dvdtitles`";
            $result = mysqli_query($conn, $sql);
            while ($rows = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $rows['uid'] ?></td>
                    <td><?php echo $rows['title'] ?></td>
                    <td><?php echo $rows['price'] ?></td>
                    <?php
                    $asin = $rows['uid'];
                    $sqlname = "SELECT fname,lname FROM relation JOIN dvdtitles on relation.uid=dvdtitles.uid JOIN dvdactors ON relation.actorID=dvdactors.actorID WHERE dvdtitles.uid='$asin'";
                    $resultname = mysqli_query($conn, $sqlname);
                    ?>
                    <td>
                        <?php
                        while ($rows = mysqli_fetch_array($resultname)) {
                        ?>
                            <span><?php echo $rows['fname'] ?> <?php echo $rows['lname'] ?>,</span>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

</body>

</html>

<!-- SELECT dvdtitles.uid,title,price,fname,lname FROM relation JOIN dvdtitles on relation.uid=dvdtitles.uid JOIN dvdactors ON relation.actorID=dvdactors.actorID
 -->

<!-- SELECT fname,lname FROM relation JOIN dvdtitles on relation.uid=dvdtitles.uid JOIN dvdactors ON relation.actorID=dvdactors.actorID WHERE dvdtitles.uid='B004C6UFZS' -->