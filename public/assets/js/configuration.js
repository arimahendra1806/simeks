$(document).ready(function () {
    /* Ajax Token */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.js-select2').each(function () {
        var placeholder = $(this).data('placeholder');
        $(this).select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: placeholder,
        });
    });

    $('.js-currency').on('input', function () {
        var input_val = $(this).val();
        $(this).val(format_currency(input_val));
    });

    $(".js-datepicker").datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        orientation: "auto",
        todayHighlight: true
    });
})

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

function notif_success(message = '') {
    var perfData = window.performance.timing
    var EstimatedTime = -(perfData.loadEventEnd - perfData.navigationStart)
    var time = parseInt((EstimatedTime / 1000) % 60) * 30;

    setTimeout(function () {
        Toast.fire({
            icon: "success",
            title: "Berhasil! " + message
        });
    }, time);
}

function notif_error(message = '') {
    var perfData = window.performance.timing
    var EstimatedTime = -(perfData.loadEventEnd - perfData.navigationStart)
    var time = parseInt((EstimatedTime / 1000) % 60) * 30;

    setTimeout(function () {
        Toast.fire({
            icon: "error",
            title: "Terjadi Kesalahan! " + message
        });
    }, time);
}

function displayErrors(errors) {
    removeErrors();
    $.each(errors, function (field, messages) {
        var inputField = $('[name="' + field + '"]');
        inputField.addClass('is-invalid');
        inputField.after('<div class="invalid-feedback">' + messages.join('<br>') + '</div>');
    });
}

function removeErrors() {
    $('.invalid-feedback').remove();
    $('input, select, textarea').removeClass('is-invalid');
}

function format_currency(value) {
    value = value.replace(/[^0-9]/g, '');
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    return value;
}

function url_path(part) {
    let path = window.location.pathname;
    let segments = path.split('/').filter(segment => segment.length > 0);
    if (part > 0 && part <= segments.length) {
        let urlPart = segments.slice(0, part).join('/');
        return `/${urlPart}`;
    } else {
        return '/';
    }
}


