$(document).ready(function(){
    
    var funcion;
    let id;
    //bloque de codigo que crea un nuevo usuario
    $('#creartipous').submit(e=>{
        let tipo = $('#tipo').val();
        funcion='crear_tipo';
        $.post('../Controlador/tipoController.php',{tipo,funcion},(response)=>{
          if (response=='add') {              
            $('#add').hide('slow');
            $('#add').show(200);
            $('#add').hide(5000);
            $('#creartipous').trigger('reset');
            
          } else {
            $('#noadd').hide('slow');
            $('#noadd').show(200);
            $('#noadd').hide(5000);
            $('#creartipous').trigger('reset');
          }
        });
       
    });

    //TESTEO
    rellenar_tipos();
    function rellenar_tipos() {
        funcion="rellenar_tipos";
        $.post('../Controlador/tipoController.php',{funcion},(response)=>{
            console.log(response);
            const Tipos = JSON.parse(response);
            let template='';
            Tipos.forEach(tipos => {
                template=`
                <tr tipoID="${tipos.id}">
                    <td>${tipos.tipo}</td>
                    <td><button class="actualizar-tipo btn btn-success btn-lock"><i class="fas fa-times-circle"></i></a></td>
                    <td><button class="ver-tipo btn btn-info btn-lock"><i class="fas fa-times-circle"></i></a></td>
                    <td><button class="borrar-tipo btn btn-danger btn-lock"><i class="fas fa-times-circle"></i></a></td>
                </tr>
            `;
            $('#lista-compra').append(template);
            });        
            
        });
    }

    //TESTEO ELIMINAR
    $(document).on('click','.borrar-tipo',(e)=>{
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('tipoID');
        funcion='eliminar_tipo';
        $('#id_tipo').val(id);
        $('#funcion').val(funcion);
        console.log(id);
        console.log(funcion);

    })  

});