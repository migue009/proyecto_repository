$(document).ready(function(){
    $('#form').submit(function(event) {
        //Evita el envio del formulario si hay errores
        event.preventDefault();
        let mensajes =[];
        // limpia mensajes de error previos
        $('#error').html('');
    
        //bander para verificar si hay errores
        let esValido = true;
    
        //validar campo de nombre
    
        const nombre =$('#primer_nombre').val().trim();
    
        if(!/^[a-zA-Z]+$/.test(nombre)){
            mensajes.push('El primer nombre debe contener solo letras frontend');
            esValido =false;
        }

        const segundo_nombre  =$('#segundo_nombre').val().trim();
    
        if(segundo_nombre && !/^[a-zA-Z]+$/.test(segundo_nombre )){
            mensajes.push('El segundo nombre debe contener solo letras');
            esValido =false;
        }
    
        const primer_apellido = $('#primer_apellido').val().trim();
       
        if (!/^[a-zA-Z]+$/.test(primer_apellido)) {
            mensajes.push('El primer apellido debe contener solo letras.');
            esValido = false;
        }

        const segundo_apellido = $('#segundo_apellido').val().trim();
        
        if (!/^[a-zA-Z]+$/.test(segundo_apellido)) {
            mensajes.push('El segundo apellido debe contener solo letras.');
            esValido = false;
        }
        
        const correo = $('#correo').val().trim();
        const correoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
       
        if (!correoRegex.test(correo)) {
            mensajes.push('El correo debe ser válido (ejemplo@dominio.com).');
            esValido = false;
        }

        const telefono = $('#telefono').val().trim();
        
        if (!/^\d{10}$/.test(telefono)) { // Validación para un teléfono de 10 dígitos
            mensajes.push('El teléfono debe contener solo números y tener 10 dígitos.');
            esValido = false;
        }

        const clave = $('#clave').val().trim();
        const claveRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d@$!%*?&]{8,}$/;
        
        if (!claveRegex.test(clave)) {
            mensajes.push('La clave debe contener al menos una mayúscula, una minúscula, un número, un símbolo y más de 8 caracteres.');
            esValido = false;
        }

        const confirmar_clave = $('#confirmar_clave').val().trim();
       
        if (clave !== confirmar_clave) {
            mensajes.push('Las contraseñas no coinciden.');
            esValido = false;
        }

        const tipo_documento = $('#usu_tipo_documento').val();
        
        if (!tipo_documento) {
            mensajes.push('El tipo de documento es obligatorio.');
            esValido = false;
        }

        const documento = $('#usu_documento').val().trim();
        
        if (!/^\d+$/.test(documento)) {
            mensajes.push('El número de documento debe contener solo números.');
            esValido = false;
        }
        
        const rol = $('#rol_id').val();
        
        if (!rol) {
            mensajes.push('El rol es obligatorio.');
            esValido = false;
        }

        //Si todo es valido, puedes enviar el formulario o hacer otra
        if(esValido){
            // alert('Formulario valido. Enviando datos...');
            $("#error").fadeOut(500);//desvanecer en tiempo determinado
            this.submit();
        }else{
            // no se utilizan '' comillas simples si no `` se colocan con alt y la tecla al lado del enter que tiene una Ç
            $('#error').html(mensajes.map(msg=>`${msg}<br>`).join(''));
            $('#error').removeClass('d-none');
        }
    
        //Correo y contraseña hacerlos investigue e implemente test y regex
    
        
    });

    function limpiarError(campo) {
        $(`#error_${campo}`).html(''); // Limpiar el error
        $(`#${campo}`).removeClass('is-invalid'); // Si utilizas clases de validación (opcional)
    }

    // Función para agregar el error en el campo específico
    function mostrarError(campo, mensaje) {
        $(`#error_${campo}`).html(mensaje); // Mostrar el mensaje de error
        $(`#${campo}`).addClass('is-invalid'); // Si quieres que el campo se vea con error
    }

    // Validar los campos mientras el usuario escribe
    $('#primer_nombre').keyup(function() {
        const nombre = $('#primer_nombre').val().trim();
        if(nombre === ""){
            mostrarError('primer_nombre', 'El primer nombre no puede ir en blanco.');
        } else {
            if (!/^[a-zA-ZñÑ]+$/.test(nombre)) {
                mostrarError('primer_nombre', 'El primer nombre debe contener solo letras.');
            }else{
            limpiarError('primer_nombre');
            }
        }
    });

    $('#segundo_nombre').keyup(function() {
        const segundo_nombre = $('#segundo_nombre').val().trim();
        if (segundo_nombre && !/^[a-zA-Z]+$/.test(segundo_nombre)) {
            mostrarError('segundo_nombre', 'El segundo nombre debe contener solo letras.');
        } else {
            limpiarError('segundo_nombre');
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