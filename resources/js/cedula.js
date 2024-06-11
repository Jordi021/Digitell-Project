function verificarCedula(cedula) {
    if (typeof(cedula) == 'string' && cedula.length == 10 && /^\d+$/.test(cedula)) {
      var digitos = cedula.split('').map(Number);
      var codigo_provincia = digitos[0] * 10 + digitos[1];
  
      //if (codigo_provincia >= 1 && (codigo_provincia <= 24 || codigo_provincia == 30) && digitos[2] < 6) {
  
      if (codigo_provincia >= 1 && (codigo_provincia <= 24 || codigo_provincia == 30)) {
        var digito_verificador = digitos.pop();
  
        var digito_calculado = digitos.reduce(
          function (valorPrevio, valorActual, indice) {
            return valorPrevio - (valorActual * (2 - indice % 2)) % 9 - (valorActual == 9) * 9;
          }, 1000) % 10;
        return digito_calculado === digito_verificador;
  }
    }
    return false;
  }
