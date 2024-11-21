<?php 
include 'connect.php';

// Функция для удаления пользователя
if (isset($_POST['delete_id'])) {
    $delete_id = mysqli_real_escape_string($link, $_POST['delete_id']);
    $sql = "DELETE FROM users WHERE id = '$delete_id'";
    mysqli_query($link, $sql);
    header("Location: index.php"); // Перенаправление на текущую страницу для обновления списка пользователей
    exit();
}

echo "<p><a href='add.php' class='btn btn-primary mb-3'>Add New User</a></p>";

$sql = "SELECT * FROM users";
$users = mysqli_query($link, $sql);

if (mysqli_num_rows($users) > 0) {
    echo "<table class='table table-striped table-bordered table-hover'>
            <thead class='thead-dark'>
                <tr>
                    <th style='width: 50px;'>ID</th>
                    <th style='width: 150px;'>Login</th>
                    <th style='width: 150px;'>Password</th>
                    <th style='width: 100px;'>Role</th>
                    <th style='width: 150px;'>Do</th>
                </tr>
            </thead>
            <tbody>";
    while($row = mysqli_fetch_assoc($users)) {
        echo "<tr id='user_" . $row["id"] . "'>
                <td>" . $row["id"] . "</td>
                <td>" . $row["login"] . "</td>
                <td>" . $row["password"] . "</td>
                <td>" . $row["role"] . "</td>
                <td>
                    View 
                    <a href='edit.php?id=" . $row["id"] . "' class='btn btn-sm btn-warning ml-2'>Edit</a> 
                    <button type='button' class='btn btn-sm btn-danger ml-2 delete-btn' data-id='" . $row["id"] . "' data-toggle='modal' data-target='#deleteModal'>Del</button>
                </td>
            </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p class='alert alert-info'>No users found.</p>";
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        .table {
            margin-top: 20px;
        }
        .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">User List</h1>
    </div>

    <!-- Модальное окно подтверждения удаления -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Подтверждение удаления</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Вы уверены, что хотите удалить этого пользователя?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                    <form id="deleteForm" method="post" style="display:inline;">
                        <input type="hidden" id="delete_id" name="delete_id" value="">
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var userId = $(this).data('id');
                $('#delete_id').val(userId);
            });
        });
    </script>
</body>
</html>