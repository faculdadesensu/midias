function alertMsg(status, msg) {
    if (status === "success") {
        $('#success-alert').removeAttr('hidden');

        // Faz com que o alerta desapareça após 2 segundos em um tempo de 0.5 segundos de acordo com seu ID.
        $('#success-alert').hide();
        $('#success-alert').fadeTo(2000, 500).fadeOut(500);

        $('#success-msg').text(msg);
    } else if (status === "error") {
        $('#danger-alert').removeAttr('hidden');

        $('#danger-msg').text(msg);
    }
}

function startLoadding(id) {
    $('#' + id).append(" <i id='loading-" + id + "' class='fas fa-circle-notch fa-spin'></i>");
    $('#' + id).prop("disabled", true);
}

function stopLoadding(id) {
    $("#loading-" + id).remove();
    $('#' + id).prop("disabled", false);
}