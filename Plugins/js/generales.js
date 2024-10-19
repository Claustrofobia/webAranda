$(document).ready(function () {
  jQuery.extend(jQuery.validator.messages, {
    required: 'Este campo es obligatorio.',
    remote: 'Por favor, rellena este campo.',
    email: 'Por favor, escribe una dirección de correo válida',
    url: 'Por favor, escribe una URL válida.',
    date: 'Por favor, escribe una fecha válida.',
    dateISO: 'Por favor, escribe una fecha (ISO) válida.',
    number: 'Por favor, escribe un número entero válido.',
    digits: 'Por favor, escribe sólo dígitos.',
    creditcard: 'Por favor, escribe un número de tarjeta válido.',
    equalTo: 'Por favor, escribe el mismo valor de nuevo.',
    pattern: 'Formato no válido. Carácteres no permitidos ingresados o el limite de caracteres a llegado a su maximo',
    accept: 'Formatos válidos {0}',
    maxlength: jQuery.validator.format('Por favor, no escribas más de {0} caracteres.'),
    minlength: jQuery.validator.format('Por favor, no escribas menos de {0} caracteres.'),
    rangelength: jQuery.validator.format('Por favor, escribe un valor entre {0} y {1} caracteres.'),
    range: jQuery.validator.format('Por favor, escribe un valor entre {0} y {1}.'),
    max: jQuery.validator.format('Por favor, escribe un valor menor o igual a {0}.'),
    min: jQuery.validator.format('Por favor, escribe un valor mayor o igual a {0}.'),
    extension: jQuery.validator.format('Por favor introduce un formato válido'),
    filesize: jQuery.validator.format(`El archivo no debe superar los MB establecidos`)
  });

  $(document).on('keyup', '#menu-search', function () {
    let searchText = $(this).val().toLowerCase();
    let menuInner = $('.menu-inner'); // Selecciona el contenedor con la clase 'menu-inner'

    $('.menu-item').each(function () {
      let menuItemText = $(this).text().toLowerCase();

      if (menuItemText.includes(searchText)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
    // Desplaza el contenedor con la clase 'menu-inner' hasta arriba
    menuInner.scrollTop(0);
  });
});

function inicializarSelect2(id, clasemodal) {
  $('#' + id).select2({
    placeholder: 'Elige una opción',
    allowClear: true,
    dropdownParent: $('.' + clasemodal),
    language: {
      noResults: function () {
        return 'No hay resultado';
      },
      searching: function () {
        return 'Buscando...';
      }
    }
  });
}

// Función para destruir select2 si ya está inicializado
function destruirSelect2(id) {
  if ($('#' + id).hasClass('select2-hidden-accessible')) {
    $('#' + id).select2('destroy');
  }
}

function armarDataTable(tablaID, finaNoOrdenar, filaOrdenar, forma, state) {
  $('#' + tablaID).DataTable({
    //Iniciamos el datatables y le colocamos la configuracion
    language: {
      decimal: '',
      emptyTable: 'No hay ningún registro',
      info: 'Mostrando _START_ a _END_ de _TOTAL_ Entradas',
      infoEmpty: 'Mostrando 0 a 0 de 0 Registros',
      infoFiltered: '(Filtrado de _MAX_ total registros)',
      infoPostFix: '',
      thousands: ',',
      lengthMenu: 'Mostrar _MENU_ Entradas',
      loadingRecords: 'Cargando...',
      processing: 'Procesando...',
      search: 'Buscar:',
      zeroRecords: 'No se encontraron resultados',
      paginate: {
        first: 'Primero',
        last: 'Ultimo',
        next: 'Siguiente',
        previous: 'Anterior'
      }
    },
    colReorder: true,
    autoWidth: true,
    stateSave: state,
    responsive: true,
    scrollCollapse: true,
    scrollY: '500px',
    scrollX: true,
    fixedHeader: true,
    deferRender: true,
    processing: true,
    order: [[filaOrdenar, forma]],
    columnDefs: [
      { orderable: false, targets: finaNoOrdenar } // Aquí indicas que la columna no es ordenable
    ],
    initComplete: function () {
      // Focar el campo de búsqueda
      $('#' + tablaID + '_filter input').focus();
    }
  });
  // Añadir margen al contenedor del campo de búsqueda
  $('#' + tablaID + '_filter').css('margin-bottom', '10px');
}

function sweetalert2(titulo, mensaje, tipo) {
  swal({
    allowOutsideClick: false,
    allowEscapeKey: false,
    title: titulo,
    html: mensaje,
    type: tipo
  });
}

function verAlertaSuperior(titulo, mensaje, tipo, tiempo) {
  if (tipo == 'error') {
    //Si el tipo es igual a error
    toastr.error(
      //Mostramos una alerta simple
      titulo,
      mensaje,
      {
        timeOut: tiempo
      }
    );
  } else if (tipo == 'success') {
    //Si el tipo es igual a success
    toastr.success(
      //Mostramos una alerta simple
      titulo,
      mensaje,
      {
        timeOut: tiempo
      }
    );
  } else if (tipo == 'warning') {
    toastr.warning(
      //Mostramos una alerta simple
      titulo,
      mensaje,
      {
        timeOut: tiempo
      }
    );
  } else if (tipo == 'info') {
    toastr.info(
      //Mostramos una alerta simple
      titulo,
      mensaje,
      {
        timeOut: tiempo
      }
    );
  }
}
//Metodo para limpiar el formulario y quitarle los mensajes de error
function resetearFormulario(form) {
  $(form)[0].reset();
  $(form).validate().resetForm();
  $(form).validate().destroy();

  // Remover las clases de error de los campos
  $(form).find('.border-danger').removeClass('border-danger');
  $(form).find('.text-danger').removeClass('text-danger');
}

function MAYUSBB(campo) {
  let p = $('#' + campo)[0].selectionStart;
  $('#' + campo).val(
    $('#' + campo)
      .val()
      .toUpperCase()
  );
  $('#' + campo)[0].setSelectionRange(p, p);
}

function armarSelect(url, idSelect,data, tema, subtema, idData) {
  $('#openModal3').show();
  $('#' + idSelect).empty();
  $.ajax({
    url: url,
    type: 'POST',
    data: data,
    success: jsonResponse => {
      if(jsonResponse!=""){
        let response = JSON.parse(jsonResponse);
        if (response.status == 'success') {
          // Crea un array de opciones
          let opciones = [];
          opciones.push({
            text: 'Seleccione una opción',
            id: ''
          });
  
          if (subtema == '') {
            $.each(response.datos, function (index, elemento) {
              opciones.push({
                id: elemento[idData],
                text: elemento[tema]
              });
            });
          } else {
            $.each(response.datos, function (index, elemento) {
              opciones.push({
                id: elemento[idData],
                text: elemento[tema] + ' - ' + elemento[subtema]
              });
            });
          }
  
          // Agrega cada opción al selector
          $.each(opciones, function (index, opcion) {
            let nuevaOpcion = new Option(opcion.text, opcion.id);
            $('#' + idSelect).append(nuevaOpcion);
          });
  
          // Actualiza el selector para reflejar los cambios
          $('#' + idSelect).trigger('change');
  
          $('#' + idSelect).change(function () {
            if (this.value !== '') {
              $(this).find('option[value=""]').remove();
            }
          });
        } else if (response.status == 'error') {
          sweetalert2(response.titulo, response.mensaje, response.status);
        }
      }

    },
    error: response => {
      sweetalert2('Error interno del servidor', response.responseJSON.message, 'error');
    },
    complete: function () {
        $('#openModal3').hide();
    }
  });
}

function activarCamposFormulario(idFormulario) {
  $(idFormulario).find(':input:not(.noafectar), textarea:not(.noafectar)').removeAttr('disabled');
}

//Método para desactivar campos del formulario
function desactivarCamposFormulario(idFormulario) {
  $(idFormulario)
    .find(":input:not(:button, [type='submit'], [type='reset']):not(.noafectar), textarea:not(.noafectar)")
    .attr('disabled', true);
}

// Mantener un registro de las opciones agregadas
function llenadoSelectIndividual(idSelect, tema, subtema, idData, data) {
  // Obtener el selector usando el ID proporcionado
  let selector = $('#' + idSelect);

  // Limpiar todas las opciones existentes
  selector.empty();

  // Crear un array de opciones con la opción inicial
  let opciones = [];

  // Envolver el objeto data en un array para que se lea como un solo elemento
  let dataArray = [data];

  // Iterar sobre el objeto data como un solo elemento
  if (subtema == '') {
    $.each(dataArray, function (index, elemento) {
      opciones.push({
        id: elemento[idData],
        text: elemento[tema]
      });
    });
  } else {
    $.each(dataArray, function (index, elemento) {
      opciones.push({
        id: elemento[idData],
        text: elemento[tema] + ' - ' + elemento[subtema]
      });
    });
  }

  // Agregar cada opción al selector
  $.each(opciones, function (index, opcion) {
    let nuevaOpcion = new Option(opcion.text, opcion.id);
    $(nuevaOpcion).addClass('agregada'); // Agregar clase 'agregada'
    selector.append(nuevaOpcion);
  });

  // Actualizar el selector para reflejar los cambios
  selector.trigger('change');
}

function armarSelectLocal(datos, idSelect, tema, subtema, idData) {
  let dataObj = {};
  $('#' + idSelect).empty();
  // Crea un array de opciones
  let opciones = [];
  opciones.push({
    text: 'Seleccione una opción',
    id: ''
  });

  if (subtema == '') {
    $.each(datos, function (index, elemento) {
      opciones.push({
        id: elemento[idData],
        text: elemento[tema]
      });
    });
  } else {
    $.each(datos, function (index, elemento) {
      opciones.push({
        id: elemento[idData],
        text: elemento[tema] + ' - ' + elemento[subtema]
      });
    });
  }

  // Agrega cada opción al selector
  $.each(opciones, function (index, opcion) {
    let nuevaOpcion = new Option(opcion.text, opcion.id);
    $('#' + idSelect).append(nuevaOpcion);
  });

  // Actualiza el selector para reflejar los cambios
  $('#' + idSelect).trigger('change');

  $('#' + idSelect).change(function () {
    if (this.value !== '') {
      $(this).find('option[value=""]').remove();
    }
  });
}

function formatearFecha(fecha) {
  const año = fecha.getFullYear();
  const mes = String(fecha.getMonth() + 1).padStart(2, '0'); // Los meses en JavaScript van de 0 a 11
  const dia = String(fecha.getDate()).padStart(2, '0');
  return `${año}-${mes}-${dia}`;
}

function validacionesArchivos(idInput, extensionesPermitidas, extensionesPermitidasTexto, callback) {
  let archivoInput = document.getElementById(idInput);
  let archivo = archivoInput.files[0];

  if (archivo) {
    let extension = archivo.name.split('.').pop().toLowerCase();
    if ($.inArray(extension, extensionesPermitidas) === -1) {
      $('#' + idInput).val('');
      sweetalert2(
        'El archivo no cumple los requisitos',
        `El archivo debe ser de tipo: ` + extensionesPermitidasTexto,
        'info'
      );
      callback(false);
      return;
    }

    let tamañoArchivo = archivo.size;
    let tamañoEnMB = tamañoArchivo / (1024 * 1024);

    if (tamañoEnMB > 5) {
      $('#' + idInput).val('');
      sweetalert2('El archivo es demasiado grande', `Debe agregar un archivo menor a 5MB`, 'info');
      callback(false);
      return;
    }

    callback(true);
  } else {
    callback(false);
  }
}

function cambioPasswordText(idInput, idButtonI) {
  let input = $('#' + idInput);
  let icono = $('#' + idButtonI);
  if (input.attr('type') === 'password') {
    input.attr('type', 'text');
    icono.removeClass('bx-hide');
    icono.addClass('bx-show');
  } else {
    input.attr('type', 'password');
    icono.removeClass('bx-show');
    icono.addClass('bx-hide');
  }
}

function readURL(input, imagePreview) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#' + imagePreview).css('background-image', 'url(' + e.target.result + ')');
      $('#' + imagePreview).hide();
      $('#' + imagePreview).fadeIn(650);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

$.validator.addMethod(
  'greaterThanOrEqualTo',
  function (value, element, param) {
    return new Date(value) >= new Date($(param).val());
  },
  'La fecha fin debe ser mayor o igual a la fecha de inicio.'
);

$.validator.addMethod(
  'mayorIgualActual',
  function (value, element, param) {
    // Ensure value is a valid date string
    let valueDate = new Date(value);
    let currentDate = new Date();

    valueDate.setDate(valueDate.getDate() + 2);

    // Check if valueDate is greater than or equal to currentDate
    return valueDate >= currentDate;
  },
  'La fecha fin debe ser mayor o igual a la fecha actual.'
);

function abrirArchivoDesdeBase64(base64String, mimeType, fileName) {
  // Decodificar la cadena base64
  var byteCharacters = atob(base64String);
  var byteNumbers = new Array(byteCharacters.length);
  for (var i = 0; i < byteCharacters.length; i++) {
    byteNumbers[i] = byteCharacters.charCodeAt(i);
  }
  var byteArray = new Uint8Array(byteNumbers);

  // Crear un objeto Blob a partir de los datos decodificados
  var blob = new Blob([byteArray], { type: mimeType });

  // Crear una URL para el Blob
  var url = URL.createObjectURL(blob);

  // Abrir una nueva pestaña con el archivo
  var a = document.createElement('a');
  a.href = url;
  a.target = '_blank';
  a.download = fileName; // Agregar el atributo download
  document.body.appendChild(a);
  a.click();

  // Limpiar la URL creada
  setTimeout(function () {
    window.URL.revokeObjectURL(url);
    document.body.removeChild(a); // Eliminar el elemento <a> después de la descarga
  }, 0);
}

function diaActual() {
  // Crear una nueva instancia del objeto Date
  const fechaActual = new Date();

  // Obtener el día, mes y año
  const dia = String(fechaActual.getDate()).padStart(2, '0');
  const mes = String(fechaActual.getMonth() + 1).padStart(2, '0'); // Los meses empiezan desde 0
  const anio = fechaActual.getFullYear();

  // Formatear la fecha en el formato yyyy-mm-dd
  const fechaFormateada = `${anio}-${mes}-${dia}`;

  // Establecer el valor del input date
  return fechaFormateada;
}
