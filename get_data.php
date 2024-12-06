<?php
include 'connect.php';

if (isset($_POST['id']) && isset($_POST['table'])) {
    $id = mysqli_real_escape_string($link, $_POST['id']);
    $table = mysqli_real_escape_string($link, $_POST['table']);

    $sql = "SELECT * FROM `$table` WHERE id = '$id'";
    $result = mysqli_query($link, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Data not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

mysqli_close($link);
?>