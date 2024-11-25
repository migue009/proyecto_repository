$(document).ready(function(){
    $('#form').submit(function(event) {
        
        //Evita el envio del formulario si hay errores
        event.preventDefault();
        let mensajes =[];
        // limpia mensajes de error previos
        $('#error').html('');
        
        //bandera para verificar si hay errores
        let esValido = true;

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
        $('#barrio').val().trim() === "") {
            mensajes.push('Faltan campos por rellenar.');
            esValido = false;
        }
        // Validar el primer nombre
        const primer_nombre = $('#primer_nombre').val().trim();
        if (primer_nombre === "" || !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(primer_nombre)) {
            esValido = false;
        }

        // Validar el segundo nombre
        const segundo_nombre = $('#segundo_nombre').val().trim();
        if (segundo_nombre && !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(segundo_nombre)) {
            esValido = false;
        }

        // Validar el primer apellido
        const primer_apellido = $('#primer_apellido').val().trim();
        if (primer_apellido === "" || !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(primer_apellido)) {
            esValido = false;
        }

        // Validar el segundo apellido
        const segundo_apellido = $('#segundo_apellido').val().trim();
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/.test(segundo_apellido)) {
            esValido = false;
        }

        // Validar el correo electrónico
        const correo = $('#correo').val().trim();
        const correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (correo === "" || !correoRegex.test(correo)) {
            esValido = false;
        }

        // Validar el teléfono
        const telefono = $('#telefono').val().trim();
        if (telefono === "" || !/^\d{10}$/.test(telefono)) {
            esValido = false;
        }

        // Validar la clave
        const clave = $('#clave').val().trim();
        const claveRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d@$!%*?&]{8,}$/;
        if (clave === "" || !claveRegex.test(clave)) {
            esValido = false;
        }

        // Validar la confirmación de la clave
        const confirmar_clave = $('#confirmar_clave').val().trim();
        if (confirmar_clave === "" || confirmar_clave !== clave) {
            esValido = false;
        }

        // Validar el documento
        const documento = $('#usu_documento').val().trim();
        if (documento === "" || !/^\d+$/.test(documento)) {
            esValido = false;
        }

        // Validar la carrera
        const carrera = $('#carrera').val().trim();
        if (carrera === "") {
            esValido = false;
        }

        // Validar la calle
        const calle = $('#calle').val().trim();
        if (calle === "") {
            esValido = false;
        }

        // Validar el número adicional
        const numero_adicional = $('#numero_adicional').val().trim();
        if (numero_adicional === "") {
            esValido = false;
        }

        // Validar el complemento
        const complemento = $('#complemento').val().trim();
        if (complemento === "") {
            esValido = false;
        }

        // Validar el barrio
        const barrio = $('#barrio').val().trim();
        if (barrio === "") {
            esValido = false;
        }

        if (esValido) {
            // Enviar el formulario
            $("#error").fadeOut(500);
            this.submit();
        } else {
            // Mostrar errores
            $('#error').html(mensajes.map(msg => `${msg}<br>`).join(''));
            $('#error').removeClass('d-none');

            if (mensajes.length === 0) {
                $('#error').fadeOut(500);
            }
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
                limpiarError('segundoprimer_apellido_apellido');
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

    $('#rol_id').change(function () {
        const rol = $('#rol_id').val().trim();
        if (rol === "") {
            mostrarError('rol_id', 'El rol es obligatorio.');
        } else {
            limpiarError('rol_id');
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
            }
        });
    });

    $(document).on('keyup','#buscar_tarea',function(){
        let buscar = $(this).val();
        let url = $(this).attr('data-url');

        $.ajax({
            url: url,
            type: 'POST',
            data: {'buscar_tarea':buscar},
            success: function(data){
                $('tbody').html(data);
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
    $(document).on("click","#cambiar_estado_tarea",function(){
        let id = $(this).attr('data-id');
        let url = $(this).attr('data-url');
        let tar = $(this).attr('data-tar');

        $.ajax({
            url: url,
            data: {id,tar},
            type: 'POST',
            success: function(data){
                $('tbody').html(data);
            }
        });
    });
    $(document).on("click","#copyList",function(){
        let listUser = $('#listUser').html();
        $('#responsables').append(
            "<div classs='col-md-4 form-group'>"+
                "<label>Responsable</label>"+
                "<div class='row'>"+
                    "<div class ='col-md-10'>"+listUser+"</div>"+
                    "<div class = 'col-md-2'>"+
                        "<button class='btn btn-danger' type='button' id='removeList'>x</button>"+
                    "</div>"+
                "</div>"+  
            "</div>" 
        )
    });
    $(document).on("click","#removeList",function(){
        $(this).parent().parent().parent().remove();
    });
});