/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });

$(document).ready(function () {
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
                        $('.ajax-users-list-wrapper').html(res.html)
                    }
                    if (res.error) {
                        console.log(res.message)
                    }

                }
            });
        });
    }
});