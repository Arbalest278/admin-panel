<?php 
include 'connect.php';

// Функция для удаления пользователя
if (isset($_POST['delete_id']) && isset($_POST['table'])) {
    $delete_id = mysqli_real_escape_string($link, $_POST['delete_id']);
    $table = mysqli_real_escape_string($link, $_POST['table']);
    $sql = "DELETE FROM $table WHERE id = '$delete_id'";
    mysqli_query($link, $sql);
    header("Location: index.php"); // Перенаправление на текущую страницу для обновления списка пользователей
    exit();
}

// Функция для добавления пользователя
if (isset($_POST['add_user'])) {
    $login = mysqli_real_escape_string($link, $_POST['login']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $role = mysqli_real_escape_string($link, $_POST['role']);
    $sql = "INSERT INTO users (login, password, role) VALUES ('$login', '$password', '$role')";
    mysqli_query($link, $sql);
    header("Location: index.php"); // Перенаправление на текущую страницу для обновления списка пользователей
    exit();
}

// Функция для добавления клиента
if (isset($_POST['add_client'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $surname = mysqli_real_escape_string($link, $_POST['surname']);
    $firstname = mysqli_real_escape_string($link, $_POST['firstname']);
    $sql = "INSERT INTO clients (name, surname, firstname) VALUES ('$name', '$surname', '$firstname')";
    mysqli_query($link, $sql);
    header("Location: index.php"); // Перенаправление на текущую страницу для обновления списка клиентов
    exit();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }
        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }
        .sidebar .nav-link .feather {
            margin-right: 4px;
            color: #999;
        }
        .sidebar .nav-link.active {
            color: #007bff;
        }
        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
            color: inherit;
        }
        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Панель навигации -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#usersTab" data-toggle="tab">
                                <i class="fas fa-users"></i> Пользователи
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#clientsTab" data-toggle="tab">
                                <i class="fas fa-user"></i> Клиенты
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#goodsTab" data-toggle="tab">
                                <i class="fas fa-box"></i> Товары
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Основной контент -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Список пользователей</h1>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#sidebar" aria-expanded="false" aria-controls="sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

                <div class="tab-content" id="nav-tabContent">
                    <!-- Вкладка Пользователи -->
                    <div class="tab-pane fade show active" id="usersTab" role="tabpanel">
                        <p><a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal">Добавить нового пользователя</a></p>
                        <?php
                        include 'connect.php';
                        $sql = "SELECT * FROM users";
                        $users = mysqli_query($link, $sql);

                        if (mysqli_num_rows($users) > 0) {
                            echo "<table class='table table-striped table-bordered table-hover'>
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th style='width: 50px;'>ID</th>
                                            <th style='width: 150px;'>Логин</th>
                                            <th style='width: 150px;'>Пароль</th>
                                            <th style='width: 100px;'>Роль</th>
                                            <th style='width: 150px;'>Редактирование</th>
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
                                            <a href='edit.php?id=" . $row["id"] . "' class='btn btn-sm btn-warning ml-2'>Редактировать</a> 
                                            <button type='button' class='btn btn-sm btn-danger ml-2 delete-btn' data-id='" . $row["id"] . "' data-table='users' data-toggle='modal' data-target='#deleteModal'>Удалить</button>
                                        </td>
                                    </tr>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "<p class='alert alert-info'>No users found.</p>";
                        }
                        mysqli_close($link);
                        ?>
                    </div>

                    <!-- Вкладка Клиенты -->
                    <div class="tab-pane fade" id="clientsTab" role="tabpanel">
                        <p><a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addClientModal">Добавить нового клиента</a></p>
                        <?php
                        include 'connect.php';
                        $sql = "SELECT * FROM clients";
                        $clients = mysqli_query($link, $sql);

                        if (mysqli_num_rows($clients) > 0) {
                            echo "<table class='table table-striped table-bordered table-hover'>
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th style='width: 50px;'>ID</th>
                                            <th style='width: 150px;'>Имя</th>
                                            <th style='width: 150px;'>Фамилия</th>
                                            <th style='width: 100px;'>Отчество</th>
                                            <th style='width: 150px;'>Редактирование</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            while($row = mysqli_fetch_assoc($clients)) {
                                echo "<tr id='client_" . $row["id"] . "'>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["name"] . "</td>
                                        <td>" . $row["surname"] . "</td>
                                        <td>" . $row["firstname"] . "</td>
                                        <td>
                                            <a href='edit.php?id=" . $row["id"] . "' class='btn btn-sm btn-warning ml-2'>Редактировать</a> 
                                            <button class='btn btn-sm btn-danger ml-2 delete-btn' data-id='" . $row["id"] . "' data-table='clients' data-toggle='modal' data-target='#deleteModal'>Удалить</button>
                                        </td>
                                    </tr>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "<p class='alert alert-info'>No clients found.</p>";
                        }
                        mysqli_close($link);
                        ?>
                    </div>

                    <!-- Вкладка Товары -->
                    <div class="tab-pane fade" id="goodsTab" role="tabpanel">
                        <?php
                        include 'connect.php';
                        $sql = "SELECT * FROM goods";
                        $goods = mysqli_query($link, $sql);

                        if (mysqli_num_rows($goods) > 0) {
                            echo "<table class='table table-striped table-bordered table-hover'>
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th style='width: 50px;'>ID</th>
                                            <th style='width: 150px;'>Название</th>
                                            <th style='width: 150px;'>Организация</th>
                                            <th style='width: 100px;'>Стоимость</th>
                                            <th style='width: 100px;'>Уникальный номер</th>
                                            <th style='width: 150px;'>Редактирование</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            while($row = mysqli_fetch_assoc($goods)) {
                                echo "<tr id='client_" . $row["id"] . "'>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["name"] . "</td>
                                        <td>" . $row["organization"] . "</td>
                                        <td>" . $row["cost"] . "</td>
                                        <td>" . $row["dataid"] . "</td>
                                        <td>
                                            <a href='edit.php?id=" . $row["id"] . "' class='btn btn-sm btn-warning ml-2'>Редактировать</a> 
                                            <button class='btn btn-sm btn-danger ml-2 delete-btn' data-id='" . $row["id"] . "' data-table='clients' data-toggle='modal' data-target='#deleteModal'>Удалить</button>
                                        </td>
                                    </tr>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "<p class='alert alert-info'>No goods found.</p>";
                        }
                        mysqli_close($link);
                        ?>
                    </div>
                </div>
            </main>
        </div>
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
                    Вы уверены, что хотите удалить этот элемент?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                    <form id="deleteForm" method="post" style="display:inline;">
                        <input type="hidden" id="delete_id" name="delete_id" value="">
                        <input type="hidden" id="delete_table" name="table" value="">
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно для добавления пользователя -->
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Добавить нового пользователя</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" method="post">
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input type="text" class="form-control" id="login" name="login" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" class="form-control" id="role" name="role" required>
                        </div>
                        <input type="hidden" name="add_user" value="1">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно для добавления клиента -->
    <div class="modal fade" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Добавить нового клиента</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addClientForm" method="post">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="surname">Фамилия</label>
                            <input type="text" class="form-control" id="surname" name="surname" required>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Отчество</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                        <input type="hidden" name="add_client" value="1">
                        <button type="submit" class="btn btn-primary">Добавить</button>
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
                var table = $(this).data('table');
                $('#delete_id').val(userId);
                $('#delete_table').val(table);
            });
        });
    </script>
</body>
</html>