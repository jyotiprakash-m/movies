<?php

include 'connection.php';

$id = $_GET['id'];
$table = $_GET['table'];


if ($table == 'dvdtitles') {
    $sql = "DELETE FROM $table WHERE uid='$id'";
} else {
    $sql = "DELETE FROM $table WHERE actorID='$id'";
}
$result = mysqli_query($conn, $sql);

if ($result) {
?>
    <script>
        alert("Data Deleted successfully");
    </script>

    <?php
    if ($table == 'dvdtitles') {
    ?>
        <script>
            window.location = "movieTitle.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            window.location = "movieActors.php";
        </script>
    <?php
    }
} else {
    ?>

    <script>
        alert("Something gone wrong");
        // window.location = "index.php";
    </script>
<?php
}

?>