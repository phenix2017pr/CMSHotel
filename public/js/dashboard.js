$(document).ready(function(){

    $('#addUserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var value = button.data('value');
        var role = button.data('role');
        var modal = $(this)
        modal.find('.title').text(role);
        modal.find('.role').val(value);
        console.log(role);
    });

    $('.panel').on('click', '.delete-meal-type', function () {
        var url = '/dashboard/meal-types';
        var id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            data: {_method: 'delete', _token: token},
            success: function (data) {
                console.log(data);

                $("#meal-type" + id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        return false;
    });


    $('.panel').on('click', '.restore-meal', function () {
        var id = $(this).val();
        var url = '/dashboard/meals/restore';
        var token = $(this).data('token');
        $.ajax({
            url: url,
            type: 'post',
            data: {_token: token, id : id},
            success: function (data) {
                //console.log(data);
                var row = $("#meal" + id);
                var button = row.find('.restore-meal');
                row.removeClass('text-muted').removeAttr('title');
                button.children('i').removeClass('fa-cart-plus').addClass('fa-trash');
                button.addClass('delete-meal').removeClass('restore-meal').removeAttr('title');

                row.parent().prepend(row);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        return false;
    });

    $('.panel').on('click', '.delete-meal', function () {
        var url = '/dashboard/meals';
        var id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            data: {_method: 'delete', _token: token},
            success: function (data) {
                var row = $("#meal" + id);
                var button = row.find('.delete-meal');
                row.addClass('text-muted').attr('title', 'This meal is not visible on page');
                button.children('i').removeClass('fa-trash').addClass('fa-cart-plus');
                button.addClass('restore-meal').removeClass('delete-meal').attr('title', 'Make meal visible on page');
                row.parent().append(row);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        return false;
    });

    $('.panel').on('click', '.restore-room', function () {
        var id = $(this).val();
        var url = '/dashboard/rooms/restore';
        var token = $(this).data('token');
        $.ajax({
            url: url,
            type: 'post',
            data: {_token: token, id : id},
            success: function (data) {
                //console.log(data);
                var row = $("#room" + id);
                var button = row.find('.restore-room');
                row.removeClass('text-muted').removeAttr('title');
                button.children('i').removeClass('fa-cart-plus').addClass('fa-trash');
                button.addClass('delete-room').removeClass('restore-room').removeAttr('title');

                row.parent().prepend(row);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        return false;
    });

    $('.panel').on('click','.delete-room', function () {
        var url = '/dashboard/rooms';
        var id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            data: {_method: 'delete', _token: token},
            success: function (data) {
                console.log(data);
                //$("#room" + id).remove();
                var row = $("#room" + id);
                var button = row.find('.delete-room');
                row.addClass('text-muted').attr('title', 'This room is not available for staff');
                button.children('i').removeClass('fa-trash').addClass('fa-cart-plus');
                button.addClass('restore-room').removeClass('delete-room').attr('title', 'Make room available for reservation');
                row.parent().append(row);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('.panel').on('click', '.delete-drink', function () {
        var url = '/dashboard/drinks';
        var id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            data: {_method: 'delete', _token: token},
            success: function (data) {
                console.log(data);
                $("#drink" + id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        return false;
    });

    $('.panel').on('click', '.delete-table', function () {
        var url = '/dashboard/tables';
        var id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            data: {_method: 'delete', _token: token},
            success: function (data) {
                console.log(data);
                $("#table" + id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        return false;
    });

    $('.panel').on('click', '.restore-activity', function () {
        var id = $(this).val();
        var url = '/dashboard/activities/restore';
        var token = $(this).data('token');
        $.ajax({
            url: url,
            type: 'post',
            data: {_token: token, id : id},
            success: function (data) {
                //console.log(data);
                var row = $("#activity" + id);
                var button = row.find('.restore-activity');
                row.removeClass('text-muted').removeAttr('title');
                button.children('i').removeClass('fa-cart-plus').addClass('fa-trash');
                button.addClass('delete-activity').removeClass('restore-activity').removeAttr('title');

                row.parent().prepend(row);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        return false;
    });

    $('.panel').on('click', '.delete-activity', function () {
        var url = '/dashboard/activities';
        var id = $(this).val();
        var token = $(this).data('token');
        $.ajax({
            url: url + '/' + id,
            type: 'delete',
            data: {_method: 'delete', _token: token},
            success: function (data) {
                var row = $("#activity" + id);
                var button = row.find('.delete-activity');
                row.addClass('text-muted').attr('title', 'This activity is not available for reservation');
                button.children('i').removeClass('fa-trash').addClass('fa-cart-plus');
                button.addClass('restore-activity').removeClass('delete-activity').attr('title', 'Make activity available for reservation');
                row.parent().append(row);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        return false;
    });

    $('.btn-check').on('click', function () {
        var btn = $(this);
        var id = btn.val();
        var url = '/dashboard/' + btn.data('type') + '/' + id + '/check-in';
        var token = btn.data('token');
        $.ajax({
            url:url,
            type:'post',
            data: {_token:token},
            success: function (data) {
                console.log(btn);
                btn.removeClass('btn-default').addClass('btn-success');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        return false;
    });

});