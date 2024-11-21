<?php 
include 'connect.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = '$userId'";
    $result = mysqli_query($link, $sql);
    $user = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $userId = $_POST['id'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET login = '$login', password = '$password', role = '$role' WHERE id = '$userId'";
    if (mysqli_query($link, $sql)) {
        echo "<script>alert('User updated successfully!'); window.location.href = 'index.php';</script>";
    } else {
        echo "Error updating user: " . mysqli_error($link);
    }
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
        <h1 class="mb-4">Edit User</h1>
        <div class="form-container">
            <form action="edit.php" method="post">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <input type="text" name="login" placeholder="Имя" value="<?php echo $user['login']; ?>" required>
                <input type="text" name="password" placeholder="Пароль" value="<?php echo $user['password']; ?>" required>
                <input type="text" name="role" placeholder="Роль" value="<?php echo $user['role']; ?>" required>
                <input type="submit" name="update" value="Update">
            </form>
            <p><a href="index.php" class="btn btn-secondary mt-3">Back</a></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>