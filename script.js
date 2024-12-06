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
        var userId = $(this).data('id');
        var table = $(this).data('table');
        console.log(userId);
        console.log(table);
        $('#delete_id').val(userId);
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
                $('#editPreviewImage').attr('src', data.image).show();
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

    // Предпросмотр изображения при добавлении товара
    $('#image').on('input', function() {
        var imageUrl = $(this).val();
        if (imageUrl) {
            $('#previewImage').attr('src', imageUrl).show();
        } else {
            $('#previewImage').hide();
        }
    });

    // Предпросмотр изображения при редактировании товара
    $('#edit_image').on('input', function() {
        var imageUrl = $(this).val();
        if (imageUrl) {
            $('#editPreviewImage').attr('src', imageUrl).show();
        } else {
            $('#editPreviewImage').hide();
        }
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