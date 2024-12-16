$(document).ready(function(){
    // $('#form').submit(function (event) {
        
    //     // Evita el envío del formulario si hay errores
    //     event.preventDefault();
    //     let esValido = true;
        
    //     // Limpiar los mensajes de error previos
    //     $('.invalid-feedback').html('');
    //     $('.form-control').removeClass('is-invalid');
        
    //     // Validar los campos
    //     const primerNombre = $('#primer_nombre').val().trim();
    //     if (primerNombre === "" || !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(primerNombre)) {
    //         mostrarError('primer_nombre', 'El primer nombre es obligatorio y debe contener solo letras.');
    //         esValido = false;
    //     }

    //     const segundoNombre = $('#segundo_nombre').val().trim();
    //     if (segundoNombre && !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(segundoNombre)) {
    //         mostrarError('segundo_nombre', 'El segundo nombre debe contener solo letras.');
    //         esValido = false;
    //     }

    //     const primerApellido = $('#primer_apellido').val().trim();
    //     if (primerApellido === "" || !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(primerApellido)) {
    //         mostrarError('primer_apellido', 'El primer apellido es obligatorio y debe contener solo letras.');
    //         esValido = false;
    //     }

    //     const segundoApellido = $('#segundo_apellido').val().trim();
    //     if (segundoApellido && !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(segundoApellido)) {
    //         mostrarError('segundo_apellido', 'El segundo apellido debe contener solo letras.');
    //         esValido = false;
    //     }

    //     const correo = $('#correo').val().trim();
    //     const correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    //     if (correo === "" || !correoRegex.test(correo)) {
    //         mostrarError('correo', 'El correo electrónico es obligatorio y no es válido.');
    //         esValido = false;
    //     }

    //     const telefono = $('#telefono').val().trim();
    //     if (telefono === "" || !/^\d{10}$/.test(telefono)) {
    //         mostrarError('telefono', 'El teléfono debe contener 10 dígitos numéricos.');
    //         esValido = false;
    //     }

    //     const clave = $('#clave').val().trim();
    //     const claveRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d@$!%*?&]{8,}$/;
    //     if (clave === "" || !claveRegex.test(clave)) {
    //         mostrarError('clave', 'La clave debe tener al menos 8 caracteres, incluir mayúsculas, números y caracteres especiales.');
    //         esValido = false;
    //     }

    //     const confirmarClave = $('#confirmar_clave').val().trim();
    //     if (confirmarClave === "" || confirmarClave !== clave) {
    //         mostrarError('confirmar_clave', 'Las contraseñas no coinciden.');
    //         esValido = false;
    //     }

    //     const documento = $('#usu_documento').val().trim();
    //     if (documento === "" || !/^\d+$/.test(documento)) {
    //         mostrarError('usu_documento', 'El documento debe contener solo números.');
    //         esValido = false;
    //     }

    //     const carrera = $('#carrera').val().trim();
    //     if (carrera === "") {
    //         mostrarError('carrera', 'La carrera es obligatoria.');
    //         esValido = false;
    //     }

    //     const calle = $('#calle').val().trim();
    //     if (calle === "") {
    //         mostrarError('calle', 'La calle es obligatoria.');
    //         esValido = false;
    //     }

    //     const numeroAdicional = $('#numero_adicional').val().trim();
    //     if (numeroAdicional === "") {
    //         mostrarError('numero_adicional', 'El número adicional es obligatorio.');
    //         esValido = false;
    //     }

    //     const complemento = $('#complemento').val().trim();
    //     if (complemento === "") {
    //         mostrarError('complemento', 'El complemento es obligatorio.');
    //         esValido = false;
    //     }

    //     const barrio = $('#barrio').val().trim();
    //     if (barrio === "") {
    //         mostrarError('barrio', 'El barrio es obligatorio.');
    //         esValido = false;
    //     }

    //     // Si es válido, enviar el formulario
    //     if (esValido) {
    //         this.submit();
    //     } else {
    //         Swal.default({
    //             icon: 'error',
    //             title: '¡Error!',
    //             text: 'Faltan campos por rellenar o hay errores de formato.',
    //             confirmButtonText: 'Aceptar'
    //         });
    //     }
    // });

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
        // Validar el primer nombre (solo letras)
        const primer_nombre = $('#primer_nombre').val().trim();
        if (primer_nombre === "" || !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(primer_nombre)) {
            $('#error_primer_nombre').text('El primer nombre solo puede contener letras.');
            esValido = false;
        }

        // Validar el segundo nombre (opcional, solo letras)
        const segundo_nombre = $('#segundo_nombre').val().trim();
        if (segundo_nombre && !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(segundo_nombre)) {
            $('#error_segundo_nombre').text('El segundo nombre solo puede contener letras.');
            esValido = false;
        }

        // Validar el primer apellido (solo letras)
        const primer_apellido = $('#primer_apellido').val().trim();
        if (primer_apellido === "" || !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(primer_apellido)) {
            $('#error_primer_apellido').text('El primer apellido solo puede contener letras.');
            esValido = false;
        }

        // Validar el segundo apellido (opcional, solo letras)
        const segundo_apellido = $('#segundo_apellido').val().trim();
        if (segundo_apellido && !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(segundo_apellido)) {
            $('#error_segundo_apellido').text('El segundo apellido solo puede contener letras.');
            esValido = false;
        }

        // Validar el correo electrónico
        const correo = $('#correo').val().trim();
        const correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (correo === "" || !correoRegex.test(correo)) {
            $('#error_correo').text('El correo electrónico no es válido.');
            esValido = false;
        }

        // Validar el teléfono
        const telefono = $('#telefono').val().trim();
        if (telefono === "" || !/^\d{10}$/.test(telefono)) {
            $('#error_telefono').text('El teléfono debe tener 10 dígitos.');
            esValido = false;
        }

        // Validar la clave
        const clave = $('#clave').val().trim();
        const claveRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d@$!%*?&]{8,}$/;
        if (clave === "" || !claveRegex.test(clave)) {
            $('#error_clave').text('La clave debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas, números y un carácter especial.');
            esValido = false;
        }

        // Validar la confirmación de la clave
        const confirmar_clave = $('#confirmar_clave').val().trim();
        if (confirmar_clave === "" || confirmar_clave !== clave) {
            $('#error_confirmar_clave').text('Las claves no coinciden.');
            esValido = false;
        }

        // Validar el documento
        const documento = $('#usu_documento').val().trim();
        if (documento === "" || !/^\d+$/.test(documento)) {
            $('#error_usu_documento').text('El número de documento solo puede contener números.');
            esValido = false;
        }

        // Validar los campos de selección
        const tipoDocumento = $('#usu_tipo_documento').val();
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

    $('#usu_tipo_documento').change(function () {
        const usu_tipo_documento = $('#usu_tipo_documento').val().trim();
        if (usu_tipo_documento === "") {
            mostrarError('usu_tipo_documento', 'El tipo de documento es obligatorio.');
        } else {
            limpiarError('usu_tipo_documento');
        }
    });

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

    $('#usu_documento').keyup(function () {
        const documento = $('#usu_documento').val().trim();
        if (documento === "") {
            mostrarError('usu_documento', 'El documento es obligatorio.');
        } else if (!/^\d+$/.test(documento)) {
            mostrarError('usu_documento', 'El documento debe contener solo números.');
        } else {
            limpiarError('usu_documento');
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

    $(document).on("click","#cambiar_estado_usuario",function(){
        let id = $(this).attr('data-id');
        let url = $(this).attr('data-url');
        let user = $(this).attr('data-user');
        
        $.ajax({
            url: url,
            data: {id,user},
            type: 'POST',
            success: function(data){
                $('tbody').html(data);
            }
        });
    });
    
    // $(document).on("click","#cambiar_estado_tarea",function(){
    //     let id = $(this).attr('data-id');
    //     let url = $(this).attr('data-url');
    //     let tar = $(this).attr('data-tar');

    //     $.ajax({
    //         url: url,
    //         data: {id,tar},
    //         type: 'POST',
    //         success: function(data){
    //             $('tbody').html(data);
    //         }
    //     });
    // });

    // $(document).on("click","#copyList",function(){
    //     let listUser = $('#listUser').html();
    //     $('#responsables').append(
    //         "<div classs='col-md-4 form-group'>"+
    //             "<label>Responsable</label>"+
    //             "<div class='row'>"+
    //                 "<div class ='col-md-10'>"+listUser+"</div>"+
    //                 "<div class = 'col-md-2'>"+
    //                     "<button class='btn btn-danger' type='button' id='removeList'>x</button>"+
    //                 "</div>"+
    //             "</div>"+  
    //         "</div>" 
    //     )
    // });

    // $(document).on("click","#removeList",function(){
    //     $(this).parent().parent().parent().remove();
    // });
});