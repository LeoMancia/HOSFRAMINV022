$(document).ready(function(){
    
    var funcion;
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
                <tr tipoID="${tipos.id}" tiponombre="${tipos.tipo}">
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
        funcion ='eliminar_tipo';
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('tipoID');
        const nombre=$(elemento).attr('tiponombre');
        console.log(id);
        console.log(nombre);
       
        console.log(funcion);
        $('#id').val(id);
        $('#funcion').val(funcion);
       const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success ml-1',
              cancelButton: 'btn btn-danger mt-10'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: '¿Eliminar '+nombre+'?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.post('../Controlador/tipoController.php',{id,funcion},(response)=>{ 
                    if (response=='borrado') {
                        swalWithBootstrapButtons.fire(
                            'Eliminado!',
                            'Registro eliminado satisfactoriamente.',
                            'success'
                        )
                        rellenar_tipos();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'No se pudo eliminar!',
                            'Ha surgido un problema inesperado',
                            'success'
                        )
                    }
                    
                }) 
              
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'NO se han realizado cambios',
                'error'
              )
            }
          })

    })  

});