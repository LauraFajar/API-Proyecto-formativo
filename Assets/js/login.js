$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        const email = $('#email').val();
        const password = $('#password').val();

        $.ajax({
            url: 'http://localhost/championFramework/usuario/login',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ email: email, password: password }),
            success: function(response) {
                if (response.status) {
                    alert('Inicio de sesión exitoso');
                    // Redirect to another page or perform other actions
                } else {
                    alert('Error de inicio de sesion: ' + response.msg);
                }
            },
            error: function() {
                alert('Se ha producido un error. Inténtalo de nuevo.');
            }
        });
    });
});