$('.change-password').on('click', function () {
    $.ajax({
        url: $(this).attr('data-remote'),
        type: 'PUT',
        data: {
            old_password: $('#old_password').val(),
            password: $('#password').val(),
            password_confirmation: $('#password_confirmation').val(),
        },
        success: function (response) {
            if (response.code === 202) {
                toastr.success(response.message)
                $('#old_password').removeClass('is-invalid');
                $('.old_password').html('');
                $('#password').removeClass('is-invalid');
                $('.password').html('');
                $('#password_confirmation').removeClass('is-invalid');
                $('.password_confirmation').html('');
            } else if (response.code === 403) {
                if (response.validate.old_password) {
                    $('#old_password').addClass('is-invalid');
                    $('.old_password').html(response.validate.old_password);
                } else {
                    $('#old_password').removeClass('is-invalid');
                    $('.old_password').html('');
                }
                if (response.validate.password) {
                    $('#password').addClass('is-invalid');
                    $('.password').html(response.validate.password);
                } else {
                    $('#password').removeClass('is-invalid');
                    $('.password').html('');
                }
                toastr.warning(response.message)
                if (response.validate.password_confirmation) {
                    $('#password_confirmation').addClass('is-invalid');
                    $('.password_confirmation').html(response.validate.password_confirmation);
                } else {
                    $('#password_confirmation').removeClass('is-invalid');
                    $('.password_confirmation').html('');
                }
            } else {
                toastr.error(response.message)
            }
        }
    })
})
