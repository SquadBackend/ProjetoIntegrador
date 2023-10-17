function validarNumero(event) {
    const keyCode = event.keyCode || event.which;
    const teclaPermitida = /[0-9]/.test(String.fromCharCode(keyCode));
    if (!teclaPermitida) {
        event.preventDefault();
    }
}