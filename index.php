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

// Функция для добавления товара
if (isset($_POST['add_good'])) {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $organization = mysqli_real_escape_string($link, $_POST['organization']);
    $cost = mysqli_real_escape_string($link, $_POST['cost']);
    $dataid = mysqli_real_escape_string($link, $_POST['dataid']);
    $image = mysqli_real_escape_string($link, $_POST['image']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $sql = "INSERT INTO goods (name, organization, cost, dataid, image, description) VALUES ('$name', '$organization', '$cost', '$dataid', '$image', '$description')";
    mysqli_query($link, $sql);
    header("Location: index.php"); // Перенаправление на текущую страницу для обновления списка товаров
    exit();
}

// Функция для редактирования пользователя
if (isset($_POST['edit_user'])) {
    $id = mysqli_real_escape_string($link, $_POST['edit_id']);
    $login = mysqli_real_escape_string($link, $_POST['login']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $role = mysqli_real_escape_string($link, $_POST['role']);
    $sql = "UPDATE users SET login = '$login', password = '$password', role = '$role' WHERE id = '$id'";
    mysqli_query($link, $sql);
    header("Location: index.php"); // Перенаправление на текущую страницу для обновления списка пользователей
    exit();
}

// Функция для редактирования клиента
if (isset($_POST['edit_client'])) {
    $id = mysqli_real_escape_string($link, $_POST['edit_id']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $surname = mysqli_real_escape_string($link, $_POST['surname']);
    $firstname = mysqli_real_escape_string($link, $_POST['firstname']);
    $sql = "UPDATE clients SET name = '$name', surname = '$surname', firstname = '$firstname' WHERE id = '$id'";
    mysqli_query($link, $sql);
    header("Location: index.php"); // Перенаправление на текущую страницу для обновления списка клиентов
    exit();
}

// Функция для редактирования товара
if (isset($_POST['edit_good'])) {
    $id = mysqli_real_escape_string($link, $_POST['edit_id']);
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $organization = mysqli_real_escape_string($link, $_POST['organization']);
    $cost = mysqli_real_escape_string($link, $_POST['cost']);
    $dataid = mysqli_real_escape_string($link, $_POST['dataid']);
    $image = mysqli_real_escape_string($link, $_POST['image']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $sql = "UPDATE goods SET name = '$name', organization = '$organization', cost = '$cost', dataid = '$dataid', image = '$image', description = '$description' WHERE id = '$id'";
    mysqli_query($link, $sql);
    header("Location: index.php"); // Перенаправление на текущую страницу для обновления списка товаров
    exit();
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список пользователей</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Панель навигации -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#usersTab" data-toggle="tab" data-title="Список пользователей">
                                <i class="fas fa-users"></i> Пользователи
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#clientsTab" data-toggle="tab" data-title="Список клиентов">
                                <i class="fas fa-user"></i> Клиенты
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#goodsTab" data-toggle="tab" data-title="Список товаров">
                                <i class="fas fa-box"></i> Товары
                            </a>
                        </li>
                    </ul>
                    <div class="mt-auto">
                        <button class="btn btn-primary btn-block" type="button" id="toggleSidebar">
                            <i class="fas fa-bars"></i> Свернуть/Развернуть
                        </button>
                        <button class="btn btn-secondary btn-block" type="button" id="toggleTheme">
                            <i class="fas fa-adjust"></i> Переключить тему
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Основной контент -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2" id="pageTitle">Список пользователей</h1>
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
                                            <button type='button' class='btn btn-sm btn-warning ml-2 edit-btn' data-id='" . $row["id"] . "' data-toggle='modal' data-target='#editUserModal'>Редактировать</button> 
                                            <button type='button' class='btn btn-sm btn-danger ml-2 delete-btn' data-id='" . $row["id"] . "' data-toggle='modal' data-target='#deleteModal'>Удалить</button>
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
                                            <button type='button' class='btn btn-sm btn-warning ml-2 edit-btn' data-id='" . $row["id"] . "' data-toggle='modal' data-target='#editClientModal'>Редактировать</button> 
                                            <button class='btn btn-sm btn-danger ml-2 delete-btn' data-id='" . $row["id"] . "' data-toggle='modal' data-target='#deleteModal'>Удалить</button>
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
                        <p><a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addGoodModal">Добавить новый товар</a></p>
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
                                echo "<tr id='good_" . $row["id"] . "'>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["name"] . "</td>
                                        <td>" . $row["organization"] . "</td>
                                        <td>" . $row["cost"] . "</td>
                                        <td>" . $row["dataid"] . "</td>
                                        <td>
                                            <button type='button' class='btn btn-sm btn-warning ml-2 edit-btn' data-id='" . $row["id"] . "' data-toggle='modal' data-target='#editGoodModal'>Редактировать</button> 
                                            <button class='btn btn-sm btn-danger ml-2 delete-btn' data-id='" . $row["id"] . "' data-toggle='modal' data-target='#deleteModal'>Удалить</button>
                                            <button class='btn btn-sm btn-info ml-2 detail-btn' data-id='" . $row["id"] . "' data-toggle='modal' data-target='#detailModal'>Подробнее</button>
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
                        <button type="submit" class="btn btn-primary" name="add_user">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно для редактирования пользователя -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Редактировать пользователя</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" method="post">
                        <input type="hidden" id="edit_user_id" name="edit_id" value="">
                        <div class="form-group">
                            <label for="edit_login">Login</label>
                            <input type="text" class="form-control" id="edit_login" name="login" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_password">Password</label>
                            <input type="password" class="form-control" id="edit_password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_role">Role</label>
                            <input type="text" class="form-control" id="edit_role" name="role" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="edit_user">Сохранить</button>
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
                        <button type="submit" class="btn btn-primary" name="add_client">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно для редактирования клиента -->
    <div class="modal fade" id="editClientModal" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel">Редактировать клиента</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editClientForm" method="post">
                        <input type="hidden" id="edit_client_id" name="edit_id" value="">
                        <div class="form-group">
                            <label for="edit_name">Имя</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_surname">Фамилия</label>
                            <input type="text" class="form-control" id="edit_surname" name="surname" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_firstname">Отчество</label>
                            <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="edit_client">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно для добавления товара -->
    <div class="modal fade" id="addGoodModal" tabindex="-1" role="dialog" aria-labelledby="addGoodModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGoodModalLabel">Добавить новый товар</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addGoodForm" method="post">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="organization">Организация</label>
                            <input type="text" class="form-control" id="organization" name="organization" required>
                        </div>
                        <div class="form-group">
                            <label for="cost">Стоимость</label>
                            <input type="text" class="form-control" id="cost" name="cost" required>
                        </div>
                        <div class="form-group">
                            <label for="dataid">Уникальный номер</label>
                            <input type="text" class="form-control" id="dataid" name="dataid" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Изображение</label>
                            <input type="text" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_good">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно для редактирования товара -->
    <div class="modal fade" id="editGoodModal" tabindex="-1" role="dialog" aria-labelledby="editGoodModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGoodModalLabel">Редактировать товар</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editGoodForm" method="post">
                        <input type="hidden" id="edit_good_id" name="edit_id" value="">
                        <div class="form-group">
                            <label for="edit_name">Название</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_organization">Организация</label>
                            <input type="text" class="form-control" id="edit_organization" name="organization" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_cost">Стоимость</label>
                            <input type="text" class="form-control" id="edit_cost" name="cost" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_dataid">Уникальный номер</label>
                            <input type="text" class="form-control" id="edit_dataid" name="dataid" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_image">Изображение</label>
                            <input type="text" class="form-control" id="edit_image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_description">Описание</label>
                            <input type="text" class="form-control" id="edit_description" name="description" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="edit_good">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно для просмотра деталей товара -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Детали товара</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="detailContent">
                        <!-- Здесь будут отображаться детали товара -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Управление кнопкой для сворачивания/разворачивания панели навигации
            $('#toggleSidebar').click(function() {
                $('#sidebar').toggleClass('collapse');
            });

            // Изменение заголовка страницы при переключении вкладок
            $('.nav-link').click(function() {
                var title = $(this).data('title');
                $('#pageTitle').text(title);
            });

            // Управление модальным окном удаления
            $('.delete-btn').click(function() {
                var id = $(this).data('id');
                var table = $(this).closest('table').data('table');
                $('#delete_id').val(id);
                $('#delete_table').val(table);
            });

            // Заполнение модального окна для редактирования пользователя
            $('#editUserModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                modal.find('#edit_user_id').val(id);

                $.ajax({
                    url: 'get_data.php',
                    type: 'POST',
                    data: { id: id, table: 'users' },
                    success: function(response) {
                        var data = JSON.parse(response);
                        modal.find('#edit_login').val(data.login);
                        modal.find('#edit_password').val(data.password);
                        modal.find('#edit_role').val(data.role);
                    }
                });
            });

            // Заполнение модального окна для редактирования клиента
            $('#editClientModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                modal.find('#edit_client_id').val(id);

                $.ajax({
                    url: 'get_data.php',
                    type: 'POST',
                    data: { id: id, table: 'clients' },
                    success: function(response) {
                        var data = JSON.parse(response);
                        modal.find('#edit_name').val(data.name);
                        modal.find('#edit_surname').val(data.surname);
                        modal.find('#edit_firstname').val(data.firstname);
                    }
                });
            });

            // Заполнение модального окна для редактирования товара
            $('#editGoodModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                modal.find('#edit_good_id').val(id);

                $.ajax({
                    url: 'get_data.php',
                    type: 'POST',
                    data: { id: id, table: 'goods' },
                    success: function(response) {
                        var data = JSON.parse(response);
                        modal.find('#edit_name').val(data.name);
                        modal.find('#edit_organization').val(data.organization);
                        modal.find('#edit_cost').val(data.cost);
                        modal.find('#edit_dataid').val(data.dataid);
                        modal.find('#edit_image').val(data.image);
                        modal.find('#edit_description').val(data.description);
                    }
                });
            });

            // Заполнение модального окна для просмотра деталей товара
            $('#detailModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);

                $.ajax({
                    url: 'get_data.php',
                    type: 'POST',
                    data: { id: id, table: 'goods' },
                    success: function(response) {
                        var data = JSON.parse(response);
                        var content = `
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="${data.image}" alt="Изображение товара" class="img-fluid">
                                </div>
                                <div class="col-md-6">
                                    <h5>${data.name}</h5>
                                    <p><strong>Организация:</strong> ${data.organization}</p>
                                    <p><strong>Стоимость:</strong> ${data.cost}</p>
                                    <p><strong>Уникальный номер:</strong> ${data.dataid}</p>
                                    <p><strong>Описание:</strong> ${data.description}</p>
                                </div>
                            </div>
                        `;
                        modal.find('#detailContent').html(content);
                    }
                });
            });

            // Переключение темной и светлой темы
            $('#toggleTheme').click(function() {
                $('body').toggleClass('bg-dark text-white');
                $('.table').toggleClass('table-dark');
                $('.thead-dark').toggleClass('thead-light');
                $('.modal-content').toggleClass('bg-dark text-white');
                $('.modal-header').toggleClass('bg-dark text-white');
                $('.modal-body').toggleClass('bg-dark text-white');
                $('.modal-footer').toggleClass('bg-dark text-white');
            });
        });
    </script>
</body>
</html>