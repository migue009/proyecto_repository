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
    
        const nombre =$('#nombre').val().trim();
    
        if(nombre ===''){
            mensajes.push('El campo nombre es obligatorio');
            esValido =false;
        }
    
        const apellido = $('#apellido').val().trim();
    
        if(apellido ===''){
            mensajes.push('El campo apellido es obligatorio');
            esValido =false;
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