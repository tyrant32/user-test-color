/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function () {

    // Users Filter Ajax Call
    if ($('#users-list-filter').length) {
        $('#users-list-filter').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: usersListAjaxUrl,
                method: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        $('.ajax-users-list-wrapper').html(res.html);
                        $('.messages').html('<div class="alert alert-success" role="alert">Users has been filtered.</div>');
                        $('.messages .alert').fadeOut(3500);
                    }
                    if (res.error) {
                        $('.messages').html('<div class="alert alert-danger" role="alert">Something is wrong please try again later...</div>');
                        $('.messages .alert').fadeOut(3500);
                    }
                }
            });
        });
    }

    // Show Modal Ajax Call
    if ($('.ajax-users-list-wrapper table tbody tr').length) {
        $('.ajax-users-list-wrapper table tbody tr').on('click', function () {
            var currentUser = $(this).attr('id');

            $.ajax({
                url: usersModalAjaxUrl,
                method: 'post',
                data: {user: currentUser, _token: currentToken},
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        $('.ajax-modal-wrapper').html(res.html);
                        $('.' + currentUser + '-modal-button').trigger('click');
                    }
                    if (res.error) {
                        $('.messages').html('<div class="alert alert-danger" role="alert">Something is wrong please try again later...</div>');
                        $('.messages .alert').fadeOut(3500);
                    }
                }
            });

        });
    }
});