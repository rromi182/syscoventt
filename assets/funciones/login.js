function loginForm(e) {
    
    e.preventDefault();
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");
    const errorMessage = document.getElementById("error-message");

    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();

   

    if (username === "" && password === "") {
        usernameInput.classList.add("is-invalid");
        passwordInput.classList.add("is-invalid");
        Swal.fire({
            icon: 'warning',
            title: 'Campos vacíos',
            text: 'Por favor completa todos los campos.',
            confirmButtonText: 'Entendido',
            scrollbarPadding: false,
    heightAuto: false
        });
        usernameInput.focus();
        return;
    }else if (username === "") {
        passwordInput.classList.remove("is-invalid");
        usernameInput.classList.add("is-invalid");
        Swal.fire({
            icon: 'warning',
            title: 'Usuario vacío',
            text: 'Por favor ingrese su usuario.',
            confirmButtonText: 'Entendido',
            scrollbarPadding: false,
            heightAuto: false
        });
        usernameInput.focus();
        return;
    }else if (password === "") {
        usernameInput.classList.remove("is-invalid");
        passwordInput.classList.add("is-invalid");
        Swal.fire({
            icon: 'warning',
            title: 'Contraseña requerida',
            text: 'Por favor ingrese su contraseña.',
            confirmButtonText: 'Entendido',
            scrollbarPadding: false,
            heightAuto: false
        });
        passwordInput.focus();
        return;
    }else{
        const url = BASE_URL + "Usuarios/validar";
        const form = document.getElementById("login-form");
        const http  = new XMLHttpRequest();
        http.open("POST",url, true);
        http.send(new FormData(form));
        http.onreadystatechange = function(){
            if(http.readyState == 4 && http.status == 200){
                const response = JSON.parse(this.responseText);
                if(response == "OK"){
                    // Opcional: Mostrar mensaje de éxito antes de redireccionar
                    Swal.fire({
                        icon: 'success',
                        title: '¡Bienvenido!',
                        text: 'Inicio de sesión exitoso',
                        timer: 1500,
                        showConfirmButton: false,
                        scrollbarPadding: false,
                        heightAuto: false
                    }).then(() => {
                        window.location = BASE_URL + "dashboard";
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de autenticación',
                        text: response,
                        confirmButtonText: 'Intentar nuevamente',
                        scrollbarPadding: false,
                        heightAuto: false
                    });
                    usernameInput.focus();
                    // Limpiar campo de contraseña
                    passwordInput.value = '';
                    passwordInput.focus();
                    return;
                }
            }
        }
    }

}

//Event listeners para Enter en Login
document.addEventListener('DOMContentLoaded', function() {
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const loginForm = document.getElementById('login-form');
    
    // Enter en usuario: pasar a contraseña
    usernameInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            passwordInput.focus();
        }
    });
    
    // Enter en contraseña: hacer login
    passwordInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            loginForm.dispatchEvent(new Event('submit'));
        }
    });
    
    // Enfocar automáticamente el campo de usuario
    usernameInput.focus();
});

