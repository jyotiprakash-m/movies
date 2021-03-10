<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "movies";

$conn = mysqli_connect($server, $username, $password, $dbname);

if ($conn) {
?>
    <script>
        console.log("Connection Successfull")
    </script>
<?php
} else {
?>
    <script>
        console.log("Database is not connected")
    </script>
<?php

}
