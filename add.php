<?php 
include 'connect.php';

if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['role'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    $sql = "INSERT INTO users (login, password, role) VALUES ('$login','$password','$role')";  
    if (mysqli_query($link, $sql)) {
        echo "<div class='alert alert-success'>Запись успешно добавлена</div>";
        echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 2000);</script>";
    } else {
        echo "<div class='alert alert-danger'>Ошибка: " . $sql . "<br>" . mysqli_error($link) . "</div>";
    }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }
        .form-container input[type="text"],
        .form-container input[type="submit"] {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Add User</h1>
        <div class="form-container">
            <form action="add.php" method="post">
                <input type="text" name="login" placeholder="Имя" required>
                <input type="text" name="password" placeholder="Пароль" required>
                <input type="text" name="role" placeholder="Роль" required>
                <input type="submit" value="Add">
            </form>
            <p><a href="index.php" class="btn btn-secondary mt-3">Back</a></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>