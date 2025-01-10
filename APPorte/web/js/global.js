$(document).ready(function(){
    $('#registrar-ciudadano-form').submit(function(event) {
        // Evita el envío del formulario si hay errores
        event.preventDefault();
        
        // limpia mensajes de error previos
        $('#error').html('');
        
        // bandera para verificar si hay errores
        let esValido = true;
    
        // Verificar si hay campos vacíos
        if ($('#primer_nombre').val().trim() === "" || 
            $('#primer_apellido').val().trim() === "" || 
            $('#segundo_apellido').val().trim() === "" || 
            $('#correo').val().trim() === "" || 
            $('#telefono').val().trim() === "" || 
            $('#clave').val().trim() === "" || 
            $('#confirmar_clave').val().trim() === "" || 
            $('#usu_documento').val().trim() === "" || 
            $('#carrera').val().trim() === "" || 
            $('#calle').val().trim() === "" || 
            $('#numero_adicional').val().trim() === "" || 
            $('#complemento').val().trim() === "" || 
            $('#barrio').val().trim() === "" || 
            $('#genero').val().trim() === ""){
    
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'Faltan campos por rellenar.',
                confirmButtonText: 'Aceptar'
            });
            esValido = false;
        }
        // selectores
        const tipoDocumento = $('#usu_tipo_documento').val();
        const genero = $('#genero').val();
        const rolId = $('#rol_id').val();

        if (!tipoDocumento) {
            $('#error_usu_tipo_documento').text('El tipo de documento es obligatorio.');
            esValido = false;
        }

        const documento = $('#usu_documento').val().trim();
        if (documento === "") {
            $('#error_usu_documento').text('El número de documento es obligatorio.');
            esValido = false;
        } else if (!/^\d+$/.test(documento)) {
            $('#error_usu_documento').text('El número de documento solo puede contener números.');
            esValido = false;
        }

        if (!genero) {
            $('#error_genero').text('El género es obligatorio.');
            esValido = false;
        }

        // Validar primer_nombre
        const primer_nombre = $('#primer_nombre').val().trim();
        if (primer_nombre === "") {
            $('#error_primer_nombre').text('El primer nombre es obligatorio.');
            esValido = false;
        } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(primer_nombre)) {
            $('#error_primer_nombre').text('El primer nombre solo puede contener letras.');
            esValido = false;
        }
    
    
        // Validar primer_apellido
        const primer_apellido = $('#primer_apellido').val().trim();
        if (primer_apellido === "") {
            $('#error_primer_apellido').text('El primer apellido es obligatorio.');
            esValido = false;
        } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(primer_apellido)) {
            $('#error_primer_apellido').text('El primer apellido solo puede contener letras.');
            esValido = false;
        }
        
        // Validar segundo_nombre (opcional, solo letras)
        const segundo_nombre = $('#segundo_nombre').val().trim();
        if (segundo_nombre && !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(segundo_nombre)) {
            $('#error_segundo_nombre').text('El segundo nombre solo puede contener letras.');
            esValido = false;
        }
    
        // Validar segundo_apellido
        const segundo_apellido = $('#segundo_apellido').val().trim();
        if (segundo_apellido === "") {
            $('#error_segundo_apellido').text('El segundo apellido es obligatorio.');
            esValido = false;
        } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(segundo_apellido)) {
            $('#error_segundo_apellido').text('El segundo apellido solo puede contener letras.');
            esValido = false;
        }
    
        // Validar correo
        const correo = $('#correo').val().trim();
        if (correo === "") {
            $('#error_correo').text('El correo electrónico es obligatorio.');
            esValido = false;
        } else if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(correo)) {
            $('#error_correo').text('Por favor, ingrese un correo electrónico válido.');
            esValido = false;
        }
    
        // Validar telefono
        const telefono = $('#telefono').val().trim();
        if (telefono === "") {
            $('#error_telefono').text('El número de teléfono es obligatorio.');
            esValido = false;
        } else if (!/^\d{10}$/.test(telefono)) {
            $('#error_telefono').text('El número de teléfono debe tener 10 dígitos.');
            esValido = false;
        }
    
        // Validar clave
        const clave = $('#clave').val().trim();
        if (clave === "") {
            $('#error_clave').text('La clave es obligatoria.');
            esValido = false;
        } else if (clave.length < 6) {
            $('#error_clave').text('La clave debe tener al menos 6 caracteres.');
            esValido = false;
        }
    
        // Validar confirmar_clave
        const confirmar_clave = $('#confirmar_clave').val().trim();
        if (confirmar_clave === "") {
            $('#error_confirmar_clave').text('Debe confirmar la clave.');
            esValido = false;
        } else if (confirmar_clave !== clave) {
            $('#error_confirmar_clave').text('Las claves no coinciden.');
            esValido = false;
        }
    
        // Validar carrera
        const carrera = $('#carrera').val().trim();
        if (carrera === "") {
            $('#error_carrera').text('La carrera es obligatoria.');
            esValido = false;
        }
    
        // Validar calle
        const calle = $('#calle').val().trim();
        if (calle === "") {
            $('#error_calle').text('La calle es obligatoria.');
            esValido = false;
        }
    
        // Validar numero_adicional
        const numero_adicional = $('#numero_adicional').val().trim();
        if (numero_adicional === "") {
            $('#error_numero_adicional').text('El número adicional es obligatorio.');
            esValido = false;
        }
    
        // Validar complemento
        const complemento = $('#complemento').val().trim();
        if (complemento === "") {
            $('#error_complemento').text('El complemento es obligatorio.');
            esValido = false;
        }
    
        // Validar barrio
        const barrio = $('#barrio').val().trim();
        if (barrio === "") {
            $('#error_barrio').text('El barrio es obligatorio.');
            esValido = false;
        }
        if (esValido) {
            $("#error").fadeOut(500);
            this.submit();
        } else {
            $('#error').fadeOut(500);
        }
    });

    $('#registrar-admin-form').submit(function(event) {
        
        //Evita el envio del formulario si hay errores
        event.preventDefault();
        let mensajes =[];
        // limpia mensajes de error previos
        $('#error').html('');
        
        //bandera para verificar si hay errores
        let esValido = true;

        // Verificar si hay campos vacíos
        if ($('#primer_nombre').val().trim() === "" || 
            $('#primer_apellido').val().trim() === "" || 
            $('#segundo_apellido').val().trim() === "" || 
            $('#correo').val().trim() === "" || 
            $('#telefono').val().trim() === "" || 
            $('#clave').val().trim() === "" || 
            $('#confirmar_clave').val().trim() === "" || 
            $('#usu_documento').val().trim() === "" || 
            $('#carrera').val().trim() === "" || 
            $('#calle').val().trim() === "" || 
            $('#numero_adicional').val().trim() === "" || 
            $('#complemento').val().trim() === "" || 
            $('#barrio').val().trim() === "" || 
            $('#genero').val().trim() === "" || 
            $('#rol_id').val().trim() === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Advertencia',
                    text: 'Faltan campos por rellenar.',
                    confirmButtonText: 'Aceptar'
                });
            esValido = false;
        }
  
        // Validar primer_nombre (solo letras)
        const primer_nombre = $('#primer_nombre').val().trim();
        if (primer_nombre === "") {
            $('#error_primer_nombre').text('El primer nombre es obligatorio.');
            esValido = false;
        } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(primer_nombre)) {
            $('#error_primer_nombre').text('El primer nombre solo puede contener letras.');
            esValido = false;
        }

        // Validar segundo_nombre (opcional, solo letras)
        const segundo_nombre = $('#segundo_nombre').val().trim();
        if (segundo_nombre && !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(segundo_nombre)) {
            $('#error_segundo_nombre').text('El segundo nombre solo puede contener letras.');
            esValido = false;
        }

        // Validar primer_apellido (solo letras)
        const primer_apellido = $('#primer_apellido').val().trim();
        if (primer_apellido === "") {
            $('#error_primer_apellido').text('El primer apellido es obligatorio.');
            esValido = false;
        } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(primer_apellido)) {
            $('#error_primer_apellido').text('El primer apellido solo puede contener letras.');
            esValido = false;
        }

        // Validar segundo_apellido (opcional, solo letras)
        const segundo_apellido = $('#segundo_apellido').val().trim();
        if (segundo_apellido === "") {
            $('#error_segundo_apellido').text('El segundo apellido es obligatorio.');
            esValido = false;
        } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(segundo_apellido)) {
            $('#error_segundo_apellido').text('El segundo apellido solo puede contener letras.');
            esValido = false;
        }

        // Validar correo electrónico
        const correo = $('#correo').val().trim();
        const correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (correo === "") {
            $('#error_correo').text('El correo electrónico es obligatorio.');
            esValido = false;
        } else if (!correoRegex.test(correo)) {
            $('#error_correo').text('El correo electrónico no es válido.');
            esValido = false;
        }

        // Validar teléfono
        const telefono = $('#telefono').val().trim();
        if (telefono === "") {
            $('#error_telefono').text('El teléfono es obligatorio.');
            esValido = false;
        } else if (!/^\d{10}$/.test(telefono)) {
            $('#error_telefono').text('El teléfono debe tener 10 dígitos.');
            esValido = false;
        }

        // Validar la clave
        const clave = $('#clave').val().trim();
        const claveRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d@$!%*?&]{8,}$/;
        if (clave === "") {
            $('#error_clave').text('La clave es obligatoria.');
            esValido = false;
        } else if (!claveRegex.test(clave)) {
            $('#error_clave').text('La clave debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas, números y un carácter especial.');
            esValido = false;
        }

        // Validar la confirmación de la clave
        const confirmar_clave = $('#confirmar_clave').val().trim();
        if (confirmar_clave === "") {
            $('#error_confirmar_clave').text('Debe confirmar la clave.');
            esValido = false;
        } else if (confirmar_clave !== clave) {
            $('#error_confirmar_clave').text('Las claves no coinciden.');
            esValido = false;
        }

        // Validar el documento (solo números)
        const tipoDocumento = $('#usu_tipo_documento').val();
        const documento = $('#usu_documento').val().trim();
        if (documento === "") {
            $('#error_usu_documento').text('El documento es obligatorio.');
            esValido = false;
        } else if (!/^\d+$/.test(documento)) {
            $('#error_usu_documento').text('El número de documento solo puede contener números.');
            esValido = false;
        } else {
            // Validar según tipo de documento
            switch (tipoDocumento) {
                case '1': // Cédula de Ciudadanía
                    // Debe tener 10 dígitos
                    if (!/^\d{8,10}$/.test(documento)) {
                        $('#error_usu_documento').text('La cédula de ciudadanía debe tener 10 dígitos.');
                        esValido = false;
                    }
                    break;
        
                case '2': // Tarjeta de Identidad
                    // Debe tener 10 dígitos
                    if (!/^\d{8,10}$/.test(documento)) {
                        $('#error_usu_documento').text('La tarjeta de identidad debe tener 10 dígitos.');
                        esValido = false;
                    }
                    break;
        
                case '3': // Cédula de Extranjería
                    // Debe tener 11 dígitos
                    if (!/^\d{11}$/.test(documento)) {
                        $('#error_usu_documento').text('La cédula de extranjería debe tener 11 dígitos.');
                        esValido = false;
                    }
                    break;
        
                case '4': // Pasaporte
                    // Debe tener entre 6 y 9 caracteres alfanuméricos
                    if (!/^[a-zA-Z0-9]{6,9}$/.test(documento)) {
                        $('#error_usu_documento').text('El número de pasaporte debe tener entre 6 y 9 caracteres alfanuméricos.');
                        esValido = false;
                    }
                    break;
        
                default:
                    $('#error_usu_tipo_documento').text('Tipo de documento no válido.');
                    esValido = false;
                    break;
            }
        }

        // Validar los campos de selección
        const genero = $('#genero').val();
        const rolId = $('#rol_id').val();

        if (!tipoDocumento) {
            $('#error_usu_tipo_documento').text('El tipo de documento es obligatorio.');
            esValido = false;
        }

        if (!genero) {
            $('#error_genero').text('El género es obligatorio.');
            esValido = false;
        }

        if (!rolId) {
            $('#error_rol_id').text('El rol es obligatorio.');
            esValido = false;
        }

        // Validar la dirección
        const carrera = $('#carrera').val().trim();
        const calle = $('#calle').val().trim();
        const numero_adicional = $('#numero_adicional').val().trim();
        const complemento = $('#complemento').val().trim();
        const barrio = $('#barrio').val().trim();

        if (carrera === "") {
            $('#error_carrera').text('La carrera es obligatoria.');
            esValido = false;
        }

        if (calle === "") {
            $('#error_calle').text('La calle es obligatoria.');
            esValido = false;
        }

        if (numero_adicional === "") {
            $('#error_numero_adicional').text('El número adicional es obligatorio.');
            esValido = false;
        }

        if (complemento === "") {
            $('#error_complemento').text('El complemento es obligatorio.');
            esValido = false;
        }

        if (barrio === "") {
            $('#error_barrio').text('El barrio es obligatorio.');
            esValido = false;
        }

        if (esValido) {
            $("#error").fadeOut(500);
            this.submit();
        } else {
            $('#error').fadeOut(500);
        }
    });

    function limpiarError(campo) {
        $(`#error_${campo}`).html(''); // Limpiar el error
        $(`#${campo}`).removeClass('is-invalid'); // Si utilizas clases de validación (opcional)
    }

    function mostrarError(campo, mensaje) {
        $(`#error_${campo}`).html(mensaje); // Mostrar el mensaje de error
        $(`#${campo}`).addClass('is-invalid'); // Si quieres que el campo se vea con error
    }

    $('#genero').change(function () {
        const genero = $('#genero').val().trim();
        if (genero === "") {
            mostrarError('genero', 'El género es obligatorio.');
        } else {
            limpiarError('genero');
        }
    });

    $('#usu_documento').keyup(function() {
        const tipoDocumento = $('#usu_tipo_documento').val();
        const documento = $('#usu_documento').val().trim();

        if (documento === "") {
            mostrarError('usu_documento', 'El documento es obligatorio.');
        } else if (tipoDocumento !== '4' && !/^\d+$/.test(documento)) {
            mostrarError('usu_documento', 'El documento debe contener solo números.');
        } else {
            validarDocumento(tipoDocumento, documento);
        }
    });

    // Validar el documento al cambiar el tipo de documento
    $('#usu_tipo_documento').change(function() {
        const tipoDocumento = $('#usu_tipo_documento').val();
        const documento = $('#usu_documento').val().trim();
        if (documento !== "") {
            validarDocumento(tipoDocumento, documento);
        }
    });

    // Función para validar el documento dependiendo del tipo
    function validarDocumento(tipoDocumento, documento) {
        let esValido = true;

        // Validación por tipo de documento
        switch (parseInt(tipoDocumento)) {
            case 1: // Cédula de Ciudadanía
                if (!/^\d{8,10}$/.test(documento)) {
                    mostrarError('usu_documento', 'La cédula de ciudadanía debe tener 10 dígitos.');
                    esValido = false;
                }
                break;

            case 2: // Tarjeta de Identidad
                if (!/^\d{8,10}$/.test(documento)) {
                    mostrarError('usu_documento', 'La tarjeta de identidad debe tener 10 dígitos.');
                    esValido = false;
                }
                break;

            case 3: // Cédula de Extranjería
                if (!/^\d{11}$/.test(documento)) {
                    mostrarError('usu_documento', 'La cédula de extranjería debe tener 11 dígitos.');
                    esValido = false;
                }
                break;

            case 4: // Pasaporte
                if (!/^[a-zA-Z0-9]{6,9}$/.test(documento)) {
                    mostrarError('usu_documento', 'El número de pasaporte debe tener entre 6 y 9 caracteres alfanuméricos.');
                    esValido = false;
                }
                break;

            default:
                mostrarError('usu_documento', 'Seleccione un tipo de documento válido.');
                esValido = false;
                break;
        }

        // Si el documento es válido, limpiamos el error
        if (esValido) {
            limpiarError('usu_documento');
            limpiarError('usu_tipo_documento');
        }
    }




    $('#rol_id').change(function () {
        const rol = $('#rol_id').val().trim();
        if (rol === "") {
            mostrarError('rol_id', 'El rol es obligatorio.');
        } else {
            limpiarError('rol_id');
        }
    });

    $('#primer_nombre').keyup(function() {
        const primer_nombre = $('#primer_nombre').val().trim();
        if(primer_nombre === ""){
            mostrarError('primer_nombre', 'El primer nombre es obligatorio.');
        } else {
            if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(primer_nombre)) {
                mostrarError('primer_nombre', 'El primer nombre debe contener solo letras.');
            }else{
                limpiarError('primer_nombre');
            }
        }
    });

    $('#segundo_nombre').keyup(function() {
        const segundo_nombre = $('#segundo_nombre').val().trim();
        if (segundo_nombre === "") {
            limpiarError('segundo_nombre');
        } else if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(segundo_nombre)) {
            mostrarError('segundo_nombre', 'El segundo nombre debe contener solo letras.');
        } else {
            limpiarError('segundo_nombre');
        }
    });

    $('#primer_apellido').keyup(function () {
        const primer_apellido = $('#primer_apellido').val().trim();
        if (primer_apellido === "") {
            mostrarError('primer_apellido', 'El primer apellido es obligatorio.');
        } else {
            if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(primer_apellido)) {
                mostrarError('primer_apellido', 'El primer apellido debe contener solo letras.');
            } else {
                limpiarError('primer_apellido');
            }
        }
    });

    $('#segundo_apellido').keyup(function () {
        const segundo_apellido = $('#segundo_apellido').val().trim();
        if (segundo_apellido === "") {
            mostrarError('segundo_apellido', 'El segundo apellido es obligatorio.');
        } else {
            if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(segundo_apellido)) {
                mostrarError('segundo_apellido', 'El segundo apellido debe contener solo letras.');
            } else {
                limpiarError('segundo_apellido');
            }
        }
    });

    $('#correo').keyup(function () {
        const correo = $('#correo').val().trim();
        const correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (correo === "") {
            mostrarError('correo', 'El correo es obligatorio.');
        } else if (!correoRegex.test(correo)) {
            mostrarError('correo', 'El correo debe ser válido (ejemplo@dominio.com).');
        } else {
            limpiarError('correo');
        }
    });

    $('#telefono').keyup(function () {
        const telefono = $('#telefono').val().trim();
        if (telefono === "") {
            mostrarError('telefono', 'El teléfono es obligatorio.');
        } else if (!/^\d{10}$/.test(telefono)) {
            mostrarError('telefono', 'El teléfono debe contener solo números y tener 10 dígitos.');
        } else {
            limpiarError('telefono');
        }
    });

    $('#clave').keyup(function () {
        const clave = $('#clave').val().trim();
        const claveRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d@$!%*?&]{8,}$/;
        if (clave === "") {
            mostrarError('clave', 'La clave es obligatoria.');
        } else if (!claveRegex.test(clave)) {
            mostrarError('clave', 'La clave debe contener al menos una mayúscula, una minúscula, un número, un símbolo y más de 8 caracteres.');
        } else {
            limpiarError('clave');
        }
    });

    $('#confirmar_clave').keyup(function () {
        const confirmar_clave = $('#confirmar_clave').val().trim();
        const clave = $('#clave').val().trim();
        if (confirmar_clave === "") {
            mostrarError('confirmar_clave', 'Debe confirmar la clave.');
        } else if (confirmar_clave !== clave) {
            mostrarError('confirmar_clave', 'Las contraseñas no coinciden.');
        } else {
            limpiarError('confirmar_clave');
        }
    });


    $('#carrera').keyup(function () {
        const carrera = $('#carrera').val().trim();
        if (carrera === "") {
            mostrarError('carrera', 'La carrera es obligatoria.');
        } else {
            limpiarError('carrera');
        }
    });

    $('#calle').keyup(function () {
        const calle = $('#calle').val().trim();
        if (calle === "") {
            mostrarError('calle', 'La calle es obligatoria.');
        } else {
            limpiarError('calle');
        }
    });

    $('#numero_adicional').keyup(function () {
        const numero_adicional = $('#numero_adicional').val().trim();
        if (numero_adicional === "") {
            mostrarError('numero_adicional', 'El número adicional es obligatorio.');
        } else {
            limpiarError('numero_adicional');
        }
    });

    $('#complemento').keyup(function () {
        const complemento = $('#complemento').val().trim();
        if (complemento === "") {
            mostrarError('complemento', 'El complemento es obligatorio.');
        } else {
            limpiarError('complemento');
        }
    });

    $('#barrio').keyup(function () {
        const barrio = $('#barrio').val().trim();
        if (barrio === "") {
            mostrarError('barrio', 'El barrio es obligatorio.');
        } else {
            limpiarError('barrio');
        }
    });
    
    $(document).on('keyup','#buscar',function(){
        let buscar = $(this).val();
        let url = $(this).attr('data-url');

        $.ajax({
            url: url,
            type: 'POST',
            data: {'buscar':buscar},
            success: function(data){
                $('tbody').html(data);
            },
            error: function(xhr, status, error) {
                console.error("Error al filtrar los resultados:", error);
            }
        });
    });

    $(document).on("click", "#cambiar_estado_pqrs", function(){
        let estado_id = $(this).attr('data-id');  
        let url = $(this).attr('data-url');        
        let pqrs_id = $(this).attr('data-pqrs-id'); 
        
        $.ajax({
            url: url,  
            data: {id: estado_id, pqrs_id: pqrs_id}, 
            type: 'POST',  
            success: function(data){
                $('tbody').html(data);  
            },
            error: function(){
                alert("Error al actualizar el estado.");
            }
        });
    });
    
});