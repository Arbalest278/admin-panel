<?php
include 'connect.php';

if (isset($_POST['id']) && isset($_POST['table'])) {
    $id = mysqli_real_escape_string($link, $_POST['id']);
    $table = mysqli_real_escape_string($link, $_POST['table']);
    $sql = "SELECT * FROM $table WHERE id = '$id'";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_assoc($result);
    echo json_encode($data);
}

mysqli_close($link);
?>